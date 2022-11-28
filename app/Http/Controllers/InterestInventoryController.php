<?php

namespace App\Http\Controllers;

use App\Models\Student;
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
        return view('evaluation.interestInventory', compact('student','realisticquestions','investigativequestions','artisticquestions','socialquestions','enterprisingquestions','conventionalquestions'));
    }

    public function store(Request $request)
    {
        $studentname = $request->input('studentname');
        $studentid = Student::where('name',$studentname)->first()->id;

        $findInResultid = Interest_Inventory_Results::where('student_id',$studentid)->get();
        // dd($findInResultid);

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

        if($findInResultid == null){
            $result = new Interest_Inventory_Results;
            $result->student_id = $studentid;
            $student = Student::find($studentid);
            $result->realistic = $realisticchecked;
            $result->investigative = $investigativechecked;
            $result->artistic =  $artisticchecked;
            $result->social = $socialchecked;
            $result->enterprising =  $enterprisingchecked;
            $result->conventional =  $conventionalchecked;
            $result->save(); 
        }else{
            $resultid = Interest_Inventory_Results::where('student_id',$studentid)->first()->id;
            $result = Interest_Inventory_Results::find($resultid);
            $result->realistic = $realisticchecked;
            $result->investigative = $investigativechecked;
            $result->artistic =  $artisticchecked;
            $result->social = $socialchecked;
            $result->enterprising =  $enterprisingchecked;
            $result->conventional =  $conventionalchecked;
            $result->update();
        }
        

        return redirect()->route('interestResult',$studentid);
    }
    public function showResult($id){
        $student = Student::find($id);
        $resultid = Interest_Inventory_Results::where('student_id',$id)->first();
        if($resultid === null){
            $result = "No result found";
        }else{
            $resultid = Interest_Inventory_Results::where('student_id',$id)->first()->id;
            $result = Interest_Inventory_Results::find($resultid);
        }
        // dd($result);
        return view('evaluation.interestResult',compact('student','result'));
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
