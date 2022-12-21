<?php

namespace App\Http\Controllers;

use App\Models\Classlist;
use Illuminate\Http\Request;

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
        return view('classrooms.view', ['class' => $class]);
    }

    public function plan()
    {
        return view('classrooms.plan');
    }
}
