<?php

namespace App\Http\Controllers;

use App\Imports\MeritsImport;
use App\Models\Merit;
use App\Models\Merit_Points;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class CurrMeritController extends Controller
{

    public function redirect(Request $request)
    {
        if ($request->filled('name')) {
            $student = Student::where('name', "=", $request->input('name'))->first();
            if (!isset($student)) {
                return redirect()->back()->with('error', 'Student not found');
            }
        } else {
            $student = Student::where('mykid', "=", $request->input('id'))->first();
            if (!isset($student)) {
                return redirect()->back()->with('error', 'Student not found');
            }
        }

        if ($request->has('behaForm')) {
            return redirect()->route('behaMerits.index', [$student]);
        } else {
            return redirect()->route('merits.index', [$student]);
        }
    }

    public function index(Student $student)
    {
        $data['positions'] = Merit_Points::where('category', '=', 'Position')->pluck("achievement", "id")->toArray();
        $data['competitions'] = Merit_Points::where('category', '=', 'Competition')->select('achievement')->groupBy('achievement')->get();
        $merits = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->get();
        return view('merits/currMerits.index', compact('merits', 'student', 'data'));
    }

    public function store(Request $request)
    {

        $newMerit = $request->all();
        $student = Student::where('mykid', "=", $newMerit['student_mykid'])->first();

        if ($request->category == 'Position') {
            $meritRef = Merit_Points::where('id', $request->achievement)
                ->where('level', $request->level)
                ->first();

            if (isset($meritRef)) {
                $newMerit['merit_point'] = $meritRef->merit_points;
                $newMerit['achievement'] = $meritRef->achievement;
            } else {
                return redirect()->route('merits.index', [$student])->with('error', 'The merit point is still not set. Contact Administrator for the setup.');
            }
        } else {
            $meritRef = Merit_Points::where('achievement', $request->achievement)
                ->where('level', $request->level)
                ->first();
            if (isset($meritRef)) {
                $newMerit['merit_point'] = $meritRef->merit_points;
            } else {
                return redirect()->route('merits.index', [$student])->with('error', 'The merit point is still not set. Contact Administrator for the setup.');
            }
        }

        Merit::create($newMerit);
        return redirect()->route('merits.index', [$student])->with('success', 'Your merit record has successfully added');
    }

    public function update(Request $request, Merit $merit)
    {
        $updateMerit = $request->all();
        $student = Student::where('mykid', "=", $merit['student_mykid'])->first();

        if ($request->category == 'Position') {
            $meritRef = Merit_Points::where('id', $request->achievement)
                ->where('level', $request->level)
                ->first();

            if (isset($meritRef)) {
                $updateMerit['merit_point'] = $meritRef->merit_points;
                $updateMerit['achievement'] = $meritRef->achievement;
            } else {
                return redirect()->route('merits.index', [$student])->with('error', 'The merit point is still not set. Contact Administrator for the setup.');
            }
        } else {
            $meritRef = Merit_Points::where('achievement', $request->achievement)
                ->where('level', $request->level)
                ->first();
            if (isset($meritRef)) {
                $updateMerit['merit_point'] = $meritRef->merit_points;
            } else {
                return redirect()->route('merits.index', [$student])->with('error', 'The merit point is still not set. Contact Administrator for the setup.');
            }
        }
        $merit->update($updateMerit);
        return redirect()->route('merits.index', [$student])->with('success', 'Your merit record has successfully updated');
    }

    public function destroy(Merit $merit)
    {
        $merit->delete();

        $student = Student::where('mykid', "=", $merit['student_mykid'])->first();
        return redirect()->route('merits.index', [$student])->with('success', 'Your merit records has successfully deleted');
    }

    //Bulk 
    public function viewStudentList()
    {
        $students = Student::all();
        return view('merits/currMerits.bulk', ['students' => $students]);
    }

    public function checklistImport(Request $request)
    {
        $studentLists = $request->input('checklist');
        foreach ($studentLists as $studentList) {
            $students[] = Student::where('mykid', "=", $studentList)->first();
        }
        return view('merits/currMerits.bulkList', ['studentListArr' => $students]);
    }


    public function fileImport(Request $request)
    {
        if ($request->hasFile('file')) {
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                $arr = Excel::toArray(new MeritsImport, $request->file('file'));
                $studentListArr = array_merge([], ...$arr);

                $index = 0;
                $nonStudentsArr = null;
                foreach ($studentListArr as $arr) {
                    $student = Student::where('mykid', "=", $arr['mykid'])->first();
                    if (!isset($student)) {
                        unset($studentListArr[$index]);
                        $nonStudentsArr[$index] = $arr['name'];
                    } else {
                        $studentListArr[$index] = $student;
                    }
                    $index++;
                }

                return view('merits/currMerits.bulkList', ['studentListArr' => $studentListArr, 'nonStudentsArr' => $nonStudentsArr]);
            } else {
                return redirect()->route('merits.bulk')->with('error', 'Incorrect file format');
            }
        }
    }

    public function storeBulk(Request $request)
    {
        $checklists = $request->input('checklist');
        foreach ($checklists as $checklist) {
            $newMerit = $request->all();
            $newMerit['student_mykid'] = $checklist;

            if ($request->category == 'Position') {
                $meritRef = Merit_Points::where('id', $request->achievement)
                    ->where('level', $request->level)
                    ->first();

                if (isset($meritRef)) {
                    $newMerit['merit_point'] = $meritRef->merit_points;
                    $newMerit['achievement'] = $meritRef->achievement;
                } else {
                    return redirect()->route('merits.bulk')->with('error', 'The merit point is still not set. Contact Administrator for the setup.');
                }
            } else {
                $meritRef = Merit_Points::where('achievement', $request->achievement)
                    ->where('level', $request->level)
                    ->first();
                if (isset($meritRef)) {
                    $newMerit['merit_point'] = $meritRef->merit_points;
                } else {
                    return redirect()->route('merits.bulk')->with('error', 'The merit point is still not set. Contact Administrator for the setup.');
                }
            }
            Merit::create($newMerit);
        }
        return redirect()->route('merits.bulk')->with('success', 'Your merit records has successfully added');
    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Student::where('name', 'LIKE', '%' . $query . '%')->get();
        return response()->json($filterResult);
    }

    public function fetchActivity(Request $request)
    {
        $data['positions'] = Merit_Points::where('category', '=', $request->category)->pluck("achievement", "id")->toArray();
        $data['competitions'] = Merit_Points::where('category', '=', 'Competition')->select('achievement')->groupBy('achievement')->get();
        return response()->json($data);
    }
}
