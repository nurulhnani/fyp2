<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Merit;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Classlist;
use App\Models\AutoFields;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Interest_Inventory_Results;
use App\Models\LoginCount;
use App\Models\Personality_Evaluation;

class AdminController extends Controller
{
    public function archiveStudent($id)
    {
        $status = "inactive";
        $updated_at = now();
        DB::update('update students set status=?, updated_at=? where id=?', [$status, $updated_at, $id]);
        return redirect()->back()->with('success', 'Student successfully archived!');
    }
    public function unarchiveStudent($id)
    {
        $status = "active";
        DB::update('update students set status=? where id=?', [$status, $id]);
        return redirect()->back()->with('success', 'Student successfully unarchived!');
    }
    public function archivedStudentList()
    {
        // $user = Auth::user();
        // $class = Classlist::all();
        $students = Student::all();
        //dd($student);
        return view('admin.archivedStudentList', ['students' => $students]);
    }
    public function archiveTeacher($id)
    {
        $status = "inactive";
        $updated_at = now();
        DB::update('update teachers set status=?, updated_at=? where id=?', [$status, $updated_at, $id]);
        return redirect()->back()->with('success', 'Teacher successfully archived!');
    }
    public function unarchiveTeacher($id)
    {
        $status = "active";
        DB::update('update teachers set status=? where id=?', [$status, $id]);
        return redirect()->back()->with('success', 'Teacher successfully unarchived!');
    }
    public function archivedTeacherList()
    {
        // $user = Auth::user();
        // $class = Classlist::all();
        $teachers = Teacher::all();
        //dd($student);
        return view('admin.archivedTeacherList', ['teachers' => $teachers]);
    }

    public function manageSubject()
    {
        // $user = Auth::user();
        $class = Classlist::all();
        $teacher = Teacher::all();
        // $subject = Subject::all();
        // return view('admin.manageSubject',['subjects' => $subject,'class'=>$class,'teacher'=>$teacher, 'user'=>$user]);
        $allsubjects = Subject::all();
        $subjects = Subject::leftJoin('subject_details', 'subject_details.subject_id', '=', 'subjects.id')
            // ->leftJoin('teachers','teachers.id','=','subject_details.subject_teacher')
            ->get()
            ->groupBy('subject_name');
        // $teachers = Subject_details::leftJoin('teachers','teachers.id','=','subject_details.subject_teacher')
        //             ->get()
        //             ->groupBy('name');
        //->get();
        // $subject_details = Subject_details::with('subjects')->get();
        // $subjects = Subject::with('subject_details')->get();
        //dd($subjects);
        //return view('admin.manageSubject',['subjects'=>$subjects,'subject_details'=>$subject_details,'user'=>$user]);
        return view('admin.manageSubject', compact('subjects', 'class', 'allsubjects', 'teacher'));
        //print_r($subjects);
    }
    public function addStudentInBulk()
    {
        return view('admin.addStudentInBulk');
    }
    public function addTeacherInBulk()
    {
        return view('admin.addTeacherInBulk');
    }
    public function customfield()
    {
        return view('customfield.index');
    }

    public function downloadstudentfile()
    {
        // $contents = file_get_contents('https://res.cloudinary.com/hme0x9wjh/raw/upload/v1673668020/big5_nbk4fu.xlsx');
        // file_put_contents('temp.xlsx', $contents);

    	$myFile = asset("assets/download/studentlist.xlsx");
    	$newName = 'student_template.xlsx';

    	return response()->download($myFile, $newName);
    }

    public function downloadteacherfile()
    {
    	$myFile = asset("assets/download/steacherlist.xlsx");
    	$newName = 'teacher_template.xlsx';

    	return response()->download($myFile, $newName);
    }

    public function chartjs(Request $request)
    {
        $allyear = LoginCount::selectRaw('YEAR(created_at) AS year') //get all year
            ->pluck('year')
            ->unique();

        // $getYear = LoginCount::select(DB::raw('YEAR(created_at) as year'))->groupBy('year')->get();
        // $allyear = []; 
        // foreach ($getYear as $record) {
        //     if (!in_array($record->year, $allyear)) {
        //         $allyear[] = $record->year;
        //     }
        // }
        //////////////// STUDENT ACTIVE //////////////////
        $record1 = Student::leftJoin('classlists', 'classlists.id', '=', 'students.classlist_id')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("YEAR(students.updated_at) as year"))
            ->where('status', '=', 'active')
            ->groupBy('year')
            ->when($request->grade != null, function ($q) use ($request) {
                $intgrade = [];
                foreach ($request->grade as $intg) {
                    $intgrade[] = (int)$intg;
                }
                return $q->whereIn('class_name', $intgrade);
            })
            ->when($request->year != null, function ($q) use ($request) {
                $yearfilter = [];
                foreach ($request->year as $filter) {
                    $yearfilter[] = $filter;
                }
                return $q->whereIn(DB::raw('YEAR(students.updated_at)'), $yearfilter);
                // dd($yearfilter);
            })
            ->get();

        $data1 = [];

        foreach ($record1 as $row) {
            $data1['label'][] = $row->year;
            $data1['data'][] = (int) $row->count;
        }
        // dd($record1);

        ////////////////// STUDENT INACTIVE ///////////////////////

        $record10 = Student::leftJoin('classlists', 'classlists.id', '=', 'students.classlist_id')
            ->select(DB::raw("COUNT(*) as count"), DB::raw('YEAR(students.updated_at) as year'))
            ->where('status', '=', 'inactive')
            ->groupBy('year')
            ->when($request->grade != null, function ($q) use ($request) {
                $intgrade = [];
                foreach ($request->grade as $intg) {
                    $intgrade[] = (int)$intg;
                }
                return $q->whereIn('class_name', $intgrade);
            })
            ->when($request->year != null, function ($q) use ($request) {
                $yearfilter = [];
                foreach ($request->year as $filter) {
                    $yearfilter[] = $filter;
                }
                return $q->whereIn(DB::raw('YEAR(students.updated_at)'), $yearfilter);
                // dd($yearfilter);
            })
            ->get();

        // $year = []; 
        // foreach ($allyear as $record) {
        //     if (!in_array($record->year, $year)) {
        //         $year[] = $record->year;
        //     }
        // }

        $countstudent_inactive = [];
        foreach ($allyear as $test) {

            foreach ($record10 as $v) {
                if ($test == $v->year) {
                    $countstudent_inactive[$test] = $v->count;
                    break;
                } else {
                    $countstudent_inactive[$test] = 0;
                }
            }
        }

        foreach ($countstudent_inactive as $row) {
            $data10['data'][] = (int)$row;
        }
        $data10['label'] = $allyear;

        ////////////////// TEACHER ACTIVE ////////////////

        $record2 = Teacher::select(DB::raw("COUNT(*) as count"), DB::raw("YEAR(updated_at) as year"))
            ->where('status', '=', 'active')
            ->groupBy('year')
            ->when($request->year != null, function ($q) use ($request) {
                $yearfilter = [];
                foreach ($request->year as $filter) {
                    $yearfilter[] = $filter;
                }
                return $q->whereIn(DB::raw('YEAR(updated_at)'), $yearfilter);
            })
            ->get();

        // dd($record2);
        $teachernum = [];

        foreach ($record2 as $row) {
            $teachernum[] = $row->count;
        }

        for ($i = 0; $i < count($teachernum); $i++) {
            if ($i > 0) $teachernum[$i] = $teachernum[$i] + $teachernum[$i - 1];
        }

        $data2 = [];
        foreach ($record2 as $row) {
            $data2['label'][] = $row->year;
            // $data2['data'][] = (int) $row->count;
        }
        $data2['data'] = $teachernum;


        ////////////////////// TEACHER INACTIVE //////////////////////

        $record3 = Teacher::select(DB::raw("COUNT(*) as count"), DB::raw("YEAR(updated_at) as year"))
            ->where('status', '=', 'inactive')
            ->groupBy('year')
            ->when($request->year != null, function ($q) use ($request) {
                $yearfilter = [];
                foreach ($request->year as $filter) {
                    $yearfilter[] = $filter;
                }
                return $q->whereIn(DB::raw('YEAR(updated_at)'), $yearfilter);
            })
            ->get();

        // $teacher = [];
        // dd($record3);

        // foreach($record3 as $row){
        //     $teacher[] = $row->count;
        // }

        $year = []; //get all year
        foreach ($record2 as $record) {
            if (!in_array($record->year, $year)) {
                $year[] = $record->year;
            }
        }

        $countteacher_inactive = [];
        foreach ($year as $test) {

            foreach ($record3 as $v) {
                if ($test == $v->year) {
                    $countteacher_inactive[$test] = $v->count;
                    break;
                } else {
                    $countteacher_inactive[$test] = 0;
                }
            }
        }

        foreach ($countteacher_inactive as $row) {
            $data3['data'][] = (int)$row;
        }
        $data3['label'] = $year;

        ////////////// STUDENT ACTIVE BY GENDER //////////////////

        $record4 = Student::leftJoin('classlists', 'classlists.id', '=', 'students.classlist_id')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("gender as gender"))
            ->where('status', '=', 'active')
            ->when($request->grade != null, function ($q) use ($request) {
                $intgrade = [];
                foreach ($request->grade as $intg) {
                    $intgrade[] = (int)$intg;
                }
                return $q->whereIn('class_name', $intgrade);
            })
            ->when($request->year != null, function ($q) use ($request) {
                $yearfilter = [];
                foreach ($request->year as $filter) {
                    $yearfilter[] = $filter;
                }
                return $q->whereIn(DB::raw('YEAR(students.updated_at)'), $yearfilter);
                // dd($yearfilter);
            })
            ->groupBy('gender')
            // ->orderBy('day')
            ->get();

        // dd($record);
        $data4 = [];

        foreach ($record4 as $row) {
            $data4['label'][] = $row->gender;
            $data4['data'][] = (int) $row->count;
        }

        ////////////////// TEACHER ACTIVE BY GENDER ////////////////////

        $record5 = Teacher::select(DB::raw("COUNT(*) as count"), DB::raw("gender as gender"))
            ->where('status', '=', 'active')
            ->groupBy('gender')
            ->when($request->year != null, function ($q) use ($request) {
                $yearfilter = [];
                foreach ($request->year as $filter) {
                    $yearfilter[] = $filter;
                }
                return $q->whereIn(DB::raw('YEAR(updated_at)'), $yearfilter);
                // dd($yearfilter);
            })
            // ->orderBy('day')
            ->get();

        // dd($record);
        $data5 = [];

        foreach ($record5 as $row) {
            $data5['label'][] = $row->gender;
            $data5['data'][] = (int) $row->count;
        }

        ///////////////active student count ///////////////
        $activestudent = Student::where('status','=','active')->count(); 

        /////////////// PERSONALITY EVAL COMPLETION ///////////////////
        $personalityevaluated = Personality_Evaluation::select(DB::raw("student_mykid as student_mykid")) 
                                ->when($request->year != null, function ($q) use ($request) {
                                    $yearfilter = [];
                                    foreach ($request->year as $filter) {
                                        $yearfilter[] = $filter;
                                    }
                                    return $q->whereIn(DB::raw('YEAR(created_at)'), $yearfilter);
                                })                    
                                ->groupBy('student_mykid')
                                ->get();
                                
                                
        $persocompletion =  (Count($personalityevaluated) / $activestudent)*100 ;
        $persoincomplete = 100 - $persocompletion;
        // dd($completion);

        /////////////// INTEREST INVENTORY COMPLETION ///////////////////
        $interestevaluated = Interest_Inventory_Results::select(DB::raw("student_id as student_id"))                      
                            ->when($request->year != null, function ($q) use ($request) {
                                $yearfilter = [];
                                foreach ($request->year as $filter) {
                                    $yearfilter[] = $filter;
                                }
                                return $q->whereIn(DB::raw('YEAR(created_at)'), $yearfilter);
                            })
                            ->groupBy('student_id')
                            ->get();
                                                     
        $interestcompletion =  (Count($interestevaluated) / $activestudent)*100 ;
        $interestincomplete = 100 - $interestcompletion;
        // dd(Count($interestevaluated));

        ////////////////////////// COCU MERIT //////////////////////////

        $record7 = Merit::where('type', '=', 'c')
            ->leftJoin('students', 'students.mykid', '=', 'merits.student_mykid')
            ->leftJoin('classlists', 'classlists.id', '=', 'students.classlist_id')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("SUM(merit_point) as merit_point"))
            ->groupBy('class_name')
            ->get();

        $data7 = [];

        foreach ($record7 as $row) {
            // $data7['label'][] = $row->student_mykid;
            $data7['data'][] = (int) $row->merit_point;
        }

        ///////////////////// BEHAVIOUR MERIT /////////////////////////

        $record8 = Merit::where('type', '=', 'b')
            ->where('merit_point', '>', '0')
            ->leftJoin('students', 'students.mykid', '=', 'merits.student_mykid')
            ->leftJoin('classlists', 'classlists.id', '=', 'students.classlist_id')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("SUM(merit_point) as merit_point"))
            ->groupBy('class_name')
            ->get();

        $data8 = [];

        foreach ($record8 as $row) {
            // $data7['label'][] = $row->student_mykid;
            $data8['data'][] = (int) $row->merit_point;
        }

        ///////////////////// BEHAVIOUR DEMERIT ////////////////////
        
        $record9 = Merit::where('type', '=', 'b')
            ->where('merit_point', '<', '0')
            ->leftJoin('students', 'students.mykid', '=', 'merits.student_mykid')
            ->leftJoin('classlists', 'classlists.id', '=', 'students.classlist_id')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("SUM(merit_point) as merit_point"))
            ->groupBy('class_name')
            ->get();

        $data9 = [];

        foreach ($record9 as $row) {
            // $data7['label'][] = $row->student_mykid;
            $data9['data'][] = (int) abs($row->merit_point);
        }

        /////////////////////// MALE ACTIVE STUDENT ////////////////////////
        $malestudent = Student::where('status','=','active')
                        ->where('gender','=','Male')
                        ->when($request->year != null, function ($q) use ($request) {
                            $yearfilter = [];
                            foreach ($request->year as $filter) {
                                $yearfilter[] = $filter;
                            }
                            return $q->whereIn(DB::raw('YEAR(updated_at)'), $yearfilter);
                        })
                        ->count();

        ////////////////////// FEMALE ACTIVE STUDENT //////////////////////
        $femalestudent = Student::where('status','=','active')
                        ->where('gender','=','Female')
                        ->when($request->year != null, function ($q) use ($request) {
                            $yearfilter = [];
                            foreach ($request->year as $filter) {
                                $yearfilter[] = $filter;
                            }
                            return $q->whereIn(DB::raw('YEAR(updated_at)'), $yearfilter);
                            // dd($yearfilter);
                        })
                        ->count();

        //////////////////// MALE ACTIVE TEACHER ////////////////////////
        $maleteacher = Teacher::where('status', '=', 'active')
                    ->where('gender', '=', 'Male')
                    ->when($request->year != null, function ($q) use ($request) {
                        $yearfilter = [];
                        foreach ($request->year as $filter) {
                            $yearfilter[] = $filter;
                        }
                        return $q->whereIn(DB::raw('YEAR(updated_at)'), $yearfilter);
                        // dd($yearfilter);
                    })
                    ->count();

        ///////////////////// FEMALE ACTIVE TEACHER////////////////////// 
        $femaleteacher = Teacher::where('status', '=', 'active')
                    ->where('gender', '=', 'Female')
                    ->when($request->year != null, function ($q) use ($request) {
                        $yearfilter = [];
                        foreach ($request->year as $filter) {
                            $yearfilter[] = $filter;
                        }
                        return $q->whereIn(DB::raw('YEAR(updated_at)'), $yearfilter);
                        // dd($yearfilter);
                    })
                    ->count();

        //////////////////// TEACHER LOGIN COUNT BY MONTH ///////////////////////
        if(isset($request->year)){
            $record12 = LoginCount::leftJoin('users', 'users.id', '=', 'login_count.user_id')
            ->select(DB::raw("COUNT(*) as count"), DB::raw('MONTH(login_count.created_at) as month'))
            ->where('type','=','1')
            ->groupBy('month')
            ->when($request->year != null, function ($q) use ($request) {
                $yearfilter = [];
                foreach ($request->year as $filter) {
                    $yearfilter[] = $filter;
                }
                return $q->whereIn(DB::raw('YEAR(login_count.created_at)'), $yearfilter);
                // dd($yearfilter);
            })
            ->get();

            $allmonts = ['1','2','3','4','5','6','7','8','9','10','11','12']; // get all month
            $count_teacherlogin = [];
            foreach ($allmonts as $test) {

                foreach ($record12 as $v) {
                    if ($test == $v->month) {
                        $count_teacherlogin[$test] = $v->count;
                        break;
                    } else {
                        $count_teacherlogin[$test] = 0;
                    }
                }
            }

            foreach ($count_teacherlogin as $row) {
                $data12['data'][] = (int)$row;
            }
            $data12['label'] = $allmonts;
        }else{
            $record12 = LoginCount::leftJoin('users', 'users.id', '=', 'login_count.user_id')
            ->select(DB::raw("COUNT(*) as count"), DB::raw('MONTH(login_count.created_at) as month'))
            ->where('type','=','1')
            ->groupBy('month')
            ->get();

            $allmonts = ['1','2','3','4','5','6','7','8','9','10','11','12']; // get all month
            $count_teacherlogin = [];
            foreach ($allmonts as $test) {

                foreach ($record12 as $v) {
                    if ($test == $v->month) {
                        $count_teacherlogin[$test] = $v->count;
                        break;
                    } else {
                        $count_teacherlogin[$test] = 0;
                    }
                }
            }

            foreach ($count_teacherlogin as $row) {
                $data12['data'][] = (int)$row;
            }
            $data12['label'] = $allmonts;
        }

        //////////////////// STUDENT LOGIN COUNT BY MONTH ///////////////////////

        if(isset($request->year)){
            $record13 = LoginCount::leftJoin('users', 'users.id', '=', 'login_count.user_id')
            ->select(DB::raw("COUNT(*) as count"), DB::raw('MONTH(login_count.created_at) as month'))
            ->where('type','=','2')
            ->groupBy('month')
            ->when($request->year != null, function ($q) use ($request) {
                $yearfilter = [];
                foreach ($request->year as $filter) {
                    $yearfilter[] = $filter;
                }
                return $q->whereIn(DB::raw('YEAR(login_count.created_at)'), $yearfilter);
                // dd($yearfilter);
            })
            ->get();

            $count_studentlogin = [];
            foreach ($allmonts as $test) {

                foreach ($record13 as $v) {
                    if ($test == $v->month) {
                        $count_studentlogin[$test] = $v->count;
                        break;
                    } else {
                        $count_studentlogin[$test] = 0;
                    }
                }
            }

            foreach ($count_studentlogin as $row) {
                $data13['data'][] = (int)$row;
            }
            $data13['label'] = $allmonts;
        }else{
            $record13 = LoginCount::leftJoin('users', 'users.id', '=', 'login_count.user_id')
            ->select(DB::raw("COUNT(*) as count"), DB::raw('MONTH(login_count.created_at) as month'))
            ->where('type','=','2')
            ->groupBy('month')
            ->get();

            $count_studentlogin = [];
            foreach ($allmonts as $test) {

                foreach ($record13 as $v) {
                    if ($test == $v->month) {
                        $count_studentlogin[$test] = $v->count;
                        break;
                    } else {
                        $count_studentlogin[$test] = 0;
                    }
                }
            }

            foreach ($count_studentlogin as $row) {
                $data13['data'][] = (int)$row;
            }
            $data13['label'] = $allmonts;
        }
        

        //////////////////// TOP 5 TEACHER LOGIN //////////////////////
        $teacherlogin = LoginCount::leftJoin('users', 'users.id', '=', 'login_count.user_id')
        ->select(DB::raw("COUNT(*) as count"),DB::raw("users.name as name")) 
        ->where('type','=','1')
        ->groupBy('name')
        ->orderBy('count','DESC')
        ->paginate(5);


         //////////////////// TOP 5 STUDENT LOGIN //////////////////////
         $studentlogin = LoginCount::leftJoin('users', 'users.id', '=', 'login_count.user_id')
         ->select(DB::raw("COUNT(*) as count"),DB::raw("users.name as name")) 
         ->where('type','=','2')
         ->groupBy('name')
         ->orderBy('count','DESC')
         ->paginate(5);

        

        ////// send data /////
        // $data['chart_student'] = json_encode($data1);
        // $data['chart_studentinactive'] = json_encode($data10);
        // $data['chart_teacher'] = json_encode($data2);
        // $data['chart_teacherinactive'] = json_encode($data3);
        // $data['student_gender'] = json_encode($data4);
        // $data['teacher_gender'] = json_encode($data5);
        // $data['student_cocumerit'] = json_encode($data7);
        // $data['student_behaviourmerit'] = json_encode($data8);
        // $data['student_behaviourdemerit'] = json_encode($data9);
        // $data['teacher_login_counts'] = json_encode($data12);
        // $data['student_login_counts'] = json_encode($data13);
        // $data['malestudent'] = $malestudent;
        // $data['femalestudent'] = $femalestudent;
        // $data['maleteacher'] = $maleteacher;
        // $data['femaleteacher'] = $femaleteacher;
        // $data['teacherlogin'] = $teacherlogin;
        // $data['studentlogin'] = $studentlogin;
        // $data['years'] = $allyear;
        // $data['activestudent'] = $activestudent;
        // $data['personalityevaluated'] = $personalityevaluated;
        // $data['persocompletion'] = $persocompletion;
        // $data['persoincomplete'] = $persoincomplete;
        // $data['interestevaluated'] = $interestevaluated;
        // $data['interestcompletion'] = $interestcompletion;
        // $data['interestincomplete'] = $interestincomplete;

        $chart_student = json_encode($data1);
        $chart_studentinactive = json_encode($data10);
        $chart_teacher = json_encode($data2);
        $chart_teacherinactive = json_encode($data3);
        $student_gender = json_encode($data4);
        $teacher_gender = json_encode($data5);
        $student_cocumerit = json_encode($data7);
        $student_behaviourmerit = json_encode($data8);
        $student_behaviourdemerit = json_encode($data9);
        $teacher_login_counts = json_encode($data12);
        $student_login_counts = json_encode($data13);
        $malestudent = $malestudent;
        $femalestudent = $femalestudent;
        $maleteacher = $maleteacher;
        $femaleteacher = $femaleteacher;
        $teacherlogin = $teacherlogin;
        $studentlogin = $studentlogin;
        $years = $allyear;
        $activestudent = $activestudent;
        $personalityevaluated = $personalityevaluated;
        $persocompletion = $persocompletion;
        $persoincomplete = $persoincomplete;
        $interestevaluated = $interestevaluated;
        $interestcompletion = $interestcompletion;
        $interestincomplete = $interestincomplete;

        // return view('admin.home', $data);
        return view('admin.home', compact(
            'chart_student',
            'chart_studentinactive',
            'chart_teacher',
            'chart_teacherinactive',
            'student_gender',
            'teacher_gender',
            'teacher_login_counts',
            'student_login_counts',
            'malestudent',
            'femalestudent',
            'maleteacher',
            'femaleteacher',
            'teacherlogin',
            'studentlogin',
            'years',
            'activestudent',
            'personalityevaluated',
            'persocompletion',
            'persoincomplete',
            'interestevaluated',
            'interestcompletion',
            'interestincomplete'
        ));
    }
}
