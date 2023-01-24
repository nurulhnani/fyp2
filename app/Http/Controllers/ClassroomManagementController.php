<?php

namespace App\Http\Controllers;

use App\Models\Classlist;
use App\Models\Student;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
        if (!isset($class)) {
            return redirect()->back()->with('error', 'Please select class from the dropdown');
        }
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
        /* store in localhost */
        // $image = str_replace('data:image/png;base64,', '', $request->imgVal);
        // $image = str_replace(' ', '+', $image);
        // File::put(public_path('assets\img\class'). '/' . $imageName, base64_decode($image));    

        $imageName = $class->class_name . '.png';
        $uploadedFileUrl = Cloudinary::upload($request->imgVal, ['folder' => 'classImage'])->getSecurePath();


        $class->class_plan = $uploadedFileUrl;
        $class->save();

        $students = Student::where('classlist_id', $class->id)->get();
        return view('classrooms.view', ['class' => $class, 'students' => $students, 'uploadedFileUrl' => $uploadedFileUrl]);
    }
}
