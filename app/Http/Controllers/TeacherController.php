<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\AutoFields;
use Illuminate\Http\Request;
use App\Imports\TeachersImport;
use App\Models\Subject_details;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::latest()->paginate(5);
      
        return view('teachers.index',compact('teachers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function viewprofile()
    {
        $teachername = auth()->user()->name;
        $teacherid = Teacher::where('name',$teachername)->first()->id;
        $teacher = Teacher::find($teacherid);

        $customfield = AutoFields::all();
        $subject_taughts = Subject_details::where('teacher_id',$teacher->id)->get();
        $data = [];
        if($subject_taughts != null){
            foreach ( $subject_taughts as $subject_taught ) {
                $subjectname = Subject::where('id',$subject_taught->subject_id)->first()->subject_name;
                $subjectgrade = Subject::where('id',$subject_taught->subject_id)->first()->grade;
                $data[] = 
                    $subjectname.' '.$subjectgrade
                ;
            }
            $subject = implode(",",$data);
        }

        return view('teachers.viewprofile',compact('teacher','customfield','subject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
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
            'nric' =>'required',
            'gender' =>'required',
            'email' =>'required',
            'position' =>'required',
            'address' =>'required',
            // 'subject_taught' =>'required',
            // 'class_name' =>'required',
            'phone_number' =>'required',
            'phone_number' =>'required',
            'image' => 'required',
        ]);

        $data = $request->input();
        $teacher = new Teacher();
        $newImage = $data['name'].'.'.$request->image->extension();
        $request->image->move(public_path('assets\img\userImage'),$newImage);

        // insert into teacher table
        $teacher->status = "active";
        $teacher->name = $data['name'];
        $teacher->nric = $data['nric'];
        $teacher->gender = $data['gender'];
        $teacher->position = $data['position'];
        $teacher->address = $data['address'];
        $teacher->email = $data['email'];
        // $teacher->subject_taught = $data['subject_taught'];
        // $teacher->class_name = $data['class_name'];
        $teacher->phone_number = $data['phone_number'];   
        $teacher->image_path = $newImage;
        if($request->input('customfield') != null) {
            $additional=implode(",",$request->input('customfield'));
            $teacher->additional_Info = $additional;
        }
        $teacher -> save();

        $user = new User;
        $user->name = $data['name'];
        $user->image_path = $newImage;
        $user->email = $data['email'];
        $user->type = 1;
        $user->email_verified_at = now();
        $user->password = Hash::make('secret');
        $user->created_at = now();
        $user->updated_at = now();
        $user->save();

        return redirect()->route('teachers.index')->with('success','Teacher created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('teachers.show',compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $customfield = AutoFields::all();
        $subject_taughts = Subject_details::where('teacher_id',$teacher->id)->get();
        $data = [];
        if($subject_taughts != null){
            foreach ( $subject_taughts as $subject_taught ) {
                $subjectname = Subject::where('id',$subject_taught->subject_id)->first()->subject_name;
                $subjectgrade = Subject::where('id',$subject_taught->subject_id)->first()->grade;
                $data[] = 
                    $subjectname.' '.$subjectgrade
                ;
            }
            $subject = implode(",",$data);
        }
        
        return view('teachers.edit',compact('teacher','customfield','subject'));
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
            'nric' =>'required',
            'gender' =>'required',
            'email' =>'required',
            'position' =>'required',
            'address' =>'required',
            // 'subject_taught' =>'required',
            // 'class_name' =>'required',
            'phone_number' =>'required',
        ]);

        $teacher = Teacher::find($id);
        if($request->hasFile('imageT')){
            $destination = "assets\img\userImage".$teacher->image_path;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('imageT');
            $extension = $file->getClientOriginalExtension();
            $filename = $teacher->name.'.'.$extension;
            $file->move(public_path('assets\img\userImage'),$filename);
            $teacher->image_path = $filename;
        }

        $teacher->name = $request->input('name');
        $teacher->nric = $request->input('nric');
        $teacher->gender = $request->input('gender');
        $teacher->position = $request->input('position');
        $teacher->address = $request->input('address');
        $teacher->email = $request->input('email');
        // $teacher->subject_taught = $request->input('subject_taught');
        // $teacher->class_name = $request->input('class_name');
        $teacher->phone_number = $request->input('phone_number');

        if($request->input('customfield') != null){
            $additional=implode(",",$request->input('customfield'));
            $teacher->additional_Info = $additional;
        }
        $teacher -> update();

        return redirect()->route('teachers.index')->with('success',"Successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
       
        return redirect()->route('teachers.index')
                        ->with('success','Teacher deleted successfully');
    }

     /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request) 
    {
        Excel::import(new TeachersImport, $request->file('file')->store('temp'));
        return redirect()->route('teachers.index');
    }
}
