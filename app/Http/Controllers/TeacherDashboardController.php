<?php

namespace App\Http\Controllers;

use App\Models\Classlist;
use App\Models\Interest_Inventory_Results;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Merit;
use App\Models\Personality_Evaluation;
use App\Models\Teacher;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class TeacherDashboardController extends Controller
{
    public function index(Request $request)
    {
        /* Curriculum Merits */
        $currMerits = Merit::where('type', '=', 'c')
            ->join('students', 'students.mykid', '=', 'merits.student_mykid')
            ->select(DB::raw('MONTH(merits.date) as month'), DB::raw('SUM(merits.merit_point) as total'))
            ->groupBy('month')

            ->when($request->has('year'), function ($q) use ($request) {
                return $q->whereRaw('year(`date`) = ?', $request->year);
            }, function ($q) {
                return $q->whereRaw('year(`date`) = ?', array(date('Y')));
            })
            ->when($request->has('class'), function ($q) use ($request) {
                return $q
                    ->join('classlists', 'classlists.id', '=', 'students.classlist_id')
                    ->whereRaw('students.classlist_id = ?', $request->class);
            })
            ->pluck('total', 'month')->all();

        $currMeritsArr = array_fill_keys(range(1, 12), 0);

        foreach ($currMeritsArr as $month => $count) {
            if (array_key_exists($month, $currMerits)) {
                $currMeritsArr[$month] = $currMerits[$month];
            }
        }

        /* Behavioural Merits */
        $behaMerits = Merit::join('students', 'students.mykid', '=', 'merits.student_mykid')
            ->where('type', '=', 'b')
            ->where('merit_point', '>', 0)
            ->select(DB::raw('MONTH(merits.date) as month'), DB::raw('SUM(merits.merit_point) as total'))
            ->groupBy('month')

            ->when($request->has('year'), function ($q) use ($request) {
                return $q->whereRaw('year(`date`) = ?', $request->year);
            }, function ($q) {
                return $q->whereRaw('year(`date`) = ?', array(date('Y')));
            })
            ->when($request->has('class'), function ($q) use ($request) {
                return $q
                    ->join('classlists', 'classlists.id', '=', 'students.classlist_id')
                    ->whereRaw('students.classlist_id = ?', $request->class);
            })
            ->pluck('total', 'month')->all();

        $behaMeritsArr = array_fill_keys(range(1, 12), 0);

        foreach ($behaMeritsArr as $month => $count) {
            if (array_key_exists($month, $behaMerits)) {
                $behaMeritsArr[$month] = $behaMerits[$month];
            }
        }

        /* Behavioural Demerits */
        $behaDemerits = Merit::join('students', 'students.mykid', '=', 'merits.student_mykid')
            ->where('type', '=', 'b')
            ->where('merit_point', '<', 0)
            ->select(DB::raw('MONTH(merits.date) as month'), DB::raw('SUM(ABS(merits.merit_point)) as total'))
            ->groupBy('month')

            ->when($request->has('year'), function ($q) use ($request) {
                return $q->whereRaw('year(`date`) = ?', $request->year);
            }, function ($q) {
                return $q->whereRaw('year(`date`) = ?', array(date('Y')));
            })
            ->when($request->has('class'), function ($q) use ($request) {
                return $q
                    ->join('classlists', 'classlists.id', '=', 'students.classlist_id')
                    ->whereRaw('students.classlist_id = ?', $request->class);
            })
            ->pluck('total', 'month')->all();

        $behaDemeritsArr = array_fill_keys(range(1, 12), 0);

        foreach ($behaDemeritsArr as $month => $count) {
            if (array_key_exists($month, $behaDemerits)) {
                $behaDemeritsArr[$month] = $behaDemerits[$month];
            }
        }

        /* Class Merit Performance */
        $classMerits = Merit::join('students', 'students.mykid', '=', 'merits.student_mykid')
            ->join('classlists', 'classlists.id', '=', 'students.classlist_id')
            ->where('merits.merit_point', '>', 0)
            ->when($request->has('year'), function ($q) use ($request) {
                return $q->whereRaw('year(`date`) = ?', $request->year);
            }, function ($q) {
                return $q->whereRaw('year(`date`) = ?', array(date('Y')));
            })
            ->when($request->has('class'), function ($q) use ($request) {
                return $q
                    ->whereRaw('classlists.id = ?', $request->class)
                    ->select(DB::raw('class_name as class'), DB::raw('SUM(merits.merit_point) as total'));;
            }, function ($q) {
                return $q->select(DB::raw('class_name as class'), DB::raw('SUM(merits.merit_point) as total'));
            })
            ->groupBy('classlists.class_name')
            ->pluck('total', 'class')->all();

        $classMeritsArr = [];
        $classes = Classlist::all();

        if (!$request->has('class')) {
            foreach ($classes as $class) {
                if (array_key_exists($class->class_name, $classMerits)) {
                    $classMeritsArr[$class->class_name] = $classMerits[$class->class_name];
                } else {
                    $classMeritsArr[$class->class_name] = 0;
                }
            }
        } else {
            $classMeritsArr = $classMerits;
        }

        /* Class Demerit Performance */
        $classDemerits = Merit::join('students', 'students.mykid', '=', 'merits.student_mykid')
            ->join('classlists', 'classlists.id', '=', 'students.classlist_id')
            ->where('merits.merit_point', '<', 0)
            ->when($request->has('year'), function ($q) use ($request) {
                return $q->whereRaw('year(`date`) = ?', $request->year);
            }, function ($q) {
                return $q->whereRaw('year(`date`) = ?', array(date('Y')));
            })
            ->when($request->has('class'), function ($q) use ($request) {
                return $q
                    ->whereRaw('classlists.id = ?', $request->class)
                    ->select(DB::raw('class_name as class'), DB::raw('SUM(ABS(merits.merit_point)) as total'));;
            }, function ($q) {
                return $q->select(DB::raw('class_name as class'), DB::raw('SUM(ABS(merits.merit_point)) as total'));
            })
            ->groupBy('classlists.class_name')
            ->pluck('total', 'class')->all();

        $classDemeritsArr = [];

        if (!$request->has('class')) {
            foreach ($classes as $class) {
                if (array_key_exists($class->class_name, $classDemerits)) {
                    $classDemeritsArr[$class->class_name] = $classDemerits[$class->class_name];
                } else {
                    $classDemeritsArr[$class->class_name] = 0;
                }
            }
        } else {
            $classDemeritsArr = $classDemerits;
        }

        /* Personality Traits */
        $Extraversion['Extrovert'] = round((Personality_Evaluation::join('students', 'students.mykid', '=', 'personality_evaluations.student_mykid')
            ->when(
                $request->has('year'),
                function ($q) use ($request) {
                    return $q->whereYear('personality_evaluations.created_at', '=', $request->year);
                },
                function ($q) {
                    return $q->whereYear('personality_evaluations.created_at', '=', array(date('Y')));
                }
            )
            ->when($request->has('class'), function ($q) use ($request) {
                return $q
                    ->join('classlists', 'classlists.id', '=', 'students.classlist_id')
                    ->whereRaw('classlists.id = ?', $request->class);
            })->avg('Extraversion') / 100) * 100);

        $Extraversion['Introvert'] = 100 - $Extraversion['Extrovert'];

        $Agreeableness['Agreeable'] = round((Personality_Evaluation::join('students', 'students.mykid', '=', 'personality_evaluations.student_mykid')
            ->when(
                $request->has('year'),
                function ($q) use ($request) {
                    return $q->whereYear('personality_evaluations.created_at', '=', $request->year);
                },
                function ($q) {
                    return $q->whereYear('personality_evaluations.created_at', '=', array(date('Y')));
                }
            )
            ->when($request->has('class'), function ($q) use ($request) {
                return $q
                    ->join('classlists', 'classlists.id', '=', 'students.classlist_id')
                    ->whereRaw('classlists.id = ?', $request->class);
            })->avg('Agreeableness') / 100) * 100);

        $Agreeableness['Competitive'] = 100 - $Agreeableness['Agreeable'];

        $Neuroticism['Neurotic'] = round((Personality_Evaluation::join('students', 'students.mykid', '=', 'personality_evaluations.student_mykid')
            ->when(
                $request->has('year'),
                function ($q) use ($request) {
                    return $q->whereYear('personality_evaluations.created_at', '=', $request->year);
                },
                function ($q) {
                    return $q->whereYear('personality_evaluations.created_at', '=', array(date('Y')));
                }
            )
            ->when($request->has('class'), function ($q) use ($request) {
                return $q
                    ->join('classlists', 'classlists.id', '=', 'students.classlist_id')
                    ->whereRaw('classlists.id = ?', $request->class);
            })->avg('Neuroticism') / 100) * 100);


        $Neuroticism['Stable'] = 100 - $Neuroticism['Neurotic'];

        $Conscientiousness['Conscious'] = round((Personality_Evaluation::join('students', 'students.mykid', '=', 'personality_evaluations.student_mykid')
            ->when(
                $request->has('year'),
                function ($q) use ($request) {
                    return $q->whereYear('personality_evaluations.created_at', '=', $request->year);
                },
                function ($q) {
                    return $q->whereYear('personality_evaluations.created_at', '=', array(date('Y')));
                }
            )
            ->when($request->has('class'), function ($q) use ($request) {
                return $q
                    ->join('classlists', 'classlists.id', '=', 'students.classlist_id')
                    ->whereRaw('classlists.id = ?', $request->class);
            })->avg('Conscientiousness') / 100) * 100);

        $Conscientiousness['Spontaneity'] = 100 - $Conscientiousness['Conscious'];

        $Openness['Open'] = round((Personality_Evaluation::join('students', 'students.mykid', '=', 'personality_evaluations.student_mykid')
            ->when(
                $request->has('year'),
                function ($q) use ($request) {
                    return $q->whereYear('personality_evaluations.created_at', '=', $request->year);
                },
                function ($q) {
                    return $q->whereYear('personality_evaluations.created_at', '=', array(date('Y')));
                }
            )
            ->when($request->has('class'), function ($q) use ($request) {
                return $q
                    ->join('classlists', 'classlists.id', '=', 'students.classlist_id')
                    ->whereRaw('classlists.id = ?', $request->class);
            })->avg('Openness') / 100) * 100);

        $Openness['Consistent'] = 100 - $Openness['Open'];

        /* Interest Inventory */
        $categoryArray = array("realistic", "investigative", "artistic", "social", "enterprising", "conventional");
        foreach ($categoryArray as $category) {
            $InterestResultArr[$category] = Interest_Inventory_Results::join('students', 'students.id', '=', 'interest_inventory_results.student_id')
                ->when(
                    $request->has('year'),
                    function ($q) use ($request) {
                        return $q->whereYear('interest_inventory_results.created_at', '=', $request->year);
                    },
                    function ($q) {
                        return $q->whereYear('interest_inventory_results.created_at', '=', array(date('Y')));
                    }
                )
                ->when($request->has('class'), function ($q) use ($request) {
                    return $q
                        ->join('classlists', 'classlists.id', '=', 'students.classlist_id')
                        ->whereRaw('classlists.id = ?', $request->class);
                })->avg($category);
        }

        /* Top Contributers */
        $topMeritArr = Merit::join('students', 'students.mykid', '=', 'merits.student_mykid')
            ->when($request->has('year'), function ($q) use ($request) {
                return $q->whereRaw('year(`date`) = ?', $request->year);
            }, function ($q) {
                return $q->whereRaw('year(`date`) = ?', array(date('Y')));
            })
            ->when($request->has('class'), function ($q) use ($request) {
                return $q
                    ->join('classlists', 'classlists.id', '=', 'students.classlist_id')
                    ->whereRaw('classlists.id = ?', $request->class);
            })
            ->where('merit_point', '>', 0)
            ->selectRaw("SUM(merit_point) as merit_point,student_mykid")
            ->groupBy('student_mykid')
            ->orderBy('merit_point', 'DESC')
            ->take(3)
            ->get();

        $topDemeritArr = Merit::join('students', 'students.mykid', '=', 'merits.student_mykid')
            ->when($request->has('year'), function ($q) use ($request) {
                return $q->whereRaw('year(`date`) = ?', $request->year);
            }, function ($q) {
                return $q->whereRaw('year(`date`) = ?', array(date('Y')));
            })
            ->when($request->has('class'), function ($q) use ($request) {
                return $q
                    ->join('classlists', 'classlists.id', '=', 'students.classlist_id')
                    ->whereRaw('classlists.id = ?', $request->class);
            })
            ->where('merit_point', '<', 0)
            ->selectRaw("SUM(ABS(merit_point)) as merit_point,student_mykid")
            ->groupBy('student_mykid')
            ->orderBy('merit_point', 'DESC')
            ->take(3)
            ->get();

        /* Pending Tasks */
        $name = auth()->user()->name;
        $teacher = Teacher::where('name', '=', $name)->first();

        $studentList = Teacher::where('teachers.name', '=', $name)
            ->join('students', 'students.classlist_id', '=', 'teachers.classlist_id')
            ->get();

        $pendingPersonality = 0;
        $pendingInterest = 0;

        foreach ($studentList as $student) {
            if (Personality_Evaluation::where('student_mykid', '=', $student->mykid)
                ->where('teacher_id', '=', $teacher->id)
                ->exists()
            ) {
                continue;
            } else {
                $pendingPersonality++;
            }
        }

        foreach ($studentList as $student) {
            if (Interest_Inventory_Results::where('student_id', '=', $student->id)
                ->where('teacher_id', '=', $teacher->id)
                ->exists()
            ) {
                continue;
            } else {
                $pendingInterest++;
            }
        }

        /* Filter Modal */
        $classes = Classlist::all();
        $years = Merit::selectRaw('YEAR(merits.date) AS year')
            ->pluck('year')
            ->unique();

        // dd($years);
        return view('teachers.home', compact(
            'currMeritsArr',
            'behaMeritsArr',
            'behaDemeritsArr',
            'classMeritsArr',
            'classDemeritsArr',
            'Extraversion',
            'Agreeableness',
            'Neuroticism',
            'Conscientiousness',
            'Openness',
            'InterestResultArr',
            'topMeritArr',
            'topDemeritArr',
            'pendingPersonality',
            'pendingInterest',
            'classes',
            'years'
        ));
    }
}
