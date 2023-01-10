@extends('layouts.teacherapp')

@section('content')
@include('layouts.headers.cards')
<!-- Header -->
<div class="header pb-5">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-12 col-12">
          <h6 class="h2 text-black d-inline-block mb-0">Health Assessment</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{ route('health.index') }}">Student List</a></li>
              <li class="breadcrumb-item active" aria-current="page">Health Assessment</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">

          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0 text-center">Student Health Assessment Form</h3>
              <hr class="my-4" />
            </div>  
            
            <form method="post" action="{{route('health.update',$student->id)}}">
            @csrf
            @method('PUT')
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col">
                        <h3 class="heading text-muted">STUDENT INFORMATION</h3>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col-sm-2">
                        <h4>Name</h4>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-default">{{$student->name}}</p>
                    </div>
                    <div class="col-sm-1">
                        <h4>Class</h4>
                    </div>
                    @if(isset($student->class->class_name))
                    <div class="col-sm-3">
                        <p class="text-default">{{$student->class->class_name}}</p>
                        <input type="hidden" class="form-control" name="id" value="{{$student->id}}">
                    </div>
                    @else
                    <div class="col-sm-3">
                        <p class="text-default">Not Yet Assigned</p>
                        <input type="hidden" class="form-control" name="id" value="{{$student->id}}">
                    </div>
                    @endif
                    
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <h4>Gender</h4>
                    </div>
                    <div class="col-sm-2">
                        <p class="text-default">{{$student->gender}}</p>
                    </div>
                    <div class="col-sm-1">
                        <h4>Height</h4>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="height" value='@if($record != null){{$record->height}} @else  @endif'>
                        {{-- <p name="height" class="text-default">@if($record != null){{$record->height}} @else N/A @endif</p> --}}
                    </div>
                    <div class="col-sm-1">
                        <h4>Weight</h4>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="weight" value='@if($record != null){{$record->weight}} @else  @endif'>
                        {{-- <p name="weight" class="text-default">@if($record != null){{$record->weight}} @else N/A @endif</p> --}}
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col">
                        <h3 class="heading text-muted">STUDENT'S HEALTH HISTORY</h3>
                    </div>
                </div>

                <?php
                if($record != null){
                    if($record->health_history == null){
                        $health_explode = ["N/A"];
                        
                    }else{
                        $health_history = $record->health_history;
                        $health_explode = explode(',',$health_history);
                    }
                   
                }else{
                    $health_explode = ["N/A"];
                }
                    
                ?>

                <div class="row pt-3">
                    <div class="col-sm-3">
                        <h4>Back Injuries</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle"> 
                                <input type="checkbox" name="Back Injuries" @if(in_array('Back Injuries',$health_explode)) checked="checked" @endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Heart Disease</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Heart Disease" @if(in_array('Heart Disease',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Permanent defect from illness</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Permanent defect from illness" @if(in_array('Permanent defect from illness',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-3">
                        <h4>Fainting, dizziness</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Fainting dizziness" @if(in_array('Fainting dizziness',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Stomach Ulcer</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Stomach Ulcer" @if(in_array('Stomach Ulcer',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Asthma</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Asthma" @if(in_array('Asthma',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-3">
                        <h4>Allergies</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Allergies" @if(in_array('Allergies',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Rheumatic fever</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Rheumatic fever" @if(in_array('Rheumatic fever',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Eye disease</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Eye disease" @if(in_array('Eye disease',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-3">
                        <h4>Tuberculosis</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Tuberculosis" @if(in_array('Tuberculosis',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Hearing difficulty</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Hearing difficulty" @if(in_array('Hearing difficulty',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Ear, nose, throat trouble-sinus</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Ear nose throat trouble sinus" @if(in_array('Ear nose throat trouble-sinus',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-3">
                        <h4>Hepatitis</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Hepatitis" @if(in_array('Hepatitis',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Kidney disease</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Kidney disease" @if(in_array('Kidney disease',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Nervous disorder</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Nervous disorder" @if(in_array('Nervous disorder',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-3">
                        <h4>Respiratory disease</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Respiratory disease" @if(in_array('Respiratory disease',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Muscular disease</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Muscular disease" @if(in_array('Muscular disease',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Mental illness</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Mental illness" @if(in_array('Mental illness',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-3">
                        <h4>High Blood Pressure</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="High Blood Pressure" @if(in_array('High Blood Pressure',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Hernia</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Hernia" @if(in_array('Hernia',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Arthritis, joint disease</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Arthritis joint disease" @if(in_array('Arthritis joint disease',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-3">
                        <h4>Diabetes</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Diabetes" @if(in_array('Diabetes',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Cancer</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Cancer" @if(in_array('Cancer',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                    <div class="col-sm-3">
                        <h4>Headaches</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Headaches" @if(in_array('Headaches',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-7">
                        <h4>Receiving medical treatment at the present time or in the past 6 months</h4>
                    </div>
                    <div class="col-sm-1">
                        <div class="custom-toggle">
                            <label class="custom-toggle">
                                <input type="checkbox" name="Medical treatment" @if(in_array('Medical treatment',$health_explode)) checked="checked"@endif>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            </label>
                         </div> 
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <h4>If answer to any of the above is yes, explain:</h4>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="input-group">
                                @if($record != null)
                                <textarea class="form-control" aria-label="With textarea" name="description">{{$record->description}}</textarea>
                                @else
                                <textarea class="form-control" aria-label="With textarea" name="description" placeholder="N/A"></textarea>
                                @endif
                              
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-2">
                        <h4>Medication Allergies</h4>
                    </div>
                    <div class="col-sm-4">
                    @if($record != null)
                        <input type="text" class="form-control" name="medication_allergies" value="{{$record->medication_allergies}}">
                    @else
                        <input type="text" class="form-control" name="medication_allergies" placeholder="N/A">
                    @endif
                    </div>
                    <div class="col-sm-2">
                        <h4>Medications Now Taking</h4>
                    </div>
                    <div class="col-sm-4">
                    @if($record != null)
                        <input type="text" class="form-control" name="medications_now_taking" value="{{$record->medications_now_taking}}">
                    @else
                        <input type="text" class="form-control" name="medications_now_taking" placeholder="N/A">
                    @endif
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <h4>Childhood Diseases:</h4>
                    </div>
                </div>
                <?php 
                if($record != null){
                    if($record->chicken_pox != null){
                        $chickenpox = explode(',',$record->chicken_pox);
                    }else{
                        $chickenpox = "N/A";
                    }

                    if($record->measles != null){
                        $measles = explode(',',$record->chicken_pox);
                    }else{
                        $measles = ["N/A"];
                    }
                    
                    if($record->mumps != null){
                        $mumps = explode(',',$record->mumps);
                    }else{
                        $mumps = ["N/A"];
                    }
                }else{
                    $chickenpox = ["N/A"];
                    $measles = ["N/A"];
                    $mumps = ["N/A"];
                }
                    
                ?>
                <div class="row pt-3">
                    <div class="col-sm-4">
                        <h4 class="pt-2">Chicken pox</h4>
                    </div>
                    <div class="col-sm-2 text-left">
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <input type="checkbox" aria-label="Checkbox for following text input" name="had_chickenpox" @if(in_array('Had',$chickenpox)) checked="checked"@endif>
                                </div>
                              </div>
                              <input type="text" class="form-control" value="Had">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <input type="checkbox" aria-label="Checkbox for following text input" name="immunized_chickenpox" @if(in_array('Immunized',$chickenpox)) checked="checked"@endif>
                                </div>
                              </div>
                              <input type="text" class="form-control" value="Immunized">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="pt-2">Measles</h4>
                    </div>
                    <div class="col-sm-2 text-left">
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <input type="checkbox" aria-label="Checkbox for following text input" name="had_measles" @if(in_array('Had',$measles)) checked="checked"@endif>
                                </div>
                              </div>
                              <input type="text" class="form-control" value="Had">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <input type="checkbox" aria-label="Checkbox for following text input" name="immunized_measles" @if(in_array('Immunized',$measles)) checked="checked"@endif>
                                </div>
                              </div>
                              <input type="text" class="form-control" value="Immunized">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="pt-2">Mumps</h4>
                    </div>
                    <div class="col-sm-2 text-left">
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <input type="checkbox" aria-label="Checkbox for following text input" name="had_mumps" @if(in_array('Had',$mumps)) checked="checked"@endif>
                                </div>
                              </div>
                              <input type="text" class="form-control" value="Had">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <input type="checkbox" aria-label="Checkbox for following text input" name="immunized_mumps" @if(in_array('Immunized',$mumps)) checked="checked"@endif>
                                </div>
                              </div>
                              <input type="text" class="form-control" value="Immunized">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="pt-2">This student’s present health is:</h4>
                    </div>
                    <div class="col-sm-2 text-left">
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <input type="checkbox" aria-label="Checkbox for following text input" name="Excellent" @if($record != null) @if($record->present_health == "Excellent") checked="checked"@endif @endif>
                                </div>
                              </div>
                              <input type="text" class="form-control" value="Excellent">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <input type="checkbox" aria-label="Checkbox for following text input" name="Good" @if($record != null) @if($record->present_health == "Good") checked="checked"@endif @endif>
                                </div>
                              </div>
                              <input type="text" class="form-control" value="Good">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <input type="checkbox" aria-label="Checkbox for following text input" name="Fair" @if($record != null) @if($record->present_health == "Fair") checked="checked"@endif @endif>
                                </div>
                              </div>
                              <input type="text" class="form-control" value="Fair">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text"> 
                                  <input type="checkbox" aria-label="Checkbox for following text input" name="Poor" @if($record != null) @if($record->present_health == "Poor") checked="checked"@endif @endif>
                                </div>
                              </div>
                              <input type="text" class="form-control" value="Poor">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mb-5">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                    <a href="#deleteModal{{$student->id}}" data-toggle="modal"><button class="btn btn-primary">Delete</button></a>
                </div> 
            </div> 
            </form>
          </div>

{{-- Delete Class Subject --}}
<div class="modal fade" id="deleteModal{{$student->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Delete Health Record</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="POST" action="{{route('health.destroy',$student->id)}}">
            @csrf
          @method('delete')
          <div class="modal-body">
            <?php 
              $student = App\Models\Student::find($student->id);
            ?>
              <h4 class="text-center">Confirm to delete health record for {{$student->name}}?</h4>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i>Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>

    </div>
  </div>
  @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush