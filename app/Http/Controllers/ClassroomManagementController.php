<?php

namespace App\Http\Controllers;

use App\Models\Classlist;
use App\Models\Student;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClassroomManagementController extends Controller
{
    public function index()
    {
        $classes = Classlist::all();
        return view('classrooms.index', ['classes' => $classes]);
    }

    public function view(Request $request)
    {
        $class = Classlist::find($request->select_class);
        $students = Student::where('classlist_id', $class->id)->get();
        return view('classrooms.view', ['class' => $class, 'students' => $students]);
    }

    public function plan(Classlist $class)
    {
        return view('classrooms.plan', ['class' => $class]);
    }

    public function getAjax(Request $request)
    {
        $class = Classlist::findOrFail($request->id);
        $image = str_replace('data:image/png;base64,', '', $request->imgVal);
        $image = str_replace(' ', '+', $image);
        $imageName = $class->class_name.'.png';
        File::put(public_path('assets\img\class'). '/' . $imageName, base64_decode($image));    
        $class->class_plan = $imageName;
        $class->save();

        $students = Student::where('classlist_id', $class->id)->get();
        return view('classrooms.view', ['class' => $class, 'students' => $students]);
    }
}
