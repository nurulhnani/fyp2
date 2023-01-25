<?php

namespace App\Http\Controllers;

use App\Models\Classlist;
use App\Models\Health;
use App\Models\Student;
use Illuminate\Http\Request;

class HealthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all()->paginate(10);
        $records = Health::all();
        $classes = Classlist::all();
        $studentids = [];
        foreach($records as $record){
            $studentids[] = $record->student_id;
        }
        return view('health.index',compact('students','records','studentids', 'classes'));
    }

    public function search(Request $request)
    {
        $records = Health::all();
        $classes = Classlist::all();
        $studentids = [];
        foreach($records as $record){
            $studentids[] = $record->student_id;
        }        
        
        $search = $request->get('search');
        if ($search != '') {
            $students = Student::where('name', 'like', '%' . $search . '%')
            ->when($request->has('class'), function ($q) use ($request) {
                return $q->where('classlist_id', $request->class);
            })
            ->paginate(10);
            $students->appends(array('search' => $request->input('search'),));
            if (count($students) > 0) {
                return view('health.index',compact('students','records','studentids', 'classes'));
            }
            return back()->with('error', 'No results Found');
        }
        else{
            $students = Student::where('classlist_id', $request->class)->paginate(10);
            return view('health.index',compact('students','records','studentids', 'classes'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // $studentid = Student::where('id','=',$id)->first()->id;
        $student = Student::find($id);
        $record = null;
        // dd($student);
        return view('health.create',compact('student','record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $studentid = Student::where('id','=',$request->id)->first()->id;
        // $student = Student::find($studentid);
        $record = new Health();
        // if($record === null){
            $health_history = [];
            
            $record->student_id = $request->id;
            $record->height = $request->height;
            $record->weight = $request->weight;
            if($request->Back_Injuries == "on"){
                $health_history[] = "Back Injuries";
            }if($request->Heart_Disease == "on"){
                $health_history[] = "Heart Disease";
            }if($request->Permanent_defect_from_illness == "on"){
                $health_history[] = "Permanent defect from illness";
            }if($request->Fainting_dizziness == "on"){
                $health_history[] = "Fainting dizziness";
            }if($request->Stomach_Ulcer == "on"){
                $health_history[] = "Stomach Ulcer";
            }if($request->Asthma == "on"){
                $health_history[] = "Asthma";
            }if($request->Allergies == "on"){
                $health_history[] = "Allergies";
            }if($request->Rheumatic_fever == "on"){
                $health_history[] = "Rheumatic fever";
            }if($request->Eye_disease == "on"){
                $health_history[] = "Eye disease";
            }if($request->Tuberculosis == "on"){
                $health_history[] = "Tuberculosis";
            }if($request->Hearing_difficulty == "on"){
                $health_history[] = "Hearing difficulty";
            }if($request->Ear_nose_throat_trouble_sinus == "on"){
                $health_history[] = "Ear nose throat trouble-sinus";
            }if($request->Hepatitis == "on"){
                $health_history[] = "Hepatitis";
            }if($request->Kidney_disease == "on"){
                $health_history[] = "Kidney disease";
            }if($request->Nervous_disorder == "on"){
                $health_history[] = "Nervous disorder";
            }if($request->Respiratory_disease == "on"){
                $health_history[] = "Respiratory disease";
            }if($request->Muscular_disease == "on"){
                $health_history[] = "Muscular disease";
            }if($request->Mental_illness == "on"){
                $health_history[] = "Mental illness";
            }if($request->High_Blood_Pressure == "on"){
                $health_history[] = "High Blood Pressure";
            }if($request->Hernia == "on"){
                $health_history[] = "Hernia";
            }if($request->Arthritis_joint_disease == "on"){
                $health_history[] = "Arthritis joint disease";
            }if($request->Diabetes == "on"){
                $health_history[] = "Diabetes";
            }if($request->Cancer == "on"){
                $health_history[] = "Cancer";
            }if($request->Headaches == "on"){
                $health_history[] = "Headaches";
            }if($request->Medical_treatment == "on"){
                $health_history[] = "Medical treatment";
            }
            $healthhistory = implode(',',$health_history);
            $record->health_history = $healthhistory;

            $record->description = $request->description;
            $record->medication_allergies = $request->medication_allergies;
            $record->medications_now_taking = $request->medications_now_taking;

            $chicken_pox = [];
            if($request->had_chickenpox == "on"){
                $chicken_pox[] = "Had";
            }if($request->immunized_chickenpox == "on"){
                $chicken_pox[] = "Immunized";
            }
            $chickenpox = implode(',',$chicken_pox);
            $record->chicken_pox = $chickenpox;

            $measles = [];
            if($request->had_measles == "on"){
                $measles[] = "Had";
            }if($request->immunized_measles == "on"){
                $measles[] = "Immunized";
            }
            $newmeasles = implode(',',$measles); 
            $record->measles = $newmeasles;

            $mumps = [];
            if($request->had_mumps == "on"){
                $mumps[] = "Had";
            }if($request->immunized_mumps == "on"){
                $mumps[] = "Immunized";
            }
            $newmumps = implode(',',$mumps);
            $record->mumps = $newmumps;

            if($request->Excellent == "on"){
                $record->present_health = "Excellent";
            }else if($request->Good == "on"){
                $record->present_health = "Good";
            }else if($request->Fair == "on"){
                $record->present_health = "Fair";
            }else{
                $record->present_health = "Poor";
            }

            $record->save();
        // }

        return redirect()->route('health.index')->with('success', 'Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        $record = Health::where('student_id','=',$student->id)->first();
        return view('health.show',compact('student','record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $record = Health::where('student_id','=',$student->id)->first();
        return view('health.edit',compact('student','record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $studentid = Student::where('id','=',$id)->first()->id;
        $student = Student::find($studentid);
        $record = Health::where('student_id','=',$studentid)->first();

        $record->height = $request->height;
        $record->weight = $request->weight;
        if($request->Back_Injuries == "on"){
            $health_history[] = "Back Injuries";
        }if($request->Heart_Disease == "on"){
            $health_history[] = "Heart Disease";
        }if($request->Permanent_defect_from_illness == "on"){
            $health_history[] = "Permanent defect from illness";
        }if($request->Fainting_dizziness == "on"){
            $health_history[] = "Fainting dizziness";
        }if($request->Stomach_Ulcer == "on"){
            $health_history[] = "Stomach Ulcer";
        }if($request->Asthma == "on"){
            $health_history[] = "Asthma";
        }if($request->Allergies == "on"){
            $health_history[] = "Allergies";
        }if($request->Rheumatic_fever == "on"){
            $health_history[] = "Rheumatic fever";
        }if($request->Eye_disease == "on"){
            $health_history[] = "Eye disease";
        }if($request->Tuberculosis == "on"){
            $health_history[] = "Tuberculosis";
        }if($request->Hearing_difficulty == "on"){
            $health_history[] = "Hearing difficulty";
        }if($request->Ear_nose_throat_trouble_sinus == "on"){
            $health_history[] = "Ear nose throat trouble-sinus";
        }if($request->Hepatitis == "on"){
            $health_history[] = "Hepatitis";
        }if($request->Kidney_disease == "on"){
            $health_history[] = "Kidney disease";
        }if($request->Nervous_disorder == "on"){
            $health_history[] = "Nervous disorder";
        }if($request->Respiratory_disease == "on"){
            $health_history[] = "Respiratory disease";
        }if($request->Muscular_disease == "on"){
            $health_history[] = "Muscular disease";
        }if($request->Mental_illness == "on"){
            $health_history[] = "Mental illness";
        }if($request->High_Blood_Pressure == "on"){
            $health_history[] = "High Blood Pressure";
        }if($request->Hernia == "on"){
            $health_history[] = "Hernia";
        }if($request->Arthritis_joint_disease == "on"){
            $health_history[] = "Arthritis joint disease";
        }if($request->Diabetes == "on"){
            $health_history[] = "Diabetes";
        }if($request->Cancer == "on"){
            $health_history[] = "Cancer";
        }if($request->Headaches == "on"){
            $health_history[] = "Headaches";
        }if($request->Medical_treatment == "on"){
            $health_history[] = "Medical treatment";
        }
        $healthhistory = implode(',',$health_history);
        $record->health_history = $healthhistory;

        $record->description = $request->description;
        $record->medication_allergies = $request->medication_allergies;
        $record->medications_now_taking = $request->medications_now_taking;

        $chicken_pox = [];
        if($request->had_chickenpox == "on"){
            $chicken_pox[] = "Had";
        }if($request->immunized_chickenpox == "on"){
            $chicken_pox[] = "Immunized";
        }
        $chickenpox = implode(',',$chicken_pox);
        $record->chicken_pox = $chickenpox;

        $measles = [];
        if($request->had_measles == "on"){
            $measles[] = "Had";
        }if($request->immunized_measles == "on"){
            $measles[] = "Immunized";
        }
        $newmeasles = implode(',',$measles); 
        $record->measles = $newmeasles;

        $mumps = [];
        if($request->had_mumps == "on"){
            $mumps[] = "Had";
        }if($request->immunized_mumps == "on"){
            $mumps[] = "Immunized";
        }
        $newmumps = implode(',',$mumps);
        $record->mumps = $newmumps;

        if($request->Excellent == "on"){
            $record->present_health = "Excellent";
        }else if($request->Good == "on"){
            $record->present_health = "Good";
        }else if($request->Fair == "on"){
            $record->present_health = "Fair";
        }else{
            $record->present_health = "Poor";
        }

        $record->update();      

        return redirect()->route('health.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Health::where('student_id','=',$id);
        $record->delete();
       
        return redirect()->route('health.index')
                        ->with('success','Record deleted successfully');
    }
}
