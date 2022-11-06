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

        // $subjects = DB::table('subjects')
        //             ->distinct()
        //             ->leftJoin('subject_details','subject_details.subject_id','=','subjects.id')
        //             ->leftJoin('teachers','teachers.id','=','subject_details.subject_teacher')
        //             ->get()
        //             ->groupBy('subject_name');

        // $subjects = Subject_details::join('teachers','teachers.id','=','subject_details.subject_teacher')
                    // ->join('teachers','teachers.id','=','subject_details.subject_teacher')
                    // ->get();
                    // ->groupBy('subject_name');
        // dd($subjects);

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
        ]);

        $subject = new Subject();
        $subject->subject_name = $request->input('subject_name');
        $subject->save();
        return redirect()->route('subjects.index')->with('success',"Successfully added!");
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
        // $subject = Subject_details::find($id);
        // $subject->subject_teacher = $request->input('subject_teacher');
        // $subject->numOfStudent = $request->input('numOfStudent');
        // $subject->classroom_teacher = $request->input('classroom_teacher');
        // $subject->update();
        // $input = $request->all();
        // $class->fill($input)->save();

        $subject = Subject_details::where('id', $id)
            ->update([
                // 'subject_name' => $request->input('subject_name'),
                'class_name' => $request->input('class_name'),
                'subject_teacher' => $request->input('subject_teacher')
        ]);

        return redirect()->route('subjects.index')->with('success',"Successfully updated!");
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
                        ->with('success','Class deleted successfully');
    }
}
