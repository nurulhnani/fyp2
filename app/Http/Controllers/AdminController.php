<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Merit;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Classlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Interest_Inventory_Results;

class AdminController extends Controller
{
    public function manageStudent()
    {
        // $user = Auth::user();
        // $class = Classlist::all();
        $students = Student::all();
        //dd($student);
        return view('admin.manageStudent', ['students'=>$students]);
    }
    public function viewStudentProfile($id)
    {
        // $user = Auth::user();
        // $class = Classlist::all();
        $student = Student::find($id);
        return view('admin.viewStudentProfile',['student' => $student]);
        // return view('admin.viewStdProfile-PD');
    }
    public function addNewStudent()
    {
        // $user = Auth::user();
        // $class = Classlist::all();
        return view('admin.addNewStudent');
    }
    public function addstudent(Request $request){
        $request->validate([
            'name'=>'required',
            'mykid' =>'required',
            'gender' =>'required',
            'class' =>'required',
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
            
        Student::create($request->all());

        // return redirect('manageStudent')->with('success',$data['name']." was successfully added!");
        return redirect()->route('manageStudent')
                        ->with('success','Student created successfully.');
    }
    public function archiveStudent($id){
        $status = "inactive";
        DB::update('update students set status=? where id=?',[$status,$id]);
        return redirect()->back();
    }
    public function unarchiveStudent($id){
        $status = "active";
        DB::update('update students set status=? where id=?',[$status,$id]);
        return redirect()->back();
    }
    public function archivedStudentList()
    {
        // $user = Auth::user();
        // $class = Classlist::all();
        $students = Student::all();
        //dd($student);
        return view('admin.archivedStudentList', ['students'=>$students]);
    }
    public function manageTeacher()
    {
        // $user = Auth::user();
        // $class = Classlist::all();
        $teachers = Teacher::all();
        //dd($student);
        return view('admin.manageTeacher', ['teachers'=>$teachers]);
    }
    public function viewTeacherProfile($id)
    {
        // $user = Auth::user();
        // $class = Classlist::all();
        $teacher = Teacher::find($id);
        return view('admin.viewTeacherProfile',['teacher' => $teacher]);
        // return view('admin.viewStdProfile-PD');
    }
    public function addNewTeacher()
    {
        // $user = Auth::user();
        // $class = Classlist::all();
        return view('admin.addNewTeacher');
    }
    public function archiveTeacher($id){
        $status = "inactive";
        DB::update('update teachers set status=? where id=?',[$status,$id]);
        return redirect()->back();
    }
    public function unarchiveTeacher($id){
        $status = "active";
        DB::update('update teachers set status=? where id=?',[$status,$id]);
        return redirect()->back();
    }
    public function archivedTeacherList()
    {
        // $user = Auth::user();
        // $class = Classlist::all();
        $teachers = Teacher::all();
        //dd($student);
        return view('admin.archivedTeacherList', ['teachers'=>$teachers]);
    }
    public function manageClasses()
    {
        // $user = Auth::user();
        $class = Classlist::all();
        $student = Student::all();
        $teacher = Teacher::all();
        return view('admin.manageClass',['classes'=>$class,'student'=>$student,'teacher'=>$teacher]);
    }
    public function manageSubject()
    {
        // $user = Auth::user();
        $class = Classlist::all();
        $teacher = Teacher::all();
        // $subject = Subject::all();
        // return view('admin.manageSubject',['subjects' => $subject,'class'=>$class,'teacher'=>$teacher, 'user'=>$user]);
        $allsubjects = Subject::all();
        $subjects = Subject::leftJoin('subject_details','subject_details.subject_id','=','subjects.id')
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
        return view('admin.manageSubject', compact('subjects','class','allsubjects','teacher'));
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
    public function customfield(){
        return view('customfield.index');
    }
    public function chartjs(Request $request){

        $record1 = Student::leftJoin('classlists','classlists.id','=','students.classlist_id')
        ->select(DB::raw("COUNT(*) as count"),DB::raw('YEAR(students.updated_at) as year'))
        ->where('status', '=', 'active')
        ->groupBy('year')
        ->when($request->grade != null, function ($q) use ($request){
            $intgrade = [];
            foreach($request->grade as $intg){
                $intgrade[]= (int)$intg;
            }
            return $q->whereIn('class_name',$intgrade);
            })
        ->get();

        $data1 = [];
    
        foreach($record1 as $row) {
            $data1['label'][] = $row->year;
            $data1['data'][] = (int) $row->count;
        }
        // dd($record1);

        $record10 = Student::leftJoin('classlists','classlists.id','=','students.classlist_id')
        ->select(DB::raw("COUNT(*) as count"),DB::raw('YEAR(students.updated_at) as year'))
        ->where('status', '=', 'inactive')
        ->groupBy('year')
        ->when($request->grade != null, function ($q) use ($request){
            $intgrade = [];
            foreach($request->grade as $intg){
                $intgrade[]= (int)$intg;
            }
            return $q->whereIn('class_name',$intgrade);
            })
        ->get();

        $year = [];
        foreach($record10 as $record){
            if(!in_array($record->year,$year)){
                $year[] = $record->year;
            }
        }

        $data10 = [];
    
        $count_inactive = [];
        foreach($record1 as $test) {
            if(in_array($test->year,$year)){
                $count_inactive[] = $test->count; 
            }else{
                $count_inactive[] = 0;
            }
        }

        foreach($count_inactive as $row) {
            // $data10['label'][] = ["2020","2021","2022"];
            $data10['data'][] = (int)$row;
        }
        // dd($data10['data']);

        $record2 = Teacher::select(DB::raw("COUNT(*) as count"),DB::raw("YEAR(updated_at) as year"))
        ->where('status', '=', 'active')
        ->groupBy('year')
        ->when($request->gender != null, function ($q) use ($request){
            return $q->where('gender','=',$request->gender);
            })
        ->get();
    
        $data2 = [];
    
        foreach($record2 as $row) {
            $data2['label'][] = $row->year;
            // $data2['label'][] = $row->status;
            $data2['data'][] = (int) $row->count;
        }

        $record3 = Teacher::select(DB::raw("COUNT(*) as count"),DB::raw("YEAR(updated_at) as year"))
        ->where('status', '=', 'inactive')
        ->groupBy('year')
        ->when($request->gender != null, function ($q) use ($request){
            return $q->where('gender','=',$request->gender);
            })
        ->get();

        // dd($record3);
    
        // dd($record);
        $data3 = [];
    
        foreach($record3 as $row) {
            $data3['label'][] = $row->year;
            $data3['data'][] = (int) $row->count;
        }

        $record4 = Student::leftJoin('classlists','classlists.id','=','students.classlist_id')
        ->select(DB::raw("COUNT(*) as count"),DB::raw("gender as gender"))
        ->where('status', '=', 'active')
        ->when($request->grade != null, function ($q) use ($request){
            $intgrade = [];
            foreach($request->grade as $intg){
                $intgrade[]= (int)$intg;
            }
            return $q->whereIn('class_name',$intgrade);
            })
        ->groupBy('gender')
        // ->orderBy('day')
        ->get();
    
        // dd($record);
        $data4 = [];
    
        foreach($record4 as $row) {
            $data4['label'][] = $row->gender;
            $data4['data'][] = (int) $row->count;
        }

        $record5 = Teacher::select(DB::raw("COUNT(*) as count"),DB::raw("gender as gender"))
        ->where('status', '=', 'active')
        ->groupBy('gender')
        // ->orderBy('day')
        ->get();
    
        // dd($record);
        $data5 = [];
    
        foreach($record5 as $row) {
            $data5['label'][] = $row->gender;
            $data5['data'][] = (int) $row->count;
        }

        $record6 = Interest_Inventory_Results::select(DB::raw("COUNT(*) as count"),DB::raw("student_id as student_id"))
        // ->where('status', '=', 'active')
        ->groupBy('student_id')
        // ->orderBy('day')
        ->get();
    
        // dd($record6);
        $data6 = [];
    
        foreach($record6 as $row) {
            $data6['label'][] = ["completed","incomplete"];
            $data6['data'][] = (int) $row->count;
        }

        // $data6['data'] = count($record6);

        $record7 = Merit::where('type', '=', 'c')
        ->leftJoin('students','students.mykid','=','merits.student_mykid')
        ->leftJoin('classlists','classlists.id','=','students.classlist_id')
        ->select(DB::raw("COUNT(*) as count"),DB::raw("SUM(merit_point) as merit_point"))
        ->groupBy('class_name')
        ->get();

        $data7 = [];
    
        foreach($record7 as $row) {
            // $data7['label'][] = $row->student_mykid;
            $data7['data'][] = (int) $row->merit_point;
        }

        $record8 = Merit::where('type', '=', 'b')
        ->where('merit_point', '>', '0')
        ->leftJoin('students','students.mykid','=','merits.student_mykid')
        ->leftJoin('classlists','classlists.id','=','students.classlist_id')
        ->select(DB::raw("COUNT(*) as count"),DB::raw("SUM(merit_point) as merit_point"))
        ->groupBy('class_name')
        ->get();

        $data8 = [];
    
        foreach($record8 as $row) {
            // $data7['label'][] = $row->student_mykid;
            $data8['data'][] = (int) $row->merit_point;
        }

        $record9 = Merit::where('type', '=', 'b')
        ->where('merit_point', '<', '0')
        ->leftJoin('students','students.mykid','=','merits.student_mykid')
        ->leftJoin('classlists','classlists.id','=','students.classlist_id')
        ->select(DB::raw("COUNT(*) as count"),DB::raw("SUM(merit_point) as merit_point"))
        ->groupBy('class_name')
        ->get();

        $data9 = [];
    
        foreach($record9 as $row) {
            // $data7['label'][] = $row->student_mykid;
            $data9['data'][] = (int) abs($row->merit_point);
        }
    
        $data['chart_student'] = json_encode($data1);
        $data['chart_studentinactive'] = json_encode($data10);
        $data['chart_teacher'] = json_encode($data2);
        $data['chart_teacherinactive'] = json_encode($data3);
        $data['student_gender'] = json_encode($data4);
        $data['teacher_gender'] = json_encode($data5);
        $data['interest_eval'] = json_encode($data6);
        $data['student_cocumerit'] = json_encode($data7);
        $data['student_behaviourmerit'] = json_encode($data8);
        $data['student_behaviourdemerit'] = json_encode($data9);

        return view('admin.home', $data);
    }
}
