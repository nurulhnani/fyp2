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
        return view('students.index',compact('students','class'));
    }

    public function overview($id)
    {
        $student = Student::find($id);
        $categoryArray = array("Realistic", "Investigative", "Artistic", "Social", "Enterprising","Conventional");
        if(Interest_Inventory_Results::where('student_id',$id)->exists()){
            foreach ($categoryArray as $category) {
                $averageScore = Interest_Inventory_Results::where('student_id',$id)->avg($category);
                $averageArr[$category] = intval(round($averageScore));
            }

            $result = Interest_Inventory_Results::where('student_id',$id)->get();

            // $realistic = 0;
            // $investigative = 0;
            // $artistic = 0;
            // $social = 0;
            // $enterprising = 0;
            // $conventional = 0;
            $teacherids = [];
            // $total = 0;
            foreach($result as $res){
                if(!in_array($res->teacher_id,$teacherids)){
                    $teacherids[] = $res->teacher_id;
                }
                
                // $realistic += $res->realistic;
                // $total += $res->realistic;
                // $investigative += $res->investigative;
                // $total += $res->investigative;
                // $artistic += $res->artistic;
                // $total += $res->artistic;
                // $social += $res->social;
                // $total += $res->social;
                // $enterprising += $res->enterprising;
                // $total += $res->enterprising;
                // $conventional += $res->conventional;
                // $total += $res->conventional;
            }

            // dd($teacherids);
            // $result = new Interest_Inventory_Results;
            // $result->realistic = $realistic;
            // $result->investigative = $investigative;
            // $result->artistic =  $artistic;
            // $result->social = $social;
            // $result->enterprising =  $enterprising;
            // $result->conventional =  $conventional;

            // $realistic = ($realistic/$total)*100;
            // $investigative = ($investigative/$total)*100;
            // $artistic = ($artistic/$total)*100;
            // $social = ($social/$total)*100;
            // $enterprising = ($enterprising/$total)*100;
            // $conventional = ($conventional/$total)*100;
            // $data = [$realistic,$investigative,$artistic,$social,$enterprising,$conventional];
            // dd($data);
        }else{
            $averageArr = "No result found";
            // $data = null;
            $teacherids = null;
        }

        // return view('students.overview',compact('student','result','teacherids','data'));
        return view('students.overview',compact('student','teacherids','averageArr'));
    }
    public function dashboard($id)
    {
        ////////////////////////// COCU MERIT BY YEAR //////////////////////////

        $student = Student::find($id);
        $student_mykid = $student->mykid;
        $record1 = Merit::where('student_mykid','=',$student_mykid)
            ->where('type', '=', 'c')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("SUM(merit_point) as merit_point"),DB::raw("YEAR(updated_at) as year"))
            ->groupBy('year')
            ->get();

        $data1 = [];
        // $cocu = [];
        // $year = [];

        foreach ($record1 as $row) {
            $data1['label'][] = $row->year;
            // $year[] = $row->year;
            $data1['data'][] = (int) $row->merit_point;
            // $cocu[] = (int) $row->merit_point;
        }

        ///////////////////// COCU MERIT ///////////////////////////////

        $student = Student::find($id);
        $student_mykid = $student->mykid;
        $record4 = Merit::where('student_mykid','=',$student_mykid)
            ->where('type', '=', 'c')
            ->select(DB::raw("COUNT(*) as count"),DB::raw("merit_name as merit_name"), DB::raw("merit_point as merit_point"),DB::raw("YEAR(updated_at) as year"))
            ->groupBy('year','merit_name','merit_point')
            ->get();
            // ->paginate(4);
        
        ///////////////////// BEHAVIOUR MERIT BY YEAR /////////////////////////

        $record2 = Merit::where('student_mykid','=',$student_mykid)
            ->where('type', '=', 'b')
            ->where('merit_point', '>', '0')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("SUM(merit_point) as merit_point"),DB::raw("YEAR(updated_at) as year"))
            ->groupBy('year')
            ->get();

        $data2 = [];

        foreach ($record2 as $row) {
            $data2['label'][] = $row->year;
            $data2['data'][] = (int) $row->merit_point;
        }

        ////////////////////// BEHAVIOUR MERIT //////////////////////////

        $record5 = Merit::where('student_mykid','=',$student_mykid)
            ->where('type', '=', 'b')
            ->where('merit_point', '>', '0')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("merit_name as merit_name"), DB::raw("merit_point as merit_point"),DB::raw("YEAR(updated_at) as year"))
            ->groupBy('year','merit_name','merit_point')
            ->get();

        /////////////////// BEHAVIOUR DEMERIT BY YEAR ///////////////////////

        $record3 = Merit::where('type', '=', 'b')
            ->where('merit_point', '<', '0')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("SUM(merit_point) as merit_point"),DB::raw("YEAR(updated_at) as year"))
            ->groupBy('year')
            ->get();

        $data3 = [];

        foreach ($record3 as $row) {
            $data3['label'][] = $row->year;
            $data3['data'][] = (int) abs($row->merit_point);
        }

        /////////////////////// BEHAVIOUR MERIT /////////////////////////////

        $record6 = Merit::where('type', '=', 'b')
            ->where('merit_point', '<', '0')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("merit_name as merit_name"), DB::raw("merit_point as merit_point"),DB::raw("YEAR(updated_at) as year"))
            ->groupBy('year','merit_name','merit_point')
            ->get();

        // send data
        $data['student_cocumerit'] = json_encode($data1);
        $data['student_behaviourmerit'] = json_encode($data2);
        $data['student_behaviourdemerit'] = json_encode($data3);
        $data['cocu_records']= $record4;
        $data['behavmerit_records']= $record5;
        $data['behavdemerit_records']= $record6;
        $data['student'] = $student;
        // dd($data['cocu_records']);
        // $data['cocu'] = $cocu;
        // $data['year'] = $year;
 
        return view('students.home',$data);
    }
    public function viewprofile()
    {
        $customfield = AutoFields::all();
        $studentname = auth()->user()->name;
        $studentid = Student::where('name',$studentname)->first()->id;
        $student = Student::find($studentid);
        // dd($studentid);
        return view('students.viewprofile')->with('student',$student,'customfield',$customfield);
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
            'name'=>'required',
            'mykid' =>'required',
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
        if($request->hasFile('image')){
            $newImage = $data['name'].'.'.$request->image->extension();
            $request->image->move(public_path('assets\img\userImage'),$newImage);
            $student->image_path = $newImage;
        }      

        if($request->input('customfield') != null){
            $additional=implode(",",$request->input('customfield'));
            $student->additional_Info = $additional;
        }
        // dd($string);
        $student -> save();

        $user = new User;
        $user->name = $data['name'];
        if($request->hasFile('image')){
            $user->image_path = $newImage;
        }
        $user->image_path = $newImage;
        $user->email = $data['mykid'];
        $user->type = 2;
        $user->email_verified_at = now();
        $user->password = Hash::make('secret');
        $user->created_at = now();
        $user->updated_at = now();
        $user->save();

        // Student::create($request->all());
        return redirect()->route('students.index')->with('success','Student created successfully.');
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
        return view('students.show')->with('student',$student);
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
        return view('students.edit')->with('student',$student,'customfield',$customfield);

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
        return view('teachers.editstudent')->with('student',$student,'customfield',$customfield);
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
            'name'=>'required',
            'mykid' =>'required',
            'gender' =>'required',
            // 'class' =>'required',
            'citizenship' =>'required',
            'address' =>'required',
            'G1_name' =>'required',
            'G1_relation' =>'required',
            'G1_phonenum' =>'required',
            'G1_income' =>'required',
            'G2_name' =>'required',
            'G2_relation' =>'required',
            'G2_phonenum' =>'required',
            'G2_income' =>'required',
        ]);

        $student = Student::find($id);
        if($request->hasFile('imageS')){
            $destination = "assets\img\userImage".$student->image_path;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('imageS');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->input('name').'.'.$extension;
            $file->move(public_path('assets\img\userImage'),$filename);
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

        if($request->input('customfield') != null) {
            $additional=implode(",",$request->input('customfield'));
            $student->additional_Info = $additional;
        }
        $student->update();
        // $student->update();
        // dd($request);
        return redirect()->route('students.index')->with('success','Student updated successfully');
    }

    public function updatestudent(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'name'=>'required',
            'mykid' =>'required',
            'gender' =>'required',
            // 'class' =>'required',
            'citizenship' =>'required',
            'address' =>'required',
            'G1_name' =>'required',
            'G1_relation' =>'required',
            'G1_phonenum' =>'required',
            'G1_income' =>'required',
            'G2_name' =>'required',
            'G2_relation' =>'required',
            'G2_phonenum' =>'required',
            'G2_income' =>'required',
        ]);

        $student = Student::find($id);
        if($request->hasFile('imageS')){
            $destination = "assets\img\userImage".$student->image_path;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('imageS');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->input('name').'.'.$extension;
            $file->move(public_path('assets\img\userImage'),$filename);
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

        if($request->input('customfield') != null) {
            $additional=implode(",",$request->input('customfield'));
            $student->additional_Info = $additional;
        }
        
        $student->update();
        // $student->update();
        // dd($request);
        return redirect()->route('studentlist')->with('success','Student updated successfully');
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
                        ->with('success','Student deleted successfully');
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
