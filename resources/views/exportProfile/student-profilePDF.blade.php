<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <link rel="stylesheet" href="{{ ltrim(public_path('assets/css/argon.css'), '/') }}" /> --}}
        {{-- <link rel="stylesheet" href="{{ ltrim(public_path('assets/css/bootstrap/bootstrap.css'), '/') }}" /> --}}

    </head>
    <style type="text/css">
        .row
        {
            display: flex;

            margin-right: -15px;
            margin-left: -15px; 

            flex-wrap: wrap;
        }
        .col-1,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-10,
        .col-11,
        .col-12,
        .col,
        .col-auto,
        .col-sm-1,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm,
        .col-sm-auto,
        .col-md-1,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md,
        .col-md-auto,
        .col-lg-1,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg,
        .col-lg-auto,
        .col-xl-1,
        .col-xl-2,
        .col-xl-3,
        .col-xl-4,
        .col-xl-5,
        .col-xl-6,
        .col-xl-7,
        .col-xl-8,
        .col-xl-9,
        .col-xl-10,
        .col-xl-11,
        .col-xl-12,
        .col-xl,
        .col-xl-auto
        {
            position: relative;

            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col
        {
            max-width: 100%; 

            flex-basis: 0;
            flex-grow: 1;
        }

        .col-auto
        {
            width: auto;
            max-width: none; 

            flex: 0 0 auto;
        }

        .col-1
        {
            max-width: 8.33333%; 

            flex: 0 0 8.33333%;
        }

        .col-2
        {
            max-width: 16.66667%; 

            flex: 0 0 16.66667%;
        }

        .col-3
        {
            max-width: 25%; 

            flex: 0 0 25%;
        }

        .col-4
        {
            max-width: 33.33333%; 

            flex: 0 0 33.33333%;
        }

        .col-5
        {
            max-width: 41.66667%; 

            flex: 0 0 41.66667%;
        }

        .col-6
        {
            max-width: 50%; 

            flex: 0 0 50%;
        }

        .col-7
        {
            max-width: 58.33333%; 

            flex: 0 0 58.33333%;
        }

        .col-8
        {
            max-width: 66.66667%; 

            flex: 0 0 66.66667%;
        }

        .col-9
        {
            max-width: 75%; 

            flex: 0 0 75%;
        }

        .col-10
        {
            max-width: 83.33333%; 

            flex: 0 0 83.33333%;
        }

        .col-11
        {
            max-width: 91.66667%; 

            flex: 0 0 91.66667%;
        }

        .col-12
        {
            max-width: 100%; 

            flex: 0 0 100%;
        }
        .table
        {
            width: 100%;
            margin-bottom: 1rem;

            background-color: transparent;
        }
        .table th,
        .table td
        {
            padding: 1rem;

            vertical-align: top;

            border-top: 1px solid #e9ecef;
        }
        .table thead th
        {
            vertical-align: bottom;

            border-bottom: 2px solid #e9ecef;
        }
        .table tbody + tbody
        {
            border-top: 2px solid #e9ecef;
        }
        .table .table
        {
            background-color: #f8f9fe;
        }

        .table-sm th,
        .table-sm td
        {
            padding: .5rem;
        }

        .table-bordered
        {
            border: 1px solid #e9ecef;
        }
        .table-bordered th,
        .table-bordered td
        {
            border: 1px solid #e9ecef;
        }
        .table-bordered thead th,
        .table-bordered thead td
        {
            border-bottom-width: 2px;
        }

        .table-borderless th,
        .table-borderless td,
        .table-borderless thead th,
        .table-borderless tbody + tbody
        {
            border: 0;
        }

        .table-striped tbody tr:nth-of-type(odd)
        {
            background-color: rgba(0, 0, 0, .05);
        }

        .table-hover tbody tr:hover
        {
            background-color: #f6f9fc;
        }

        .table-primary,
        .table-primary > th,
        .table-primary > td
        {
            background-color: #d2d8f7;
        }

        .table-hover .table-primary:hover
        {
            background-color: #bcc5f3;
        }
        .table-hover .table-primary:hover > td,
        .table-hover .table-primary:hover > th
        {
            background-color: #bcc5f3;
        }

        .table-secondary,
        .table-secondary > th,
        .table-secondary > td
        {
            background-color: #fdfefe;
        }

        .table-hover .table-secondary:hover
        {
            background-color: #ecf6f6;
        }
        .table-hover .table-secondary:hover > td,
        .table-hover .table-secondary:hover > th
        {
            background-color: #ecf6f6;
        }

        .table-success,
        .table-success > th,
        .table-success > td
        {
            background-color: #c4f1de;
        }

        .table-hover .table-success:hover
        {
            background-color: #afecd2;
        }
        .table-hover .table-success:hover > td,
        .table-hover .table-success:hover > th
        {
            background-color: #afecd2;
        }

        .table-info,
        .table-info > th,
        .table-info > td
        {
            background-color: #bcf1fb;
        }

        .table-hover .table-info:hover
        {
            background-color: #a4ecfa;
        }
        .table-hover .table-info:hover > td,
        .table-hover .table-info:hover > th
        {
            background-color: #a4ecfa;
        }

        .table-warning,
        .table-warning > th,
        .table-warning > td
        {
            background-color: #fed3ca;
        }

        .table-hover .table-warning:hover
        {
            background-color: #febeb1;
        }
        .table-hover .table-warning:hover > td,
        .table-hover .table-warning:hover > th
        {
            background-color: #febeb1;
        }

        .table-danger,
        .table-danger > th,
        .table-danger > td
        {
            background-color: #fcc7d1;
        }

        .table-hover .table-danger:hover
        {
            background-color: #fbafbd;
        }
        .table-hover .table-danger:hover > td,
        .table-hover .table-danger:hover > th
        {
            background-color: #fbafbd;
        }

        .table-light,
        .table-light > th,
        .table-light > td
        {
            background-color: #e8eaed;
        }

        .table-hover .table-light:hover
        {
            background-color: #dadde2;
        }
        .table-hover .table-light:hover > td,
        .table-hover .table-light:hover > th
        {
            background-color: #dadde2;
        }

        .table-dark,
        .table-dark > th,
        .table-dark > td
        {
            background-color: #c1c2c3;
        }

        .table-hover .table-dark:hover
        {
            background-color: #b4b5b6;
        }
        .table-hover .table-dark:hover > td,
        .table-hover .table-dark:hover > th
        {
            background-color: #b4b5b6;
        }

        .table-default,
        .table-default > th,
        .table-default > td
        {
            background-color: #bec4cd;
        }

        .table-hover .table-default:hover
        {
            background-color: #b0b7c2;
        }
        .table-hover .table-default:hover > td,
        .table-hover .table-default:hover > th
        {
            background-color: #b0b7c2;
        }

        .table-white,
        .table-white > th,
        .table-white > td
        {
            background-color: white;
        }

        .table-hover .table-white:hover
        {
            background-color: #f2f2f2;
        }
        .table-hover .table-white:hover > td,
        .table-hover .table-white:hover > th
        {
            background-color: #f2f2f2;
        }

        .table-neutral,
        .table-neutral > th,
        .table-neutral > td
        {
            background-color: white;
        }

        .table-hover .table-neutral:hover
        {
            background-color: #f2f2f2;
        }
        .table-hover .table-neutral:hover > td,
        .table-hover .table-neutral:hover > th
        {
            background-color: #f2f2f2;
        }

        .table-darker,
        .table-darker > th,
        .table-darker > td
        {
            background-color: #b8b8b8;
        }

        .table-hover .table-darker:hover
        {
            background-color: #ababab;
        }
        .table-hover .table-darker:hover > td,
        .table-hover .table-darker:hover > th
        {
            background-color: #ababab;
        }

        .table-active,
        .table-active > th,
        .table-active > td
        {
            background-color: #f6f9fc;
        }

        .table-hover .table-active:hover
        {
            background-color: #e3ecf6;
        }
        .table-hover .table-active:hover > td,
        .table-hover .table-active:hover > th
        {
            background-color: #e3ecf6;
        }

        .table .thead-dark th
        {
            color: #f8f9fe;
            border-color: #1f3a68; 
            background-color: #172b4d;
        }

        .table .thead-light th
        {
            color: #8898aa;
            border-color: #e9ecef; 
            background-color: #f6f9fc;
        }

        .table-dark
        {
            color: #f8f9fe;
            background-color: #172b4d;
        }
        .table-dark th,
        .table-dark td,
        .table-dark thead th
        {
            border-color: #1f3a68;
        }
        .table-dark.table-bordered
        {
            border: 0;
        }
        .table-dark.table-striped tbody tr:nth-of-type(odd)
        {
            background-color: rgba(255, 255, 255, .05);
        }
        .table-dark.table-hover tbody tr:hover
        {
            background-color: rgba(255, 255, 255, .075);
        }
    </style>
    <body class="{{ $class ?? '' }}">
        
        <div class="container-fluid mt--6">
            <div class="main-content">
                {{-- <div class="row">
                    <div class="col">
                        <div class="card"> --}}
                            {{-- <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-header bg-secondary">
                                        <div class="row">
                                        <div class="col-sm-10">
                                            <h3 class="mb-0">{{$student->name}}</h3>
                                        </div>
                                        <div class="col-sm-2 text-right">
                                            <a id="btn-print" class="btn btn-sm btn-primary">Export Profile</a> 
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
            
                            {{-- <div class="card-body"> --}}
                                {{-- <form method="post" action="{{ route('generatePDF',$student->id) }}" enctype="multipart/form-data" autocomplete="off">
                                    @csrf --}}
                                   <h3 class="heading text-center mb-4">Personal Details</h3>
                                   
                                   {{-- <hr class="my-4" />  --}}
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <h4>Name: </h4>
                                        </div>
                                        <div class="col-sm-10">
                                            <p class="text-default">{{$student->name}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <h4>Address: </h4>
                                        </div>
                                        <div class="col-sm-10">
                                            <p class="text-default">{{$student->address}}</p>
                                        </div>
                                    </div>
                    
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <h4>Class: </h4>
                                        </div>
                                        <div class="col-sm-5">
                                            @if(isset($student->class->class_name))
                                                <p class="text-default">{{$student->class->class_name}}</p>
                                            @else 
                                                <p class="text-default">{{ __('Not Yet Assigned') }}</p>
                                            @endif
                                        </div>
                                        <div class="col-sm-2">
                                            <h4>Mykid: </h4>
                                        </div>
                                        <div class="col-sm-3">
                                            <p class="text-default">{{$student->mykid}}</p>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <h4>Citizenship: </h4>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="text-default">{{$student->citizenship}}</p>
                                        </div>
                                        <div class="col-sm-2">
                                            <h4>Gender: </h4>
                                        </div>
                                        <div class="col-sm-3">
                                            <p class="text-default">{{$student->gender}}</p>
                                        </div>
                                    </div>
                    
                                    {{-- <hr class="my-4" /> --}}
                    
                                    <h6 class="heading-small text-muted">{{ __('Guardian 1 details') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-sm-2">
                                            <h4>Guardian 1 Name: </h4>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="text-default">{{$student->G1_name}}</p>
                                        </div>
                                        <div class="col-sm-2">
                                            <h4>Relation: </h4>
                                        </div>
                                        <div class="col-sm-3">
                                            <p class="text-default">{{$student->G1_relation}}</p>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <h4>Phone Number: </h4>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="text-default">{{$student->G1_phonenum}}</p>
                                        </div>
                                        <div class="col-sm-2">
                                            <h4>Income: </h4>
                                        </div>
                                        <div class="col-sm-3">
                                            <p class="text-default">{{$student->G1_income}}</p>
                                        </div>
                                    </div>
                    
                                    <h6 class="heading-small text-muted">{{ __('Guardian 2 details') }}</h6>
            
                                    <div class="row mt-3">
                                        <div class="col-sm-2">
                                            <h4>Guardian 1 Name: </h4>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="text-default">{{$student->G2_name}}</p>
                                        </div>
                                        <div class="col-sm-2">
                                            <h4>Relation: </h4>
                                        </div>
                                        <div class="col-sm-3">
                                            <p class="text-default">{{$student->G2_relation}}</p>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <h4>Phone Number: </h4>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="text-default">{{$student->G2_phonenum}}</p>
                                        </div>
                                        <div class="col-sm-2">
                                            <h4>Income: </h4>
                                        </div>
                                        <div class="col-sm-3">
                                            <p class="text-default">{{$student->G2_income}}</p>
                                        </div>
                                    </div>
                    
                                    <?php
                                        // $additional=implode(",",$request->input('customfield'));
                                        $additionalInfo = $student->additional_Info;
                                        $explode_info = explode(',',$student->additional_Info);
                                        $student = "student"; 
                                        $customfields = App\Models\AutoFields::where('user',$student)->get();
                                    ?>
                                    @if((App\Models\AutoFields::where('user',$student))->count()>0)
                                        {{-- <hr class="my-4" /> --}}
                    
                                        <h6 class="heading-small text-muted mb-4">{{ __('Additional details') }}</h6> 
                                        <?php $i = 0;?>             
                                        @foreach($customfields as $customfield)                       
                                                <div class="row">
                                                    <div class="col-sm-2">
                    
                                                            @if($additionalInfo != null)
                                                               <?php $addinfo = $explode_info[$i];?>
                                                            @else
                                                               <?php $addinfo = "No input"; ?>
                                                            @endif
                    
                                                            <?php 
                                                                $dropdownNote = $customfield->dropdownNote;
                                                                $explode_notes = explode(',',$dropdownNote);
                                                            ?>
            
                                                            <h4>{{ $customfield->name }}: </h4>
                    
                                                            <label class="form-control-label" for="{{ $customfield->name }}">{{ $customfield->name }}</label>
                                                            {{-- <select class="form-control form-control-alternative" name="customfield[]" required>
                                                                <option selected disabled>{{$addinfo}}</option>
                                                                    @foreach($explode_notes as $explode_note)
                                                                        <option value="{{$explode_note}}">{{$explode_note}}</option>
                                                                    @endforeach
                                                            </select> --}}
                                                        {{-- </div> --}}
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <p class="text-default">{{$addinfo}}</p>
                                                    </div>
                                            <?php $i++ ?>
                                        @endforeach                     
                                    @endif
            
                                    <hr class="my-4" /> 
                                    <h3 class="heading text-center mt-3 mb-4">Personality Traits</h3>                     
                                    {{-- <hr class="my-4" />  --}}
                                    
                                    <div class="row">
                                        <div class="col-sm-12">
                                            {{-- <div class="table-responsive"> --}}
                                                <table class="table align-items-center table-flush">
                                                    <thead class="thead-light">
                                                      <tr>
                                                        <th scope="col" style="width: 85%">Category</th>
                                                        <th class="text-center" scope="col" style="width: 15%">Percentage</th>
                                                        {{-- <th scope="col">Class Name</th>
                                                        <th scope="col" style="width: 10%"></th> --}}
                                                      </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                      <tr>
                                                        <td style="width: 85%">
                                                            <strong>EXTROVERSION</strong><br/>
                                                            <p class="text-wrap">Extraversion describes a person’s inclination to seek stimulation from the outside world, especially in the form of attention from other people. Extraverts engage actively with others to earn friendship, admiration, power, status, excitement, and romance. Introverts, on the other hand, conserve their energy, and do not work as hard to earn these social rewards.</p>
                                                        </td>
                                                        <td class="text-center" style="width: 15%">
                                                            @if($averagePersArr == null)
                                                            <strong>0%</strong>
                                                            @else
                                                            <strong>{{$averagePersArr['Extraversion']}}%</strong>   
                                                            @endif 
                                                        </td>                                                                                       
                                                      </tr>
                                                      <tr>
                                                        <td style="width: 85%">
                                                            <strong>AGREEABLENESS</strong>
                                                            <p class="text-wrap">Agreeableness describes a person’s tendency to put others’ needs ahead of their own, and to cooperate rather than compete with others. People who are high in Agreeableness experience a great deal of empathy and tend to get pleasure out of serving and taking care of others. They are usually trusting and forgiving. People who are low in Agreeableness tend to experience less empathy and put their own concerns ahead of others.</p>
                                                        </td>
                                                        <td class="text-center" style="width: 15%">
                                                            @if($averagePersArr == null)
                                                            <strong>0%</strong>
                                                            @else
                                                            <strong>{{$averagePersArr['Agreeableness']}}%</strong>   
                                                            @endif 
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td style="width: 85%">
                                                            <strong>NEUROTICISM</strong>
                                                            <p class="text-wrap">Neuroticism describes a person’s tendency to experience negative emotions, including fear, sadness, anxiety, guilt, and shame. While everyone experiences these emotions from time to time, some people are more prone to them than others. High Neuroticism scorers are more likely to react to a situation with fear, anger, sadness, and the like. Low Neuroticism scorers are more likely to brush off their misfortune and move on.</p>
                                                        </td>
                                                        <td class="text-center" style="width: 15%">
                                                            @if($averagePersArr == null)
                                                            <strong>0%</strong>
                                                            @else
                                                            <strong>{{$averagePersArr['Neuroticism']}}%</strong>   
                                                            @endif 
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td>
                                                            <strong>CONSCIENTIOUSNESS</strong>
                                                            <p class="text-wrap">Conscientiousness describes a person’s ability to exercise self-discipline and control in order to pursue their goals. High scorers are organized and determined, and are able to forego immediate gratification for the sake of long-term achievement. Low scorers are impulsive and easily sidetracked.</p>
                                                        </td>
                                                        <td class="text-center" style="width: 15%">
                                                            @if($averagePersArr == null)
                                                            <strong>0%</strong>
                                                            @else
                                                            <strong>{{$averagePersArr['Conscientiousness']}}%</strong>   
                                                            @endif 
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td>
                                                            <strong>OPENNESS</strong>
                                                            <p class="text-wrap">Openness describes a person’s tendency to think in abstract, complex ways. High scorers tend to be creative, adventurous, and intellectual. They enjoy playing with ideas and discovering novel experiences. Low scorers tend to be practical, conventional, and focused on the concrete. They tend to avoid the unknown and follow traditional ways.</p>
                                                        </td>
                                                        <td class="text-center" style="width: 15%">
                                                            @if($averagePersArr == null)
                                                            <strong>0%</strong>
                                                            @else
                                                            <strong>{{$averagePersArr['Openness']}}%</strong>   
                                                            @endif 
                                                        </td>
                                                      </tr>
                                                    </tbody>
                                                </table>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
            
                                    <hr class="my-4" /> 
                                    <h3 class="heading text-center mt-3 mb-3">Interest Inventory</h3>                     
                                    {{-- <hr class="my-4" /> --}}
            
                                    <div class="row">
                                        <div class="col-sm-12">
                                            {{-- <div class="table-responsive"> --}}
                                                <table class="table align-items-center table-flush">
                                                    <thead class="thead-light">
                                                      <tr>
                                                        <th scope="col" style="width: 85%">Category</th>
                                                        <th class="text-center" scope="col" style="width: 15%">Percentage</th>
                                                        {{-- <th scope="col">Class Name</th>
                                                        <th scope="col" style="width: 10%"></th> --}}
                                                      </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                    <?php
                                                        if($averageArr != "No result found"){
                                                            $interest = "";
                                                            $i=0; 
                                                            $total = 0;
                                                            foreach($averageArr as $avg){
                                                                $total += $avg;
                                                            }
                                                            $interest = [];
                                                            foreach($averageArr as $avg){
                                                                // if($i==0){
                                                                    $interest[] = round(($avg/$total)*100,0);                              
                                                                // }else{
                                                                //     $interest[] = ", ".round(($avg/$total)*100,0);
                                                                // }
                                                                // $i++;
                                                            }
                                                        }else{
                                                            $interest = null;
                                                        }
                                                    ?>
                                                    {{-- @if($interest != null) --}}
                                                      <tr>
                                                        <td style="width: 85%">
                                                            <strong>REALISTIC</strong><br/>
                                                            <p class="text-wrap">Realistic careers are those that involve working with your hands and often involve physical labor. Examples of a realistic work environment may include working as an electrician, carpenter, military service, or mechanic.</p>
                                                        </td>
                                                        <td class="text-center" style="width: 15%">
                                                            @if($interest == null)
                                                            <strong>0%</strong>
                                                            @else
                                                            <strong>{{$interest[0]}}%</strong>   
                                                            @endif 
                                                        </td>                                                                                       
                                                      </tr>
                                                      <tr>
                                                        <td style="width: 85%">
                                                            <strong>INVESTIGATIVE</strong>
                                                            <p class="text-wrap">Investigative careers are those that require knowledge and often involve research or science. Examples of an investigative work environment may include working as a journalist, doctor, or scientist.</p>
                                                        </td>
                                                        <td class="text-center" style="width: 15%">
                                                            @if($interest == null)
                                                            <strong>0%</strong>
                                                            @else
                                                            <strong>{{$interest[1]}}%</strong>   
                                                            @endif 
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td style="width: 85%">
                                                            <strong>ARTISTIC</strong>
                                                            <p class="text-wrap">Artistic careers are those that allow you to express your creativity and often involve design or performance. Examples of an artistic work environment may include working as a musician, actor or artist.</p>
                                                        </td>
                                                        <td class="text-center" style="width: 15%">
                                                            @if($interest == null)
                                                            <strong>0%</strong>
                                                            @else
                                                            <strong>{{$interest[2]}}%</strong>   
                                                            @endif 
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td>
                                                            <strong>SOCIAL</strong>
                                                            <p class="text-wrap">Social careers are those that involve working with people and often involve teaching or counseling. Examples of a social work environment may include working as english teachers, language teachers, nurse or counselors.</p>
                                                        </td>
                                                        <td class="text-center" style="width: 15%">
                                                            @if($interest == null)
                                                            <strong>0%</strong>
                                                            @else
                                                            <strong>{{$interest[3]}}%</strong>   
                                                            @endif 
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td>
                                                            <strong>ENTERPRISING</strong>
                                                            <p class="text-wrap">Enterprising careers are those that involve leadership and often involve sales or management. Examples of an enterprising work environment may include working as a business owner, manager or salesperson.</p>
                                                        </td>
                                                        <td class="text-center" style="width: 15%">
                                                            @if($interest == null)
                                                            <strong>0%</strong>
                                                            @else
                                                            <strong>{{$interest[4]}}%</strong>   
                                                            @endif 
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td>
                                                            <strong>CONVENTIONAL</strong>
                                                            <p class="text-wrap">Conventional careers are those that require organization and often involve clerical work or administration. Examples of conventional work environments may include working as an office administrator, bookkeeper or secretary.</p>
                                                        </td>
                                                        <td class="text-center" style="width: 15%">
                                                            @if($interest == null)
                                                            <strong>0%</strong>
                                                            @else
                                                            <strong>{{$interest[5]}}%</strong>   
                                                            @endif 
                                                        </td>
                                                      </tr>
                                                    {{-- @endif --}}
                                                    </tbody>
                                                </table>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
            
                                    <hr class="my-4" /> 
                                    <h3 class="heading text-center mt-3 mb-3">Co-curriculum Achievement</h3>                     
                                
                                    <div class="row">
                                        <div class="col-sm-12">
                                            {{-- <div class="table-responsive"> --}}
                                                <table class="table align-items-center table-flush">
                                                    <thead class="thead-light">
                                                      <tr>
                                                        <th scope="col" style="width: 10%">Year</th>
                                                        <th scope="col" style="width: 50%">Name</th>
                                                        <th class="text-center" scope="col" style="width: 25%">Achievement</th>
                                                        <th class="text-center" scope="col" style="width: 15%">Merit</th>
                                                        {{-- <th scope="col" style="width: 10%"></th> --}}
                                                      </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                    @foreach($merits as $merit)
                                                    <tr>
                                                        <td style="width: 10%">
                                                            <p>{{$merit->updated_at->year}}</p>
                                                        </td>
                                                        <td style="width: 50%">
                                                            <p class="text-wrap">{{$merit->merit_name}}</p>
                                                        </td>
                                                        <td class="text-center" style="width: 25%">
                                                            <p class="text-wrap">{{$merit->achievement}}</p>
                                                        </td>
                                                        <td class="text-center" style="width: 15%">
                                                            <strong>{{$merit->merit_point}}</strong>
                                                        </td>                                                                                       
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                {{-- </form> --}}
                            {{-- </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <iframe
                    id="frame"
                    style="width: 100%; border: 0; height: 0"
                    src="student-profilePDF.blade.php"
                ></iframe> --}}
            </div>
        {{-- </div> --}}

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

		<script
			src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
			integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		></script> --}}

        {{-- <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script> --}}
        {{-- <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script> --}}
        
        {{-- @stack('js') --}}
        
        <!-- Argon JS -->
        {{-- <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script> --}}
    </body>
</html>

