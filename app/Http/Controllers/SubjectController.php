<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Classlist;
use Illuminate\Http\Request;

use App\Models\Subject_details;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::paginate(5);
        $teacher = Teacher::all();
        $class = Classlist::all();

        return view('subjects.index',compact('subjects','teacher','class'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'subject_name'=>'required',
            'grade'=>'required',
        ]);

        $subject = new Subject();
        $subject->subject_name = $request->input('subject_name');
        $subject->grade = $request->input('grade');
        $subject->save();
        return redirect()->route('subjects.index')->with('success',"Subject successfully added!");
    }

    public function storeclass(Request $request){
        $request->validate([
            'class_name'=>'required',
            'teacher_name'=>'required',
        ]);

        $subjectdetail = new Subject_details();
        $subjectdetail->subject_id =$request->input('subjectid');
        $subjectdetail->classlist_id = $request->input('class_name');
        $subjectdetail->teacher_id = $request->input('teacher_name');
        $subjectdetail->save();
        return redirect()->route('subjects.index')->with('success',"Subject successfully added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::find($id);
        // dd($subject);
        return view('subjects.show')->with('subject', $subject);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::find($id);
        // dd($subject);
        // echo($subject);
        return view('subjects.edit')->with('subject', $subject);
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
        $subjectmain = Subject::find($id);
        $subjectmain->subject_name = $request->input('subject_name');
        $subjectmain->grade = $request->input('grade');
        $subjectmain->update();

        $idlists = $request->input('idlist');      
        $teacherlists = $request->input('subjectteacher');
        if($request->input('idlist') != null){
            for($i=0;$i<count($request->input('idlist'));$i++){
                $subject = Subject_details::find($idlists[$i]);
                $teacherid = Teacher::where('name',$teacherlists[$i])->first()->id;
                $subject->teacher_id = $teacherid;
                $subject->update();
            }    
        }

        return redirect()->route('subjects.index')->with('success',"Subject successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject_details = Subject_details::find($id);
        $subject_details->delete();
       
        return redirect()->route('subjects.index')
                        ->with('success','Class successfully removed');
    }
}
