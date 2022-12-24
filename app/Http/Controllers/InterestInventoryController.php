<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Interest_Inventory;
use App\Models\Interest_Inventory_Results;

class InterestInventoryController extends Controller
{
    public function viewInterestQuestion($id){
        $student = Student::find($id);
        $realisticquestions = Interest_Inventory::where('category','Realistic')->get();
        $investigativequestions = Interest_Inventory::where('category','Investigative')->get();
        $artisticquestions = Interest_Inventory::where('category','Artistic')->get();
        $socialquestions = Interest_Inventory::where('category','Social')->get();
        $enterprisingquestions = Interest_Inventory::where('category','Enterprising')->get();
        $conventionalquestions = Interest_Inventory::where('category','Conventional')->get();
        return view('evaluations.interestInventory', compact('student','realisticquestions','investigativequestions','artisticquestions','socialquestions','enterprisingquestions','conventionalquestions'));
    }

    public function store(Request $request)
    {
        $studentname = $request->input('studentname');
        $studentid = Student::where('name',$studentname)->first()->id;
        $teachername = auth()->user()->name;
        $teacherid = Teacher::where('name',$teachername)->first()->id;

        $realisticcheckboxes = $request->input('realistic');
        if($realisticcheckboxes!=null){
            $realisticchecked = count($realisticcheckboxes);
        }else{
            $realisticchecked = 0;
        }
        
        $investigativecheckboxes = $request->input('investigative');
        if($investigativecheckboxes !=null){
            $investigativechecked = count($investigativecheckboxes);
        }else{
            $investigativechecked = 0;
        }


        $artisticcheckboxes = $request->input('artistic');
        if($artisticcheckboxes !=null){
            $artisticchecked = count($artisticcheckboxes);
        }else{
            $artisticchecked = 0;
        }

        $socialcheckboxes = $request->input('social');
        if($socialcheckboxes !=null){
            $socialchecked = count($socialcheckboxes);
        }else{
            $socialchecked = 0;
        }

        $enterprisingcheckboxes = $request->input('enterprising');
        if($enterprisingcheckboxes !=null){
            $enterprisingchecked = count($enterprisingcheckboxes);
        }else{
            $enterprisingchecked = 0;
        }

        $conventionalcheckboxes = $request->input('conventional');
        if($conventionalcheckboxes !=null){
            $conventionalchecked = count($conventionalcheckboxes);
        }else{
            $conventionalchecked = 0;
        }

        $result = new Interest_Inventory_Results;
        $result->student_id = $studentid;
        $result->teacher_id = $teacherid;
        $result->realistic = $realisticchecked;
        $result->investigative = $investigativechecked;
        $result->artistic =  $artisticchecked;
        $result->social = $socialchecked;
        $result->enterprising =  $enterprisingchecked;
        $result->conventional =  $conventionalchecked;
        $result->save(); 
        
        return redirect()->route('interestResult',$studentid);
    }
    public function showResult($id){
        $student = Student::find($id);
        $categoryArray = array("Realistic", "Investigative", "Artistic", "Social", "Enterprising","Conventional");
        if(Interest_Inventory_Results::where('student_id',$id)->exists()){
            foreach ($categoryArray as $category) {
                $averageScore = Interest_Inventory_Results::where('student_id',$id)->avg($category);
                $averageArr[$category] = intval(round($averageScore));
            }
            // dd($averageArr);
            $result = Interest_Inventory_Results::where('student_id',$id)->get();

            // $realistic = 0;
            // $investigative = 0;
            // $artistic = 0;
            // $social = 0;
            // $enterprising = 0;
            // $conventional = 0;
            // $teacherids = [];
            // $total = 0;
            $teacherids = [];
            foreach($result as $res){
                if(!in_array($res->teacher_id,$teacherids)){
                    $teacherids[] = $res->teacher_id;
                }
                
                // $realistic += $res->realistic;
                // $total += $res->realistic;
                // $investigative += $res->investigative;
                // $total += $res->investigative;
                // $artistic += $res->artistic;
                // $total += $res->artistic;
                // $social += $res->social;
                // $total += $res->social;
                // $enterprising += $res->enterprising;
                // $total += $res->enterprising;
                // $conventional += $res->conventional;
                // $total += $res->conventional;
            }

            // $result = new Interest_Inventory_Results;
            // $result->realistic = $realistic;
            // $result->investigative = $investigative;
            // $result->artistic =  $artistic;
            // $result->social = $social;
            // $result->enterprising =  $enterprising;
            // $result->conventional =  $conventional;

            // // $realistic = ($realistic/$total)*100;
            // $investigative = ($investigative/$total)*100;
            // $artistic = ($artistic/$total)*100;
            // $social = ($social/$total)*100;
            // $enterprising = ($enterprising/$total)*100;
            // $conventional = ($conventional/$total)*100;
            // $data = [$realistic,$investigative,$artistic,$social,$enterprising,$conventional];
            // dd($data);
        }else{
            $averageArr = "No result found";
            // $data = null;
            $teacherids = null;
        }

        return view('evaluations.interestResult',compact('student','teacherids','averageArr'));
    }

    //For admin to manage assessment
    public function index(){
        $questions = Interest_Inventory::paginate(10);
        return view('assessment.index',compact('questions'));
    }

    public function addquestion(Request $request){
        $question = new Interest_Inventory;

        $question->questions = $request->input('question');
        $question->category = $request->input('category');
        $question->save();
        return redirect()->back();
    }

    public function editassessment(Request $request,$id){
        $question = Interest_Inventory::find($id);
        $question->questions = $request->input('question');
        $question->category = $request->input('category');
        $question->update();

        return redirect()->back();
    }
    public function deletequestion($id)
    {
        $question = Interest_Inventory::find($id);
        $question->delete();
       
        return redirect()->back();
    }

}
