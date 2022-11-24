<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Classlist;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    public function chartjs(){
        $record = Student::select(DB::raw("COUNT(*) as count"),DB::raw("SUM(G1_income) as G1_income"),DB::raw("classlist_id as classlist_id"))
        // ->where('created_at', '>', Carbon::today()->subDay(6))
        ->groupBy('classlist_id')
        // ->orderBy('day')
        ->get();
    
        $data = [];
    
        foreach($record as $row) {
            $data['label'][] = $row->classlist_id;
            $data['data'][] = (int) $row->G1_income;
        }
    
        $data['chart_data'] = json_encode($data);
        return view('admin.home', $data);
    }
}
