<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Classlist;
use App\Models\AutoFields;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::latest()->paginate(5);
        $class = Classlist::all();
        return view('students.index',compact('students','class'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function overview()
    {
        return view('students.overview');
    }
    public function history()
    {
        return view('students.history');
    }
    public function viewprofile()
    {
        $studentname = auth()->user()->name;
        $studentid = Student::where('name',$studentname)->first()->id;
        $student = Student::find($studentid);
        // dd($studentid);
        return view('students.viewprofile')->with('student',$student);
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
            'gender' =>'required',
            // 'class_id' =>'required',
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
            'image' => 'required',
        ]);
        $data = $request->input();
        
        $student = new Student;
        $newImage = $data['name'].'.'.$request->image->extension();
        $request->image->move(public_path('assets\img\userImage'),$newImage);

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
        $student->image_path = $newImage;

        if($request->input('customfield') != null){
            $additional=implode(",",$request->input('customfield'));
            $student->additional_Info = $additional;
        }
        // dd($string);
        $student -> save();

        $user = new User;
        $user->name = $data['name'];
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
        $student->classlist_id = null;
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

        $additional=implode(",",$request->input('customfield'));
        $student->additional_Info = $additional;
        
        $student->update();
        // $student->update();
        // dd($request);
        return redirect()->route('students.index')->with('success','Student updated successfully');
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
        Excel::import(new StudentsImport, $request->file('file')->store('temp'));
        return redirect()->route('students.index');
    }
}
