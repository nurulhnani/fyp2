<?php

namespace App\Http\Controllers;

use App\Models\Classlist;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classlist::latest()->paginate(5);
        
        // echo $classes;
        $teacher = Teacher::all();
        // echo $teacher;
        $student = Student::all();

        return view('classes.index',compact('classes','teacher','student'))
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
            'class_name'=>'required',
            'femaleStudent' =>'required',
            'maleStudent' =>'required',
            'classroom_teacher' => 'required',
        ]);

        $class = new Classlist;
        $class->class_name = $request->input('class_name');
        $class->femaleStudent = $request->input('femaleStudent');
        $class->maleStudent = $request->input('maleStudent');
        // $class->classroom_teacher = $request->input('classroom_teacher');
        $class->save();

        // $classid = $class->id;
        // dd($classid);
        $teachername = $request->input('classroom_teacher');
        $teacherid = Teacher::where('name', $teachername)->first()->id;
        $teacher = Teacher::find($teacherid);
        $teacher->classlist_id = $class->id;
        $teacher->update();
        return redirect()->route('classes.index')->with('success',"Successfully added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $class = Classlist::find($id);
        $class->class_name = $request->input('class_name');
        $class->femaleStudent = $request->input('femaleStudent');
        $class->maleStudent = $request->input('maleStudent');

        $teacherid = Teacher::where('classlist_id', $id)->first()->id;
        $teacher = Teacher::find($teacherid);
        $teacher->classlist_id = null;
        $teacher->update();

        // dd($teacher);
        // $class->classroom_teacher = $request->input('classroom_teacher');
        // $class->update();
        $teachername = $request->input('classroom_teacher');
        $teacherid = Teacher::where('name', $teachername)->first()->id;
        $teacher = Teacher::find($teacherid);
        $teacher->classlist_id = $id;
        $teacher->update();
        // $input = $request->all();
        // $class->fill($input)->save();
        return redirect()->route('classes.index')->with('success',"Successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classlist $class)
    {
        $class->delete();
       
        return redirect()->route('classes.index')
                        ->with('success','Class deleted successfully');
    }
}
