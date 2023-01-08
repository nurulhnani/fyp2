<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Merit;
use App\Models\Student;
use App\Models\Classlist;
use App\Models\AutoFields;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Models\Interest_Inventory_Results;
use App\Models\Personality_Evaluation;
use App\Models\Profile_Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(10);
        $class = Classlist::all();
        return view('students.index', compact('students', 'class'));
    }

    public function overview($id)
    {
        $student = Student::find($id);

        //Interest Inventory
        $categoryArray = array("Realistic", "Investigative", "Artistic", "Social", "Enterprising", "Conventional");
        if (Interest_Inventory_Results::where('student_id', $id)->exists()) {
            foreach ($categoryArray as $category) {
                $averageScore = Interest_Inventory_Results::where('student_id', $id)->avg($category);
                $averageArr[$category] = intval(round($averageScore));
            }

            $result = Interest_Inventory_Results::where('student_id', $id)->get();
            $teacherids = [];
            foreach ($result as $res) {
                if (!in_array($res->teacher_id, $teacherids)) {
                    $teacherids[] = $res->teacher_id;
                }
            }
        } else {
            $averageArr = "No result found";
            $teacherids = null;
        }

        //Personality
        $categoryPersArray = array("Extraversion", "Agreeableness", "Neuroticism", "Conscientiousness", "Openness");
        if (Personality_Evaluation::where('student_mykid', '=', $student->mykid)->exists()) {
            foreach ($categoryPersArray as $category) {
                $averagePersScore = Personality_Evaluation::where('student_mykid', '=', $student->mykid)->avg($category);
                $averagePersArr[$category] = intval(round($averagePersScore));
            }
        } else {
            $averagePersArr = null;
        }

        //Curriculum Merit 
        if (Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->exists()) {
            $merits = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->get();

            $latestDate = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->latest()->first();
        } else {
            $merits = null;
            $latestDate = null;
        }

        return view('students.overview', compact('student', 'teacherids', 'averageArr', 'averagePersArr', 'merits', 'latestDate'));
    }

    //for Teacher page
    public function overviewForTeacher($id)
    {
        $student = Student::find($id);

        //Interest Inventory
        $categoryArray = array("Realistic", "Investigative", "Artistic", "Social", "Enterprising", "Conventional");
        if (Interest_Inventory_Results::where('student_id', $id)->exists()) {
            foreach ($categoryArray as $category) {
                $averageScore = Interest_Inventory_Results::where('student_id', $id)->avg($category);
                $averageArr[$category] = intval(round($averageScore));
            }

            $result = Interest_Inventory_Results::where('student_id', $id)->get();
            $teacherids = [];
            foreach ($result as $res) {
                if (!in_array($res->teacher_id, $teacherids)) {
                    $teacherids[] = $res->teacher_id;
                }
            }
        } else {
            $averageArr = "No result found";
            $teacherids = null;
        }

        //Personality
        $categoryPersArray = array("Extraversion", "Agreeableness", "Neuroticism", "Conscientiousness", "Openness");
        if (Personality_Evaluation::where('student_mykid', '=', $student->mykid)->exists()) {
            foreach ($categoryPersArray as $category) {
                $averagePersScore = Personality_Evaluation::where('student_mykid', '=', $student->mykid)->avg($category);
                $averagePersArr[$category] = intval(round($averagePersScore));
            }
        } else {
            $averagePersArr = null;
        }

        //Curriculum Merit 
        if (Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->exists()) {
            $merits = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->get();

            $latestDate = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->latest()->first();
        } else {
            $merits = null;
            $latestDate = null;
        }

        //Behavioural Merit 
        $behaMerits = Merit::where('student_mykid', '=', $student->mykid)
            ->where('type', '=', 'b')
            ->where('merit_point', '>', 0)
            ->get();

        $behaDemerits = Merit::where('student_mykid', '=', $student->mykid)
            ->where('type', '=', 'b')
            ->where('merit_point', '<', 0)
            ->get();

        $behaLatestDate = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'b')->latest()->first();


        return view('teachers.studentoverview', compact('student', 'teacherids', 'averageArr', 'averagePersArr', 'merits', 'latestDate', 'behaMerits', 'behaDemerits', 'behaLatestDate'));
    }

    public function dashboard(Request $request, $id)
    {
        ////////////////// PERSONALITY EVAL ALL YEAR/////////////////////////

        $student = Student::find($id);
        $student_mykid = $student->mykid;
        $getYear = Personality_Evaluation::select(DB::raw('YEAR(created_at) as year'))
            ->where('student_mykid', '=', $student_mykid)
            ->groupBy('year')
            ->get();


        $years = []; //get all year
        foreach ($getYear as $record) {
            if (!in_array($record->year, $years)) {
                $years[] = $record->year;
            }
        }

        if (isset($request->year)) {
            $yearfilter = [];
            foreach ($request->year as $filter) {
                $yearfilter[] = (string)$filter;
            }

            $categoryArray = array("Extraversion", "Agreeableness", "Neuroticism", "Conscientiousness", "Openness");
            foreach ($categoryArray as $category) {
                $averageScore = Personality_Evaluation::where('student_mykid', '=', $student->mykid)
                    ->when($request->year != null, function ($q) use ($request) {
                        $yearfilter = [];
                        foreach ($request->year as $filter) {
                            $yearfilter[] = (string)$filter;
                        }
                        return $q->whereIn(DB::raw('YEAR(created_at)'), $yearfilter);
                        // dd($yearfilter);
                    })
                    ->avg($category);

                $averageArr[$category] = intval(round($averageScore));
                $averagePerso[$category] = intval(round($averageScore));
            }
            $filter = "yes";

            // dd($averageArr);
        } else {
            $averageArr = null;
            $categoryArray = array("Extraversion", "Agreeableness", "Neuroticism", "Conscientiousness", "Openness");
            $getYear = Personality_Evaluation::select(DB::raw('YEAR(created_at) as year'))
                ->where('student_mykid', '=', $student_mykid)
                ->groupBy('year')
                ->get();


            $years = []; //get all year
            foreach ($getYear as $record) {
                if (!in_array($record->year, $years)) {
                    $years[] = $record->year;
                }
            }

            $i = 0;
            foreach ($years as $year) {
                foreach ($categoryArray as $category) {
                    $personalityrec[$year][$category] = Personality_Evaluation::where(DB::raw('YEAR(created_at)'), '=', $year)
                        ->where('student_mykid', '=', $student_mykid)
                        ->avg($category);
                }
            }
            foreach ($years as $year) {
                foreach ($categoryArray as $category) {
                    $averageArr[$year][$category] = intval(round($personalityrec[$year][$category]));
                }
            }
            $data = [];
            foreach ($years as $year) {
                $data[] = "'[" . implode(',', $averageArr[$year]) . "]'";
            }
            $filter = "no";
            $yearfilter = null;

            //percentage
            foreach ($categoryArray as $category) {
                $averageScore = Personality_Evaluation::where('student_mykid', '=', $student->mykid)->avg($category);
                $averagePerso[$category] = intval(round($averageScore));
            }
        }

        ////////////////////// INTEREST INVENTORY ///////////////////////////
        $student = Student::find($id);
        $categoryInterest = array("Realistic", "Investigative", "Artistic", "Social", "Enterprising", "Conventional");
        if (Interest_Inventory_Results::where('student_id', $id)->exists()) {

            if (isset($request->year)) {
                $yearfilter = [];
                foreach ($request->year as $filter) {
                    $yearfilter[] = (string)$filter;
                }

                foreach ($categoryInterest as $category) {
                    $averageScore = Interest_Inventory_Results::where('student_id', '=', $id)
                        ->when($request->year != null, function ($q) use ($request) {
                            $yearfilter = [];
                            foreach ($request->year as $filter) {
                                $yearfilter[] = (string)$filter;
                            }
                            return $q->whereIn(DB::raw('YEAR(created_at)'), $yearfilter);
                            // dd($yearfilter);
                        })
                        ->avg($category);

                    $averageInterest[$category] = intval(round($averageScore));
                }
                $filter = "yes";
            } else {
                foreach ($categoryInterest as $category) {
                    $averageScore = Interest_Inventory_Results::where('student_id', $id)->avg($category);
                    $averageInterest[$category] = intval(round($averageScore));
                }
                $filter = "no";
            }
        } else {
            $averageInterest = "No result found";
            //  $teacherids = null;
        }

        // dd($years);
        ////////////////////////// COCU MERIT BY MONTH //////////////////////////

        $student = Student::find($id);
        $student_mykid = $student->mykid;

        if (isset($request->year)) {
            $record1 = Merit::where('student_mykid', '=', $student_mykid)
                ->where('type', '=', 'c')
                ->select(DB::raw("COUNT(*) as count"), DB::raw("SUM(merit_point) as merit_point"), DB::raw("MONTH(date) as month"))
                ->groupBy('month')
                ->when($request->year != null, function ($q) use ($request) {
                    $yearfilter = [];
                    foreach ($request->year as $filter) {
                        $yearfilter[] = (string)$filter;
                    }
                    return $q->whereIn(DB::raw('YEAR(date)'), $yearfilter);
                    // dd($yearfilter);
                })
                ->get();

            $allmonts = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']; // get all month
            $count_cocumerit = [];
            foreach ($allmonts as $test) {

                foreach ($record1 as $v) {
                    if ($test == $v->month) {
                        $count_cocumerit[$test] = $v->merit_point;
                        break;
                    } else {
                        $count_cocumerit[$test] = 0;
                    }
                }
            }

            foreach ($count_cocumerit as $row) {
                $data1['data'][] = (int)$row;
            }
            $data1['label'] = $allmonts;
        } else {
            $record1 = Merit::where('student_mykid', '=', $student_mykid)
                ->where('type', '=', 'c')
                ->select(DB::raw("COUNT(*) as count"), DB::raw("SUM(merit_point) as merit_point"), DB::raw("MONTH(date) as month"))
                ->groupBy('month')
                ->get();

            $allmonts = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']; // get all month
            $count_cocumerit = [];
            foreach ($allmonts as $test) {

                foreach ($record1 as $v) {
                    if ($test == $v->month) {
                        $count_cocumerit[$test] = $v->merit_point;
                        break;
                    } else {
                        $count_cocumerit[$test] = 0;
                    }
                }
            }

            foreach ($count_cocumerit as $row) {
                $data1['data'][] = (int)$row;
            }
            $data1['label'] = $allmonts;
        }


        ///////////////////// COCU MERIT ///////////////////////////////

        $student = Student::find($id);
        $student_mykid = $student->mykid;
        $record4 = Merit::where('student_mykid', '=', $student_mykid)
            ->where('type', '=', 'c')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("merit_name as merit_name"), DB::raw("merit_point as merit_point"), DB::raw("YEAR(date) as year"))
            ->groupBy('year', 'merit_name', 'merit_point')
            ->get();

        ///////////////////// BEHAVIOUR MERIT BY MONTH /////////////////////////

        if (isset($request->year)) {
            $record2 = Merit::where('student_mykid', '=', $student_mykid)
                ->where('type', '=', 'b')
                ->where('merit_point', '>', '0')
                ->select(DB::raw("COUNT(*) as count"), DB::raw("SUM(merit_point) as merit_point"), DB::raw("MONTH(date) as month"))
                ->groupBy('month')
                ->when($request->year != null, function ($q) use ($request) {
                    $yearfilter = [];
                    foreach ($request->year as $filter) {
                        $yearfilter[] = (string)$filter;
                    }
                    return $q->whereIn(DB::raw('YEAR(date)'), $yearfilter);
                    // dd($yearfilter);
                })
                ->get();

            $allmonts = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']; // get all month
            $count_behavmerit = [];
            foreach ($allmonts as $test) {

                foreach ($record2 as $v) {
                    if ($test == $v->month) {
                        $count_behavmerit[$test] = $v->merit_point;
                        break;
                    } else {
                        $count_behavmerit[$test] = 0;
                    }
                }
            }

            foreach ($count_behavmerit as $row) {
                $data2['data'][] = (int)$row;
            }
            $data2['label'] = $allmonts;
        } else {
            $record2 = Merit::where('student_mykid', '=', $student_mykid)
                ->where('type', '=', 'b')
                ->where('merit_point', '>', '0')
                ->select(DB::raw("COUNT(*) as count"), DB::raw("SUM(merit_point) as merit_point"), DB::raw("MONTH(date) as month"))
                ->groupBy('month')
                ->get();

            $allmonts = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']; // get all month
            $count_behavmerit = [];
            foreach ($allmonts as $test) {

                foreach ($record2 as $v) {
                    if ($test == $v->month) {
                        $count_behavmerit[$test] = $v->merit_point;
                        break;
                    } else {
                        $count_behavmerit[$test] = 0;
                    }
                }
            }

            foreach ($count_behavmerit as $row) {
                $data2['data'][] = (int)$row;
            }
            $data2['label'] = $allmonts;
        }

        ////////////////////// BEHAVIOUR MERIT //////////////////////////

        $record5 = Merit::where('student_mykid', '=', $student_mykid)
            ->where('type', '=', 'b')
            ->where('merit_point', '>', '0')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("merit_name as merit_name"), DB::raw("merit_point as merit_point"), DB::raw("YEAR(date) as year"))
            ->groupBy('year', 'merit_name', 'merit_point')
            ->get();

        /////////////////// BEHAVIOUR DEMERIT BY MONTH ///////////////////////

        if (isset($request->year)) {
            $record3 = Merit::where('student_mykid', '=', $student_mykid)
                ->where('type', '=', 'b')
                ->where('merit_point', '<', '0')
                ->select(DB::raw("COUNT(*) as count"), DB::raw("SUM(merit_point) as merit_point"), DB::raw("MONTH(date) as month"))
                ->groupBy('month')
                ->when($request->year != null, function ($q) use ($request) {
                    $yearfilter = [];
                    foreach ($request->year as $filter) {
                        $yearfilter[] = (string)$filter;
                    }
                    return $q->whereIn(DB::raw('YEAR(date)'), $yearfilter);
                    // dd($yearfilter);
                })
                ->get();

            $allmonts = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']; // get all month
            $count_behavdemerit = [];
            foreach ($allmonts as $test) {

                foreach ($record3 as $v) {
                    if ($test == $v->month) {
                        $count_behavdemerit[$test] = abs($v->merit_point);
                        break;
                    } else {
                        $count_behavdemerit[$test] = 0;
                    }
                }
            }

            foreach ($count_behavdemerit as $row) {
                $data3['data'][] = (int)$row;
            }
            $data3['label'] = $allmonts;
        } else {
            $record3 = Merit::where('student_mykid', '=', $student_mykid)
                ->where('type', '=', 'b')
                ->where('merit_point', '<', '0')
                ->select(DB::raw("COUNT(*) as count"), DB::raw("SUM(merit_point) as merit_point"), DB::raw("MONTH(date) as month"))
                ->groupBy('month')
                ->get();

            $allmonts = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']; // get all month
            $count_behavdemerit = [];
            foreach ($allmonts as $test) {

                foreach ($record3 as $v) {
                    if ($test == $v->month) {
                        $count_behavdemerit[$test] = abs($v->merit_point);
                        break;
                    } else {
                        $count_behavdemerit[$test] = 0;
                    }
                }
            }

            foreach ($count_behavdemerit as $row) {
                $data3['data'][] = (int)$row;
            }
            $data3['label'] = $allmonts;
        }

        /////////////////////// BEHAVIOUR DEMERIT /////////////////////////////

        $record6 = Merit::where('student_mykid', '=', $student_mykid)
            ->where('type', '=', 'b')
            ->where('merit_point', '<', '0')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("merit_name as merit_name"), DB::raw("merit_point as merit_point"), DB::raw("YEAR(date) as year"))
            ->groupBy('year', 'merit_name', 'merit_point')
            ->get();




        // send data
        $data['student_cocumerit'] = json_encode($data1);
        $data['student_behaviourmerit'] = json_encode($data2);
        $data['student_behaviourdemerit'] = json_encode($data3);
        $data['cocu_records'] = $record4;
        $data['behavmerit_records'] = $record5;
        $data['behavdemerit_records'] = $record6;
        $data['student'] = $student;
        $data['averageArr'] = $averageArr;
        $data['averagePerso'] = $averagePerso;
        $data['averageInterest'] = $averageInterest;
        // dd($data);
        $data['yearfilter'] = $yearfilter;
        $data['years'] = $years;
        $data['filter'] = $filter;


        return view('students.home', $data);
    }
    public function viewprofile()
    {
        $customfield = AutoFields::all();
        $studentname = auth()->user()->name;
        $studentid = Student::where('name', $studentname)->first()->id;
        $student = Student::find($studentid);
        $req = Profile_Request::where('student_mykid', '=', auth()->user()->nric_mykid)->orderBy('created_at', 'desc')->first();

        return view('students.viewprofile', compact('student', 'customfield', 'req'));
    }

    /* Student Route */
    public function updateprofile()
    {
        $student = Student::where('mykid', '=', auth()->user()->nric_mykid)->first();
        return view('students.updateProfile')->with('student', $student);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mykid' => 'required',
            // 'gender' =>'required',
            // 'class_id' =>'required',
            // 'citizenship' =>'required',
            // 'address' =>'required',
            // 'G1_name' =>'required',
            // 'G1_relation' =>'required',
            // 'G1_phonenum' =>'required',
            // 'G1_income' =>'required',
            // 'G2_name' =>'required',
            // 'G2_relation' =>'required',
            // 'G2_phonenum' =>'required',
            // 'G2_income' =>'required',
            // 'image' => 'required',
        ]);
        $data = $request->input();

        $student = new Student;

        $student->status = "active";
        $student->name = $data['name'];
        $student->mykid = $data['mykid'];
        $student->gender = $data['gender'];
        $student->classlist_id = null;
        $student->citizenship = $data['citizenship'];
        $student->address = $data['address'];
        $student->G1_name = $data['G1_name'];
        $student->G1_relation = $data['G1_relation'];
        $student->G1_phonenum = $data['G1_phonenum'];
        $student->G1_income = $data['G1_income'];
        $student->G2_name = $data['G2_name'];
        $student->G2_relation = $data['G2_relation'];
        $student->G2_phonenum = $data['G2_phonenum'];
        $student->G2_income = $data['G2_income'];

        $newImage = "";
        if ($request->hasFile('image')) {
            $newImage = $data['name'] . '.' . $request->image->extension();
            $request->image->move(public_path('assets\img\userImage'), $newImage);
            $student->image_path = $newImage;
        }

        if ($request->input('customfield') != null) {
            $additional = implode(",", $request->input('customfield'));
            $student->additional_Info = $additional;
        }
        // dd($string);
        $student->save();

        $user = new User;
        $user->name = $data['name'];
        if ($request->hasFile('image')) {
            $user->image_path = $newImage;
        }
        $user->image_path = $newImage;
        $user->nric_mykid = $data['mykid'];
        $user->type = 2;
        $user->email_verified_at = now();
        $user->password = Hash::make('secret');
        $user->created_at = now();
        $user->updated_at = now();
        $user->save();

        // Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        $classlist = $student->classlists;
        dd($classlist);
        return view('students.show')->with('student', $student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customfield = AutoFields::all();
        $student = Student::find($id);
        // $classlist = $student->classlists;
        // dd($classlist);
        // dd($student);
        // echo $student->class->class_name;
        return view('students.edit')->with('student', $student, 'customfield', $customfield);

        // $result = Student::with('classlists')->get();
        // return view('students.edit')->with('student',$result);

        // $classes = Classlist::find($id);
        // $student = Student::find($id);
        // return view('students.edit')->with('student',$student,'classes',$classes);
    }
    public function editstudent($id)
    {
        $customfield = AutoFields::all();
        $student = Student::find($id);
        // $classlist = $student->classlists;
        // dd($classlist);
        // dd($student);
        // echo $student->class->class_name;
        return view('teachers.editstudent')->with('student', $student, 'customfield', $customfield);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'mykid' => 'required',
            'gender' => 'required',
            // 'class' =>'required',
            'citizenship' => 'required',
            'address' => 'required',
            'G1_name' => 'required',
            'G1_relation' => 'required',
            'G1_phonenum' => 'required',
            'G1_income' => 'required',
            'G2_name' => 'required',
            'G2_relation' => 'required',
            'G2_phonenum' => 'required',
            'G2_income' => 'required',
        ]);

        $student = Student::find($id);
        if ($request->hasFile('imageS')) {
            $destination = "assets\img\userImage" . $student->image_path;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('imageS');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->input('name') . '.' . $extension;
            $file->move(public_path('assets\img\userImage'), $filename);
            $student->image_path = $filename;
        }

        // dd($request);

        $student->status = 'active';
        $student->name = $request->input('name');
        $student->mykid = $request->input('mykid');
        $student->gender = $request->input('gender');
        $student->citizenship = $request->input('citizenship');
        $student->address = $request->input('address');
        $student->G1_name = $request->input('G1_name');
        $student->G1_relation = $request->input('G1_relation');
        $student->G1_phonenum = $request->input('G1_phonenum');
        $student->G1_income = $request->input('G1_income');
        $student->G2_name = $request->input('G2_name');
        $student->G2_relation = $request->input('G2_relation');
        $student->G2_phonenum = $request->input('G2_phonenum');
        $student->G2_income = $request->input('G2_income');
        $student->updated_at = now();

        if ($request->input('customfield') != null) {
            $additional = implode(",", $request->input('customfield'));
            $student->additional_Info = $additional;
        }
        $student->update();

        $user = User::where('name', '=', $request->input('name'))->first();
        $user->name = $request->input('name');
        if ($request->hasFile('image')) {
            $user->image_path = $filename;
        }
        // $user->image_path = $newImage;
        $user->nric_mykid = $request->input('mykid');
        $user->type = 2;
        $user->email_verified_at = now();
        $user->password = Hash::make('secret');
        $user->created_at = now();
        $user->updated_at = now();
        $user->update();

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function updatestudent(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'mykid' => 'required',
            'gender' => 'required',
            // 'class' =>'required',
            'citizenship' => 'required',
            'address' => 'required',
            'G1_name' => 'required',
            'G1_relation' => 'required',
            'G1_phonenum' => 'required',
            'G1_income' => 'required',
            'G2_name' => 'required',
            'G2_relation' => 'required',
            'G2_phonenum' => 'required',
            'G2_income' => 'required',
        ]);

        $student = Student::find($id);
        if ($request->hasFile('imageS')) {
            $destination = "assets\img\userImage" . $student->image_path;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('imageS');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->input('name') . '.' . $extension;
            $file->move(public_path('assets\img\userImage'), $filename);
            $student->image_path = $filename;
        }

        // dd($request);

        $student->status = 'active';
        $student->name = $request->input('name');
        $student->mykid = $request->input('mykid');
        $student->gender = $request->input('gender');
        $student->citizenship = $request->input('citizenship');
        $student->address = $request->input('address');
        $student->G1_name = $request->input('G1_name');
        $student->G1_relation = $request->input('G1_relation');
        $student->G1_phonenum = $request->input('G1_phonenum');
        $student->G1_income = $request->input('G1_income');
        $student->G2_name = $request->input('G2_name');
        $student->G2_relation = $request->input('G2_relation');
        $student->G2_phonenum = $request->input('G2_phonenum');
        $student->G2_income = $request->input('G2_income');
        $student->updated_at = now();

        if ($request->input('customfield') != null) {
            $additional = implode(",", $request->input('customfield'));
            $student->additional_Info = $additional;
        }

        $student->update();
        // $student->update();
        // dd($request);
        return redirect()->route('studentlist')->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileImport(Request $request)
    {
        $validator = Validator::make(
            [
                'file'      => $request->file,
                'extension' => strtolower($request->file->getClientOriginalExtension()),
            ],
            [
                'file'          => 'required',
                'extension'      => 'required|in:csv,xlsx,xls',
            ]
        );

        Excel::import(new StudentsImport, $request->file('file')->store('temp'));
        return redirect()->route('students.index');
    }
}
