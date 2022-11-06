<?php

namespace App\Http\Controllers;

use App\Models\Personality_Evaluation;
use App\Models\Student;

use Illuminate\Http\Request;

class PersonalityEvaluationController extends Controller
{
    public function viewStudentList(){
        $students = Student::all();
        return view('evaluation.evaluationList', ['students' => $students]);
    }

    public function viewQuestion(){
        $questions = Personality_Evaluation::all();
        return view('evaluation.evaluationQuestion', ['questions' => $questions]);
    }
}
