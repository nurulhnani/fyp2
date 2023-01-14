<!DOCTYPE html>
<html>
<head>
    <title>Export Profile</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row align-items-center pt-4 pb-4">
            <div class="col-sm-3">
                <img src="{{asset('assets/img/userImage/logosekolah.png')}}">
            </div>
            <div class="col-sm-9">
                {{-- <div class=" "> --}}
                    <h2><strong>Mescore Profiling System<strong></h2>
                    <h3>Al-Amin Darul Musthofa School</h2>
                {{-- </div> --}}
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="row profile-header">
                        <div class="col-sm-12">
                            <div class="card-header bg-secondary">
                                <div class="row">
                                <div class="col-sm-10">
                                    <h3 class="mb-0">{{$student->name}}</h3>
                                </div>
                                <div class="col-sm-2 text-right">
                                    <a id="btn-print" class="btn btn-sm btn-primary text-white" >Export Profile</a>
                                    {{-- <a class="btn btn-sm btn-primary" href="{{ route('generatePDF',$student->id)}}">Export Profile</a> --}}
                                    {{-- href="{{ route('generatePDF',$student->id) }} --}}
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div id="main-content" class="card-body">
                        {{-- <form method="post" action="{{ route('generatePDF',$student->id) }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf --}}
                            <div class="text-center mt-3 mb-3">
                                <strong>Personal Details</strong>    
                            </div>
                           {{-- <h3 class="heading text-center mb-4">Personal Details</h3> --}}
                           
                           {{-- <hr class="my-4" />  --}}
                            <div class="row mt-5 mb-5">
                                <div class="col text-center">
                                    @if($student->image_path != null)
                                    <a href="#">
                                        <img id="output_image" src="{{$student->image_path}}" class="rounded-circle" width="150pt" height="140pt">
                                    </a>
                                    @else 
                                    <a><img id="output_image" src="{{asset('assets/img/theme/default.png')}}" class="rounded-circle" width="150pt" height="140pt"></a>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2">
                                    <h3 class="text-default">Name: </h3>
                                </div>
                                <div class="col-sm-10">
                                    <p class="text-default">{{$student->name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <h3 class="text-default">Address: </h3>
                                </div>
                                <div class="col-sm-10">
                                    <p class="text-default">{{$student->address}}</p>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="col-sm-2">
                                    <h3 class="text-default">Class: </h3>
                                </div>
                                <div class="col-sm-5">
                                    @if(isset($student->class->class_name))
                                        <p class="text-default">{{$student->class->class_name}}</p>
                                    @else 
                                        <p class="text-default">{{ __('Not Yet Assigned') }}</p>
                                    @endif
                                </div>
                                <div class="col-sm-2">
                                    <h3 class="text-default">Mykid: </h3>
                                </div>
                                <div class="col-sm-3">
                                    <p class="text-default">{{$student->mykid}}</p>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm-2">
                                    <h3 class="text-default">Citizenship: </h3>
                                </div>
                                <div class="col-sm-5">
                                    <p class="text-default">{{$student->citizenship}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <h3 class="text-default">Gender: </h3>
                                </div>
                                <div class="col-sm-3">
                                    <p class="text-default">{{$student->gender}}</p>
                                </div>
                            </div>
            
                            {{-- <hr class="my-4" /> --}}
            
                            <h6 class="heading-small text-muted">{{ __('Guardian 1 details') }}</h6>
                            <div class="row mt-3">
                                <div class="col-sm-2">
                                    <h3 class="text-default">Guardian 1 Name: </h3>
                                </div>
                                <div class="col-sm-5">
                                    <p class="text-default">{{$student->G1_name}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <h3 class="text-default">Relation: </h3>
                                </div>
                                <div class="col-sm-3">
                                    <p class="text-default">{{$student->G1_relation}}</p>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm-2">
                                    <h3 class="text-default">Phone Number: </h3>
                                </div>
                                <div class="col-sm-5">
                                    <p class="text-default">{{$student->G1_phonenum}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <h3 class="text-default">Income: </h3>
                                </div>
                                <div class="col-sm-3">
                                    <p class="text-default">{{$student->G1_income}}</p>
                                </div>
                            </div>
            
                            <h6 class="heading-small text-muted">{{ __('Guardian 2 details') }}</h6>
    
                            <div class="row mt-3">
                                <div class="col-sm-2">
                                    <h3 class="text-default">Guardian 2 Name: </h3>
                                </div>
                                <div class="col-sm-5">
                                    <p class="text-default">{{$student->G2_name}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <h3 class="text-default">Relation: </h3>
                                </div>
                                <div class="col-sm-3">
                                    <p class="text-default">{{$student->G2_relation}}</p>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-sm-2">
                                    <h3 class="text-default">Phone Number: </h3>
                                </div>
                                <div class="col-sm-5">
                                    <p class="text-default">{{$student->G2_phonenum}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <h3 class="text-default">Income: </h3>
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
                                        </div>
                                    <?php $i++ ?>
                                @endforeach                     
                            @endif
    
                            {{-- <hr class="my-4" />  --}}
                            <div class="text-center mt-5 mb-3">
                                <strong>Personality Traits</strong>    
                            </div> 

                            <div class="row">
                                <div class="col-sm-12">
                                    {{-- <div class="table-responsive"> --}}
                                        <table class="align-items-center">
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
                                                    <p class="text-wrap"><u>EXTRAVERSION</u></p>
                                                    {{-- <strong>EXTROVERSION</strong><br/> --}}
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
                                                    <p class="text-wrap"><u>AGREEABLENESS</u></p>
                                                    {{-- <strong>AGREEABLENESS</strong> --}}
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
                                                    <p class="text-wrap"><u>NEUROTICISM</u></p>
                                                    {{-- <strong>NEUROTICISM</strong> --}}
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
                                                    <p class="text-wrap"><u>CONSCIENTIOUSNESS</u></p>
                                                    {{-- <strong>CONSCIENTIOUSNESS</strong> --}}
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
                                                    <p class="text-wrap"><u>OPENNESS</u></p>
                                                    {{-- <strong>OPENNESS</strong> --}}
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
    
                            {{-- <hr class="my-4" />  --}}
                            <div class="text-center mt-5 mb-3">
                                <strong>Interest Inventory</strong>    
                            </div>                 
                            {{-- <hr class="my-4" /> --}}
    
                            <div class="row">
                                <div class="col-sm-12">
                                    {{-- <div class="table-responsive"> --}}
                                        <table class="align-items-center">
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
                                                    <p class="text-wrap"><u>REALISTIC</u></p>
                                                    {{-- <strong>REALISTIC</strong><br/> --}}
                                                    <p class="text-wrap">Realistic careers are those that involve working with your hands and often involve physical labor. Examples of a realistic work environment may include working as an electrician, carpenter, military service, or mechanic.</p>
                                                </td>
                                                <td class="text-center" style="width: 15%">
                                                    @if($averageArr == "No result found" || $averageArr['Realistic'] == null)
                                                    <strong>0%</strong>
                                                    @else
                                                    <strong>{{$averageArr['Realistic']}}%</strong>   
                                                    @endif 
                                                </td>                                                                                       
                                              </tr>
                                              <tr>
                                                <td style="width: 85%">
                                                    <p class="text-wrap"><u>INVESTIGATIVE</u></p>
                                                    {{-- <strong>INVESTIGATIVE</strong> --}}
                                                    <p class="text-wrap">Investigative careers are those that require knowledge and often involve research or science. Examples of an investigative work environment may include working as a journalist, doctor, or scientist.</p>
                                                </td>
                                                <td class="text-center" style="width: 15%">
                                                    @if($averageArr == "No result found" ||  $averageArr['Investigative'] == null)
                                                    <strong>0%</strong>
                                                    @else
                                                    <strong>{{$averageArr['Investigative']}}%</strong>   
                                                    @endif 
                                                </td>
                                              </tr>
                                              <tr>
                                                <td style="width: 85%">
                                                    <p class="text-wrap"><u>ARTISTIC</u></p>
                                                    {{-- <strong>ARTISTIC</strong> --}}
                                                    <p class="text-wrap">Artistic careers are those that allow you to express your creativity and often involve design or performance. Examples of an artistic work environment may include working as a musician, actor or artist.</p>
                                                </td>
                                                <td class="text-center" style="width: 15%">
                                                    @if($averageArr == "No result found" ||  $averageArr['Artistic'] == null)
                                                    <strong>0%</strong>
                                                    @else
                                                    <strong>{{$averageArr['Artistic']}}%</strong>   
                                                    @endif 
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>
                                                    <p class="text-wrap"><u>SOCIAL</u></p>
                                                    {{-- <strong>SOCIAL</strong> --}}
                                                    <p class="text-wrap">Social careers are those that involve working with people and often involve teaching or counseling. Examples of a social work environment may include working as english teachers, language teachers, nurse or counselors.</p>
                                                </td>
                                                <td class="text-center" style="width: 15%">
                                                    @if($averageArr == "No result found" || $averageArr['Social'] == null)
                                                    <strong>0%</strong>
                                                    @else
                                                    <strong>{{$averageArr['Social']}}%</strong>   
                                                    @endif 
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>
                                                    <p class="text-wrap"><u>ENTERPRISING</u></p>
                                                    {{-- <strong>ENTERPRISING</strong> --}}
                                                    <p class="text-wrap">Enterprising careers are those that involve leadership and often involve sales or management. Examples of an enterprising work environment may include working as a business owner, manager or salesperson.</p>
                                                </td>
                                                <td class="text-center" style="width: 15%">
                                                    @if($averageArr == "No result found" ||  $averageArr['Enterprising'] == null)
                                                    <strong>0%</strong>
                                                    @else
                                                    <strong>{{$averageArr['Enterprising']}}%</strong>   
                                                    @endif 
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>
                                                    <p class="text-wrap"><u>CONVENTIONAL</u></p>
                                                    {{-- <strong>CONVENTIONAL</strong> --}}
                                                    <p class="text-wrap">Conventional careers are those that require organization and often involve clerical work or administration. Examples of conventional work environments may include working as an office administrator, bookkeeper or secretary.</p>
                                                </td>
                                                <td class="text-center" style="width: 15%">
                                                    @if($averageArr == "No result found" ||  $averageArr['Conventional'] == null)
                                                    <strong>0%</strong>
                                                    @else
                                                    <strong>{{$averageArr['Conventional']}}%</strong>   
                                                    @endif 
                                                </td>
                                              </tr>
                                            </tbody>
                                        </table>
                                    {{-- </div> --}}
                                </div>
                            </div>
    
                            {{-- <hr class="my-4" />  --}}
                            <div class="text-center mt-5 mb-3">
                                <strong>Co-curriculum Achivement</strong>    
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    {{-- <div class="table-responsive"> --}}
                                        <table class="align-items-center">
                                            @if($merits == null || Count($merits) == 0)
                                            <tbody class="list">
                                                <tr>
                                                    <td><p class="text-wrap">No co-curriculum records</p></td>
                                                </tr>
                                            </tbody>

                                            @else
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
                                            @endif
                                            </tbody>
                                        </table>
                                    {{-- </div> --}}
                                </div>
                            </div>
            
                            {{-- <hr class="my-4" />  --}}
                            <div class="text-center mt-5 mb-3">
                                <strong>Health Records</strong>    
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <h4 class="text-wrap">This student’s present health is:</h4>
                                </div>
                                <div class="col-sm-3">
                                    <p class="text-default">@if($record != null){{$record->present_health}} @else N/A @endif</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="align-items-center">

                                        @if($record == null)
                                        <tbody class="list">
                                            <tr>
                                                <td><p class="text-wrap">No health records</p></td>
                                            </tr>
                                        </tbody>     

                                        @else
                                        
                                        <thead class="thead-light">
                                            <tr>
                                            <th scope="col" style="width: 32%">Health fields</th>
                                            <th scope="col" style="width: 68%">Records</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            
                                        <tr>
                                            <td style="width: 32%">
                                                <p class="text-wrap">Height</p>
                                            </td>
                                            <td style="width: 68%">
                                                <p class="text-wrap">@if($record->height != null){{$record->height}} @else N/A @endif</p>
                                            </td>                                                                                      
                                        </tr>
                                        <tr>
                                            <td style="width: 32%">
                                                <p class="text-wrap">Weight</p>
                                            </td>
                                            <td style="width: 68%">
                                                <p class="text-wrap">@if($record->weight != null){{$record->weight}} @else N/A @endif</p>
                                            </td>                                                                                      
                                        </tr>
                                        <tr>
                                            <td style="width: 32%">
                                                <p class="text-wrap">Health History</p>
                                            </td>
                                                @if($record->health_history != null)
                                                    <?php $healthhistory = explode(',',$record->health_history);?>
                                                    <td style="width: 68%">
                                                        @foreach($healthhistory as $history)
                                                        <p class="text-wrap">{{$history}}</p>
                                                        @endforeach
                                                    </td>   
                                                @else
                                                    <?php $healthhistory = "N/A"; ?>
                                                    <td style="width: 68%">
                                                        <p class="text-wrap">{{$history}}</p>
                                                    </td>  
                                                @endif
                                                                                                                                
                                        </tr>  
                                        <tr>
                                            <td style="width: 32%">
                                                <p class="text-wrap">Description</p>
                                            </td>
                                            <td style="width: 68%">
                                                <p class="text-wrap">@if($record->description != null){{$record->description}} @else N/A @endif</p>
                                            </td>                                                                                      
                                        </tr> 
                                        <tr>
                                            <td style="width: 32%">
                                                <p class="text-wrap">Medication Allergies</p>
                                            </td>
                                            <td style="width: 68%">
                                                <p class="text-wrap">@if($record->medication_allergies != null){{$record->medication_allergies}} @else N/A @endif</p>
                                            </td>                                                                                      
                                        </tr> 
                                        <tr>
                                            <td style="width: 32%">
                                                <p class="text-wrap">Medications Now Taking</p>
                                            </td>
                                            <td style="width: 68%">
                                                <p class="text-wrap">@if($record->medications_now_taking != null){{$record->medications_now_taking}} @else N/A @endif</p>
                                            </td>                                                                                      
                                        </tr> 
                                        <tr>
                                            <td style="width: 32%">
                                                <p class="text-wrap">Childhood Diseases</p>
                                            </td>
                                            <td style="width: 68%">
                                                <p class="text-wrap">Chicken pox - @if($record->chicken_pox != null){{$record->chicken_pox}} @else N/A @endif</p>
                                                <p class="text-wrap">Measles - @if($record->measles != null){{$record->measles}} @else N/A @endif</p>
                                                <p class="text-wrap">Mumps - @if($record->mumps != null){{$record->mumps}} @else N/A @endif</p>
                                            </td>                                                                                      
                                        </tr> 
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>

</form>
</body>
</html>


<style scoped lang="css">
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

/* tr:nth-child(even) {
  background-color: #dddddd;
} */
.text-default{
    font-family: arial, sans-serif;
}
.text-wrap
{
    white-space: normal !important;
}

.text-center {
    text-align: center;
}

.page-break{
    page-break-after: always;
}


@media print{
    #btn-print{
        display: none;
    }
    #sec-page{
        margin-top: 2cm;
    }
    .profile-header {
        display: none;
    }
    #sidenav-main{
        display: none;
    }
}

@media (max-width: 1024px) {
    .summary {
        padding: 20px 20px 50px 20px;
        border-radius: 20px;
        margin-bottom: 50px;
        width: 90%;
    }
    .all-domain{
        width: 100%;
    }
}
@media (max-width: 1012px) {
    .all-domain{
        width: 100%;;
    }
    .score {
        font-size: 40px;
    }
    .summary{
        padding: 20px
    }
    .gd-score{
        font-size: 30px;
    }
}
@media (max-width: 450px) {
    .all-domain{
        width: 100%
    }
    .score {
        font-size: 40px;
    }
    .summary{
        padding: 20px
    }
    .gd-score{
        font-size: 20px;
    }
}

</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('#btn-print').addEventListener('click', function () {
            // html2canvas(document.querySelector('#main-content')).then((canvas) => {
			// let base64image = canvas.toDataURL('image/png');
			// let pdf = new jsPDF();
			// pdf.addImage(base64image, 'PNG', 0, 0, 180, 500);
			// pdf.save('webtylepress-two.pdf');
		    // });
            document.title='Profile.pdf';
            window.print();
	    });
    })
</script>