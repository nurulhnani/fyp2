<?php

namespace App\Http\Controllers;

use App\Models\Merit;
use App\Models\Student;
use Illuminate\Http\Request;

class CurrMeritController extends Controller
{

    public function redirect(Request $request)
    {
        if ($request->filled('name')) {
            $student = Student::where('name', "=", $request->input('name'))->first();
        } else {
            $student = Student::where('mykid', "=", $request->input('id'))->first();
        }

        if ($request->has('behaForm')) {
            return redirect()->route('behaMerits.index', [$student]);
        }
        else{
            return redirect()->route('merits.index', [$student]);
        }
    }

    public function index(Student $student)
    {
        $merits = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->get();
        return view('currMerits.index', ['merits' => $merits, 'student' => $student]);
    }

    public function store(Request $request)
    {
        $newMerit = $request->all();

        if ($newMerit['level'] == "International") {
            $newMerit['merit_point'] = 50;
        } else if ($newMerit['level'] == "National") {
            $newMerit['merit_point'] = 30;
        } else if ($newMerit['level'] == "District") {
            $newMerit['merit_point'] = 20;
        } else {
            $newMerit['merit_point'] = 10;
        }

        Merit::create($newMerit);

        $student = Student::where('mykid', "=", $newMerit['student_mykid'])->first();
        return redirect()->route('merits.index', [$student]);

        // return redirect()->route('merits.index')
        //     ->with('success', 'Merit created successfully.');
    }

    public function update(Request $request, Merit $merit)
    {
        $updateMerit = $request->all();

        if ($updateMerit['level'] == "International") {
            $updateMerit['merit_point'] = 50;
        } else if ($updateMerit['level'] == "National") {
            $updateMerit['merit_point'] = 30;
        } else if ($updateMerit['level'] == "District") {
            $updateMerit['merit_point'] = 20;
        } else {
            $updateMerit['merit_point'] = 10;
        }

        $merit->update($updateMerit);

        $student = Student::where('mykid', "=", $merit['student_mykid'])->first();
        return redirect()->route('merits.index', [$student]);

        // return redirect()->route('merits.index')
        //     ->with('success', 'Product updated successfully');
    }

    public function destroy(Merit $merit)
    {
        $merit->delete();

        $student = Student::where('mykid', "=", $merit['student_mykid'])->first();
        return redirect()->route('merits.index', [$student]);
    }

    //Bulk 
    public function viewStudentList()
    {
        $students = Student::all();
        return view('currMerits.bulk', ['students' => $students]);
    }


}
