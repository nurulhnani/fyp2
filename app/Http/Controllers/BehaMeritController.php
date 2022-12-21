<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merit;
use App\Models\Student;
use App\Imports\MeritsImport;
use Maatwebsite\Excel\Facades\Excel;

class BehaMeritController extends Controller
{

    public function index(Student $student)
    {
        $merits = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'b')->get();
        return view('merits/behaMerits.index', ['merits' => $merits, 'student' => $student]);
    }

    public function store(Request $request)
    {
        $newMerit = $request->all();

        if ($request->has('demerit')) {
            if ($newMerit['level'] == "High") {
                $newMerit['merit_point'] = -30;
            } else if ($newMerit['level'] == "Medium") {
                $newMerit['merit_point'] = -20;
            } else {
                $newMerit['merit_point'] = -10;
            }
        } else {
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

        if ($request->has('demerit')) {
            if ($updateMerit['level'] == "High") {
                $updateMerit['merit_point'] = -30;
            } else if ($updateMerit['level'] == "Medium") {
                $updateMerit['merit_point'] = -20;
            } else {
                $updateMerit['merit_point'] = -10;
            }
        } else {
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

    //Bulk 
    public function viewStudentList()
    {
        $students = Student::all();
        return view('merits/behaMerits.bulk', ['students' => $students]);
    }

    public function checklistImport(Request $request)
    {
        $studentLists = $request->input('checklist');
        foreach ($studentLists as $studentList) {
            $students[] = Student::where('mykid', "=", $studentList)->first();
        }
        return view('merits/behaMerits.bulkList', ['studentLists' => $students]);
    }


    public function fileImport(Request $request)
    {
        $studentListArr = Excel::toArray(new MeritsImport, $request->file('file'));
        return view('merits/behaMerits.bulkList', ['studentListArr' => $studentListArr]);
    }

    public function storeBulk(Request $request)
    {
        $checklists = $request->input('checklist');
        foreach ($checklists as $checklist) {
            $newMerit = $request->all();
            $newMerit['student_mykid'] = $checklist;

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
        }
        $students = Student::all();
        return view('merits/behaMerits.bulk', ['students' => $students]);
    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Student::where('name', 'LIKE', '%' . $query . '%')->get();
        return response()->json($filterResult);
    }
}
