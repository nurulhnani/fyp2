<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merit;
use App\Models\Student;

class BehaMeritController extends Controller
{

    public function index(Student $student)
    {
        $merits = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'b')->get();
        return view('behaMerits.index', ['merits' => $merits, 'student' => $student]);
    }

    public function store(Request $request)
    {
        $newMerit = $request->all();

        if($request->has('demerit')){
            if ($newMerit['level'] == "High") {
                $newMerit['merit_point'] = -30;
            } else if ($newMerit['level'] == "Medium") {
                $newMerit['merit_point'] = -20;
            } else {
                $newMerit['merit_point'] = -10;
            }
        }

        else{
            if ($newMerit['level'] == "High") {
                $newMerit['merit_point'] = 30;
            } else if ($newMerit['level'] == "Medium") {
                $newMerit['merit_point'] = 20;
            } else {
                $newMerit['merit_point'] = 10;
            }
        }

        $newMerit['achievement'] = "null";
        Merit::create($newMerit);

        $student = Student::where('mykid', "=", $newMerit['student_mykid'])->first();
        return redirect()->route('behaMerits.index', [$student]);

    }

    public function update(Request $request, Merit $behaMerit)
    {
        $updateMerit = $request->all();

        if($request->has('demerit')){
            if ($updateMerit['level'] == "High") {
                $updateMerit['merit_point'] = -30;
            } else if ($updateMerit['level'] == "Medium") {
                $updateMerit['merit_point'] = -20;
            } else {
                $updateMerit['merit_point'] = -10;
            }
        }

        else{
            if ($updateMerit['level'] == "High") {
                $updateMerit['merit_point'] = 30;
            } else if ($updateMerit['level'] == "Medium") {
                $updateMerit['merit_point'] = 20;
            } else {
                $updateMerit['merit_point'] = 10;
            }
        }

        $behaMerit->update($updateMerit);

        $student = Student::where('mykid', "=", $behaMerit['student_mykid'])->first();
        return redirect()->route('behaMerits.index', [$student]);
    }

    public function destroy(Merit $behaMerit)
    {
        $behaMerit->delete();

        $student = Student::where('mykid', "=", $behaMerit['student_mykid'])->first();
        return redirect()->route('behaMerits.index', [$student]);
    }
}
