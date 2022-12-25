<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherDashboardController extends Controller
{
    //By default, my class dashboard
    public function index()
    {
        
        return view('teachers.home');
    }

    public function viewSchoolDashboard()
    {
        
        return view('teachers.home2');
    }
}
