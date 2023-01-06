<?php

namespace App\Http\Controllers;

use App\Models\Personality_Evaluation;
use App\Models\Personality_Question;
use App\Models\Student;
use App\Models\Teacher;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PersonalityKeywordsImport;
use App\Models\Interest_Inventory_Results;
use DonatelloZa\RakePlus\RakePlus;


use Illuminate\Http\Request;

class PersonalityEvaluationController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $interestresults = Interest_Inventory_Results::all();
        $student_ids = [];
        foreach ($interestresults as $interestresult) {
            $student_ids[] = $interestresult->student_id;
        }

        /* Personality Evaluation Status */
        $name = auth()->user()->name;
        $teacher = Teacher::where('name', '=', $name)->first();

        $student_person_ids = [];
        foreach ($students as $student) {
            if (Personality_Evaluation::where('student_mykid', '=', $student->mykid)
                ->where('teacher_id', '=', $teacher->id)
                ->exists()) {
                    $student_person_ids[] = $student->mykid;
            } else {
                continue;
            }
        }

        return view('evaluations.index', ['students' => $students, 'student_ids' => $student_ids, 'student_person_ids' => $student_person_ids]);
    }

    public function viewPersonalityQuestion(Request $request)
    {
        $id = $request->student;
        $question = $request->question;
        $student = Student::find($id);
        $questions = Personality_Question::where('type', '=', $question)->paginate(5);
        return view('evaluations.personalityEval', compact('questions', 'student'));
    }


    public function store(Request $request)
    {
        $sheetNameArr = array("Extraversion", "Agreeableness", "Neuroticism", "Conscientiousness", "Openness");
        $id = $request->input('student_mykid');
        $name = auth()->user()->name;
        $student = Student::where('mykid', "=", $id)->first();
        $teacher = Teacher::where('name', $name)->first();

        if ($request->has('scale')) {
            $questions = Personality_Question::where('type', '=', 's')->get();

            $index = 1;
            $categoryArray[] = array();


            foreach ($questions as $question) {
                $likertName = "likert" . $index;
                $categoryName = "category" . $index;
                $likertVal = intval($request->input($likertName));
                $category = $request->input($categoryName);

                $categoryArray[$index] = array($category => $likertVal);
                $index++;
            }

            $arraysMerged = array_merge_recursive([], ...$categoryArray);
            extract($arraysMerged);

            dd($arraysMerged);

            // //calculate marks
            // $categories = array($diligent, $punctual, $courteus, $leadership, $critical_thinking);
            // $categories_name = array('diligent', 'punctual', 'courteus', 'leadership', 'critical_thinking');
            // $index = 0;
            // foreach ($categories as $category) {
            //     $mark = array_sum($category) / (count($category) * 5) * 100;
            //     $markArr[$categories_name[$index]] =  $mark;
            //     $index++;
            // }

            // $student = Student::where('mykid', "=", $request->input('student_mykid'))->first();
            // $active = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->sum('merit_point');
            // $discipline = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'b')->sum('merit_point');

            // $input = [
            //     'active' => $active,
            //     'discipline' => $discipline,
            //     'diligent' => $markArr['diligent'],
            //     'punctual' => $markArr['punctual'],
            //     'courteus' => $markArr['courteus'],
            //     'leadership' => $markArr['leadership'],
            //     'critical_thinking' => $markArr['critical_thinking'],
            //     'answer' => $arraysMerged,
            //     'student_mykid' => $request->input('student_mykid'),
            // ];

            // Personality_Evaluation::create($input);
            // return redirect()->route('evaluationList');
        } elseif ($request->has('mcq')) {
            $inputArr = $request->input('checklist');

            foreach ($inputArr as $k => $v) {
                $totalMarks[$k] = 0;
                foreach ($v as $val) {
                    if ($val == 'introversion' || $val == 'competitiveness' || $val == 'stable' || $val == 'spontaneity' || $val == 'consistency') {
                        $totalMarks[$k]--;
                    } else {
                        $totalMarks[$k]++;
                    }
                }
            }

            foreach ($totalMarks as $category => $mark) {
                if ($mark <= 0) {
                    $finalMark[$category] = 0;
                } else {
                    $finalMark[$category] = intval(round(($mark / 6) * 100));
                }
            }

            $input = [
                'Extraversion' => $finalMark['Extraversion'],
                'Agreeableness' => $finalMark['Agreeableness'],
                'Neuroticism' => $finalMark['Neuroticism'],
                'Conscientiousness' => $finalMark['Conscientiousness'],
                'Openness' => $finalMark['Openness'],
                'teacher_id' => $teacher->id,
                'student_mykid' => $id,
            ];
        } else {
            $index = 0;
            foreach ($sheetNameArr as $sheetName) {
                $import = new PersonalityKeywordsImport();
                $import->onlySheets($sheetName);
                $arrayAll[$index] = Excel::toArray($import, "big5.xlsx");
                $index++;
            }

            $catNameArr = [];
            foreach ($arrayAll as $array) {
                foreach ($array as $k => $v) {
                    $kv = array_merge_recursive([], ...$v);
                    $kv = array_filter($kv);
                    $catArr[$k] = $kv;
                    foreach ($kv as $name => $val) {
                        array_push($catNameArr, $name);
                    }
                }
            }

            $i = 0;
            foreach ($catArr as $words) {
                $classifier[$i] = new \Niiknow\Bayes();
                foreach ($words as $category => $word) {
                    $word = array_filter($word, 'strlen');
                    foreach ($word as $w) {
                        $classifier[$i]->learn($w, $category);
                    }
                }
                $i++;
            }

            $indexNo = 0;
            foreach ($request->input('text') as $category => $text) {
                $cat = $classifier[$indexNo]->categorize($text);
                $resultArr[$indexNo] = 50;
                $phrases = RakePlus::create($text)->get();
                foreach ($catArr as $itr) {
                    if (!isset($itr[$cat])) {
                        continue;
                    }
                    $result = count(array_intersect($itr[$cat], $phrases));

                    if (in_array(ucfirst($cat), $sheetNameArr)) {
                        $resultArr[$indexNo] += ($result * 10);
                    } else {
                        $resultArr[$indexNo] -= ($result * 10);
                        echo ucfirst($indexNo) . " = " . $cat . " ";
                    }
                }
                $indexNo++;
            }

            //if more than 100 and less than 0 

            $input = [
                'Extraversion' => $resultArr[0],
                'Agreeableness' => $resultArr[1],
                'Neuroticism' => $resultArr[2],
                'Conscientiousness' => $resultArr[3],
                'Openness' => $resultArr[4],
                'teacher_id' => $teacher->id,
                'student_mykid' => $id,
            ];
        }

        Personality_Evaluation::create($input);
        unset($input['teacher_id']);
        unset($input['student_mykid']);

        toastr()->success('Your personality evaluation has been submit successfully!', 'Congrats');
        return view('evaluations.personalityResult', ['input' => $input, 'student' => $student, 'teacher' => $teacher]);
    }

    public function showCurrResult(Student $student)
    {
        $categoryArray = array("Extraversion", "Agreeableness", "Neuroticism", "Conscientiousness", "Openness");
        foreach ($categoryArray as $category) {
            $averageScore = Personality_Evaluation::where('student_mykid', '=', $student->mykid)->avg($category);
            $averageArr[$category] = intval(round($averageScore));
        }
        return view('evaluations.personalityResultCurr', ['averageArr' => $averageArr, 'student' => $student]);
    }

    public function showHistory(Student $student)
    {
        $evaluations = Personality_Evaluation::where('student_mykid', "=", $student->mykid)->get();
        return view('evaluations.personalityResultHist', ['evaluations' => $evaluations, 'student' => $student]);
    }
}
