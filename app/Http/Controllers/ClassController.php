<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classlist;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
        $teacher = Teacher::all();
        $student = Student::all();

        return view('classes.index')->with(['classes'=>$classes,'teacher'=>$teacher,'student'=>$student])
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
            'classroom_teacher' => 'required',
        ]);

        $class = new Classlist;
        $class->class_name = $request->input('class_name');
        $class->save();

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
    public function edit(Classlist $class)
    {
        $teacher = Teacher::all();
        $students = Student::all();
        return view('classes.edit',compact('class','teacher','students'));
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
        // dd($request->studentInClass);
        $class = Classlist::find($id);
        
        $class->class_name = $request->input('class_name');
        $class->update();

        $teacherid = Teacher::where('classlist_id', $id)->first();
        if(isset($teacherid)){
            $teacher = Teacher::find($teacherid->id);
            $teacher->classlist_id = null;
            $teacher->updated_at = now();
            $teacher->update();
        }
        // else{
        //     $teachername = $request->input('classroom_teacher');
        //     $teacherid = Teacher::where('name', $teachername)->first()->id;
        //     $teacher = Teacher::find($teacherid);
        //     $teacher->classlist_id = $class->id;
        //     $teacher->update();
        // }
       
        $teachername = $request->input('classroom_teacher');
        $teacherid = Teacher::where('name', $teachername)->first()->id;
        $teacher = Teacher::find($teacherid);
        $teacher->classlist_id = $id;
        $teacher->updated_at = now();
        $teacher->update();

        $studentLists = $request->input('studentInClass');
        if(isset($studentLists)){
            $oldstudents = Student::where('classlist_id','=',$id)->get();
            foreach($oldstudents as $oldstudent){
                $oldstudent->classlist_id = null;
                $oldstudent->update();
            }
            // dd($oldstudent);
            foreach ($studentLists as $studentList) { 
                $studentsid = Student::where('id', "=", $studentList)->first()->id;
                $students = Student::find($studentsid);
                $students->classlist_id = $id;
                $students->updated_at = now();
                $students->update();
            }
        }
        
        if($request->hasFile('file')){
            $filedata = $request->file('file');
            $spreadsheet = IOFactory::load($filedata->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 1, $row_limit );
            $data = array();
            foreach ( $row_range as $row ) {
                $data[] = [
                    'mykid' => $sheet->getCell( 'B' . $row )->getValue(),
                ];
            }

            foreach($data as $data){
                $studentsid = Student::where('mykid', "=", $data)->first()->id;
                $students = Student::find($studentsid);
                $students->classlist_id = $id;
                $students->updated_at = now();
                $students->update();
            }
            // dd($data);
        }

        
        return redirect()->route('classes.index')->with('success',"Successfully updated!");
    }

    public function getStudent($id)
    {
        // $mk = Nilai::select('matakuliahs_id')->where('mahasiswas_id', $id)->get();
        // $data = Matakuliah::whereNotIn('id', $mk)->where('nama_matakuliah', 'LIKE', '%' . request('q') . '%')->paginate(10);

        $data = Student::where('classlist_id','=',$id)->get();
        return response()->json($data);
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

    public function removeStudent($id){
        $student = Student::find($id);
        $student->classlist_id = null;
        $student->update();
        return redirect()->back()->with('success','Successfully removed!');
    }
}
