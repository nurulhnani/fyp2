<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Classlist;
use App\Models\Teacher;
use App\Models\AutoFields;
use Illuminate\Http\Request;
use App\Imports\TeachersImport;
use App\Models\Subject_details;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::latest()->paginate(10);
      
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

    public function editProfile(Request $request)
    {
        
        $request->validate([
            'name'=>'required|regex:/^[\p{L}\s-]+$/',
            'nric' =>'required|numeric|digits:12',
            // 'gender' =>'required',
            'email' =>'required',
            // 'position' =>'required',
            // 'address' =>'required',
            // 'phone_number' =>'required',
        ]);

        $teachername = auth()->user()->name;
        $teacherid = Teacher::where('name',$teachername)->first();

        $teacher = Teacher::find($teacherid->id);

        $userid = User::where('name','=',$request->input('old_name'))->first();
        $user = User::find($userid->id);      

        if($request->hasFile('imageT')){
            $uploadedFileUrl = Cloudinary::upload($request->file('imageT')->getRealPath(), ['folder' => 'userImage'])->getSecurePath();
            // dd($uploadedFileUrl);
            // $newImage = $data['name'] . '.' . $request->image->extension();
            // $request->image->move(public_path('storage'), $newImage);
            $teacher->image_path = $uploadedFileUrl;
            $user->image_path = $uploadedFileUrl;
            // $teacher->attachMedia($request->file('imageT'));

            // $destination = "assets\img\userImage".$teacher->image_path;
            // if(File::exists($destination)){
            //     File::delete($destination);
            // }
            // $file = $request->file('imageT');
            // $extension = $file->getClientOriginalExtension();
            // $filename = $teacher->name.'.'.$extension;
            // $file->move(public_path('assets\img\userImage'),$filename);
            // $teacher->image_path = $filename;
        }

        $teacher->name = $request->input('name');
        $teacher->nric = $request->input('nric');
        $teacher->gender = $request->input('gender');
        $teacher->position = $request->input('position');
        $teacher->address = $request->input('address');
        $teacher->email = $request->input('email');
        $teacher->phone_number = $request->input('phone_number');
        $teacher->updated_at = now();
        
        if($request->input('customfield') != null){
            $additional=implode(",",$request->input('customfield'));
            $teacher->additional_Info = $additional;
        }
        $teacher -> update();

        
        // if ($request->hasFile('imageT')) {
        //     $user->image_path = $uploadedFileUrl;
        // }
        $user->name = $request->input('name');
        $user->nric_mykid =  $request->input('nric');
        $user->email = $request->input('email');
        $user->type = 1;
        $user->email_verified_at = now();
        // $user->password = Hash::make('secret');
        $user->created_at = now();
        $user->updated_at = now();
        $user->update();

        return redirect()->route('viewprofile')->with('success',"Successfully updated!");
    }

    public function studentlist(Request $request)
    {
        // $students = Student::all();
        // return view('teachers.studentlist',compact('students'));
        $students = Student::paginate(10);
        $classes = Classlist::all();
        return view('teachers.studentlist', compact('students','classes'));
    }

    public function search(Request $request)
    {
        $classes = Classlist::all();
        $search = $request->get('search');
        if ($search != '') {
            $students = Student::where('name', 'like', '%' . $search . '%')
            ->when($request->has('class'), function ($q) use ($request) {
                return $q->where('classlist_id', $request->class);
            })
            ->paginate(10);
            $students->appends(array('search' => $request->input('search'),));
            if (count($students) > 0) {
                return view('teachers.studentlist', compact('students', 'classes'));
            }
            return back()->with('error', 'No results Found');
        }
        else{
            $students = Student::where('classlist_id', $request->class)->paginate(10);
            return view('teachers.studentlist', compact('students', 'classes'));
        }
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
            'name'=>'required|regex:/^[\p{L}\s-]+$/',
            'nric' =>'required|numeric|digits:12',
            'email' =>'required'
        ]);

        $data = $request->input();
        $teacher = new Teacher();
        $user = new User;

        if($request->hasFile('image')){
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), ['folder' => 'userImage'])->getSecurePath();
            $teacher->image_path = $uploadedFileUrl;
            $user->image_path = $uploadedFileUrl;
        }

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
        // $teacher->image_path = $newImage;
        if($request->input('customfield') != null) {
            $additional=implode(",",$request->input('customfield'));
            $teacher->additional_Info = $additional;
        }
        $teacher -> save();

        
        $user->name = $data['name'];
        $user->nric_mykid = $data['nric'];
        $user->email = $data['email'];
        $user->type = 1;
        $user->email_verified_at = now();
        $user->password = Hash::make('secret');
        $user->created_at = now();
        $user->updated_at = now();
        $user->save();

        return redirect()->route('teachers.index')->with('success','Teacher successfully added!');
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
                $subdesc = $subjectname.' '.$subjectgrade;
                if(!in_array($subdesc, $data)){
                    $data[] = $subdesc;
                }
                
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
            'name'=>'required|regex:/^[\p{L}\s-]+$/',
            'nric' =>'required|numeric|digits:12',
            // 'gender' =>'required',
            'email' =>'required',
            // 'position' =>'required',
            // 'address' =>'required',
            // 'subject_taught' =>'required',
            // 'class_name' =>'required',
            // 'phone_number' =>'required',
        ]);

        $teacher = Teacher::find($id);
        $user = User::where('name','=',$request->input('old_name'))->first();
        $user->name = $request->input('name');

        if($request->hasFile('imageT')){

            $uploadedFileUrl = Cloudinary::upload($request->file('imageT')->getRealPath(), ['folder' => 'userImage'])->getSecurePath();
            // dd($uploadedFileUrl);
            // $newImage = $data['name'] . '.' . $request->image->extension();
            // $request->image->move(public_path('storage'), $newImage);
            $teacher->image_path = $uploadedFileUrl;
            $user->image_path = $uploadedFileUrl;
            // $teacher->attachMedia($request->file('imageT'));
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
        $teacher->updated_at = now();
        
        if($request->input('customfield') != null){
            $additional=implode(",",$request->input('customfield'));
            $teacher->additional_Info = $additional;
        }
        $teacher->update();

        
        // if ($request->hasFile('imageT')) {
        //     $user->image_path = $uploadedFileUrl;
        // }
        $user->nric_mykid =  $request->input('nric');
        $user->email = $request->input('email');
        $user->type = 1;
        $user->email_verified_at = now();
        // $user->password = Hash::make('secret');
        $user->created_at = now();
        $user->updated_at = now();
        $user->update();

        return redirect()->route('teachers.index')->with('success', 'Teacher successfully updated!');
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
        // $validator = Validator::make(
        //     [
        //         'file'      => $request->file,
        //         'extension' => strtolower($request->file->getClientOriginalExtension()),
        //     ],
        //     [
        //         'file'          => 'required',
        //         'extension'      => 'required|in:csv,xlsx,xls',
        //     ]
        // );
        $request->validate([
            'file'=>'required|mimes:csv,xlsx,xls',
        ]);
        
        Excel::import(new TeachersImport, $request->file('file')->store('temp'));
        return redirect()->route('teachers.index')->with('success','All teachers have been successfully added!');
    }
}
