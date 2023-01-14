<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Merit;
use App\Models\Health;
use App\Models\Student;
use App\Models\LoginCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Personality_Evaluation;
use App\Models\Interest_Inventory_Results;


class PDFController extends Controller
{
    public function showExportForm($id){
        $student = Student::find($id);
        $years = LoginCount::select(DB::raw("YEAR(created_at) as year"))->distinct()->get();
        return view('students.exportProfile',compact('student','years'));
    }

    //export for teacher
    public function exportPage(){
        $years = LoginCount::select(DB::raw("YEAR(created_at) as year"))->distinct()->get();
        return view('teachers.exportPage',compact('years'));
    }

    public function showStudentProfile($id){
        ////// Personal Details /////////
        $student = Student::find($id);

        ////// Personality traits //////
        $categoryPersArray = array("Extraversion", "Agreeableness", "Neuroticism", "Conscientiousness", "Openness");
        if (Personality_Evaluation::where('student_mykid', '=', $student->mykid)->exists()) {
            foreach ($categoryPersArray as $category) {
                $averagePersScore = Personality_Evaluation::where('student_mykid', '=', $student->mykid)->avg($category);
                $averagePersArr[$category] = intval(round($averagePersScore));
            }
        } else {
            $averagePersArr = null;
        }

        ////// Interest Inventory ///////
        $categoryArray = array("Realistic", "Investigative", "Artistic", "Social", "Enterprising", "Conventional");
        if (Interest_Inventory_Results::where('student_id', $id)->exists()) {
            foreach ($categoryArray as $category) {
                $averageScore = Interest_Inventory_Results::where('student_id', $id)->avg($category);
                $averageArr[$category] = intval(round($averageScore));
            }

            // $result = Interest_Inventory_Results::where('student_id', $id)->get();
            // $teacherids = [];
            // foreach ($result as $res) {
            //     if (!in_array($res->teacher_id, $teacherids)) {
            //         $teacherids[] = $res->teacher_id;
            //     }
            // }
        } else {
            $averageArr = "No result found";
            // $teacherids = null;
        }

        //////// Cocu Merit //////
        if (Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->exists()) {
            $merits = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->get();
            // $latestDate = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->latest()->first();
        } else {
            $merits = null;
            $latestDate = null;
        }
        // dd($merits);
        return view('students.showProfile',compact('student','averagePersArr','averageArr','merits'));
    }
    public function generatePDF($id)
    {
        // $student = Student::find($id);
  
        // $data = [
        //     'title' => 'Mescore Student Profiling System',
        //     'date' => date('d/m/Y'),
        //     'student' => $student
        // ]; 

        // dd($data);
            
        // $pdf = PDF::loadView('studentprofilePDF', $data)->setOptions(['defaultFont' => 'sans-serif']);


        ////// Personal Details /////////
        $student = Student::find($id);

        ////// Personality traits //////
        $categoryPersArray = array("Extraversion", "Agreeableness", "Neuroticism", "Conscientiousness", "Openness");
        if (Personality_Evaluation::where('student_mykid', '=', $student->mykid)->exists()) {
            foreach ($categoryPersArray as $category) {
                $averagePersScore = Personality_Evaluation::where('student_mykid', '=', $student->mykid)->avg($category);
                $averagePersArr[$category] = intval(round($averagePersScore));
            }
        } else {
            $averagePersArr = null;
        }

        ////// Interest Inventory ///////
        $categoryArray = array("Realistic", "Investigative", "Artistic", "Social", "Enterprising", "Conventional");
        if (Interest_Inventory_Results::where('student_id', $id)->exists()) {
            foreach ($categoryArray as $category) {
                $averageScore = Interest_Inventory_Results::where('student_id', $id)->avg($category);
                $averageArr[$category] = intval(round($averageScore));
            }

            // $result = Interest_Inventory_Results::where('student_id', $id)->get();
            // $teacherids = [];
            // foreach ($result as $res) {
            //     if (!in_array($res->teacher_id, $teacherids)) {
            //         $teacherids[] = $res->teacher_id;
            //     }
            // }
        } else {
            $averageArr = "No result found";
            // $teacherids = null;
        }

        //////// Cocu Merit //////
        if (Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->exists()) {
            $merits = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->get();
            // $latestDate = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->latest()->first();
        } else {
            $merits = null;
            $latestDate = null;
        }
        // dd($merits);
        $pdf = PDF::loadView('exportProfile.student-profilePDF', compact('student','averagePersArr','averageArr','merits'));
        return $pdf->download('student-profile.pdf');
    }
    public function showPDF(Request $request, $id)
    {

        ////// Personal Details /////////
        $student = Student::find($id);

        ////// Personality traits //////

        $categoryArray = array("Extraversion", "Agreeableness", "Neuroticism", "Conscientiousness", "Openness");
        
        if (Personality_Evaluation::where('student_mykid', '=', $student->mykid)->exists()) {
            // foreach ($categoryPersArray as $category) {
            //     $averagePersScore = Personality_Evaluation::where('student_mykid', '=', $student->mykid)->avg($category);
            //     $averagePersArr[$category] = intval(round($averagePersScore));
            // }
            foreach ($categoryArray as $category) {
                $averageScore = Personality_Evaluation::where('student_mykid', '=', $student->mykid)
                    ->when($request->year != null, function ($q) use ($request) {
                        return $q->where(DB::raw('YEAR(created_at)'), $request->year);
                    })
                    ->avg($category);
    
                $averagePersArr[$category] = intval(round($averageScore));
            }
        } else {
            $averagePersArr = null;
        }

        ////// Interest Inventory ///////
        $categoryArray = array("Realistic", "Investigative", "Artistic", "Social", "Enterprising", "Conventional");
        if (Interest_Inventory_Results::where('student_id', $id)->exists()) {

            foreach ($categoryArray as $category) {
                $averageScore = Interest_Inventory_Results::where('student_id', $id)
                    ->when($request->year != null, function ($q) use ($request) {
                        return $q->where(DB::raw('YEAR(created_at)'), $request->year);
                    })
                    ->avg($category);
    
                $averageArr[$category] = intval(round($averageScore));
            }
            // dd($averageArr);

        } else {
            $averageArr = "No result found";
        }

        //////// Cocu Merit //////
        if (Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->exists()) {
            $merits = Merit::where('student_mykid', '=', $student->mykid)
                        ->where('type', '=', 'c')
                        ->when($request->year != null, function ($q) use ($request) {
                            return $q->where(DB::raw('YEAR(date)'), $request->year);
                        })
                        ->get();

                        // dd($merits);

            // foreach ($categoryArray as $category) {
            //     $averageScore = Interest_Inventory_Results::where('student_id', $id)
            //         ->when($request->year != null, function ($q) use ($request) {
            //             return $q->where(DB::raw('YEAR(created_at)'), $request->year);
            //         })
            //         ->avg($category);
    
            //     $averageArr[$category] = intval(round($averageScore));
            // }

            // $latestDate = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->latest()->first();
        } else {
            $merits = null;
        }

        ////////// Health Records /////////

        $student = Student::find($id);
        $record = Health::where('student_id','=',$student->id)->first();
        
        // $pdf = PDF::loadView('exportProfile.student-profilePDF', compact('student','averagePersArr','averageArr','merits'))->setOptions(['defaultFont' => 'sans-serif']);
        return view('exportProfile.student-profilePDF', compact('student','averagePersArr','averageArr','merits','record'));
    }
    public function showStudentPDF(Request $request)
    {

        ////// Personal Details /////////
        $studentname = $request->name;
        $studentid = Student::where('name','=',$studentname)->first();
        if(isset($studentid)){
            $student = Student::find($studentid->id);

            ////// Personality traits //////

            $categoryArray = array("Extraversion", "Agreeableness", "Neuroticism", "Conscientiousness", "Openness");
            
            if (Personality_Evaluation::where('student_mykid', '=', $student->mykid)->exists()) {
                // foreach ($categoryPersArray as $category) {
                //     $averagePersScore = Personality_Evaluation::where('student_mykid', '=', $student->mykid)->avg($category);
                //     $averagePersArr[$category] = intval(round($averagePersScore));
                // }
                foreach ($categoryArray as $category) {
                    $averageScore = Personality_Evaluation::where('student_mykid', '=', $student->mykid)
                        ->when($request->year != null, function ($q) use ($request) {
                            return $q->where(DB::raw('YEAR(created_at)'), $request->year);
                        })
                        ->avg($category);
        
                    $averagePersArr[$category] = intval(round($averageScore));
                }
            } else {
                $averagePersArr = null;
            }

            ////// Interest Inventory ///////
            $categoryArray = array("Realistic", "Investigative", "Artistic", "Social", "Enterprising", "Conventional");
            if (Interest_Inventory_Results::where('student_id', $student->id)->exists()) {

                foreach ($categoryArray as $category) {
                    $averageScore = Interest_Inventory_Results::where('student_id', $student->id)
                        ->when($request->year != null, function ($q) use ($request) {
                            return $q->where(DB::raw('YEAR(created_at)'), $request->year);
                        })
                        ->avg($category);
        
                    $averageArr[$category] = intval(round($averageScore));
                }
                // dd($averageArr);

            } else {
                $averageArr = "No result found";
            }

            //////// Cocu Merit //////
            if (Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->exists()) {
                $merits = Merit::where('student_mykid', '=', $student->mykid)
                            ->where('type', '=', 'c')
                            ->when($request->year != null, function ($q) use ($request) {
                                return $q->where(DB::raw('YEAR(date)'), $request->year);
                            })
                            ->get();

                            // dd($merits);

                // foreach ($categoryArray as $category) {
                //     $averageScore = Interest_Inventory_Results::where('student_id', $id)
                //         ->when($request->year != null, function ($q) use ($request) {
                //             return $q->where(DB::raw('YEAR(created_at)'), $request->year);
                //         })
                //         ->avg($category);
        
                //     $averageArr[$category] = intval(round($averageScore));
                // }

                // $latestDate = Merit::where('student_mykid', '=', $student->mykid)->where('type', '=', 'c')->latest()->first();
            } else {
                $merits = null;
            }

            ////////// Health Records /////////

            // $student = Student::find($id);
            $record = Health::where('student_id','=',$student->id)->first();
            return view('exportProfile.teacher-studentprofilePDF', compact('student','averagePersArr','averageArr','merits','record'));
            // $pdf = PDF::loadView('exportProfile.student-profilePDF', compact('student','averagePersArr','averageArr','merits'))->setOptions(['defaultFont' => 'sans-serif']);
        }else{
            $years = LoginCount::select(DB::raw("YEAR(created_at) as year"))->distinct()->get();
            return redirect()->route('exportPage',compact('years'))->with('error','Student entered does not exist');
        }
        

    }
}
