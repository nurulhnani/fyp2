@extends('layouts.studentapp')

@section('content')
    {{-- Header --}}
    @include('layouts.headers.cards')
    <!-- Header -->
   <div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-12 col-12">
            <h6 class="h2 text-white d-inline-block mb-4">Export Profile</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('studenthome',$student->id) }}"><i class="fas fa-home"></i></a></li>
                  {{-- <li class="breadcrumb-item"><a href="{{route('students.index')}}">Manage Student</a></li> --}}
                  {{-- <li class="breadcrumb-item"><a href="{{route('students.create')}}">Add New Student</a></li> --}}
                  <li class="breadcrumb-item active" aria-current="page">Export Profile</li>
              </ol>
            </nav> 
          </div>
        </div>
      </div>
    </div>
   </div>

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-header bg-secondary">
                            <div class="row">
                            <div class="col-sm-10">
                                <h3 class="mb-0">{{$student->name}}</h3>
                            </div>
                            <div class="col-sm-2 text-right">
                                {{-- <a id="btn-print" class="btn btn-sm btn-primary" >Export Profile</a> --}}
                                <a class="btn btn-sm btn-primary" href="{{ route('generatePDF',$student->id)}}">Export Profile</a>
                                {{-- href="{{ route('generatePDF',$student->id) }} --}}
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="main-content" class="card-body">
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
                </div>
            </div>
        </div>
    </div>

    {{-- <iframe
        id="frame"
        style="width: 100%; border: 0; height: 0"
        src="generatePDF"
    ></iframe> --}}

    @include('layouts.footers.auth')
</div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>


{{-- @push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('#btn-print').addEventListener('click', function () {
            html2canvas(document.querySelector('#main-content')).then((canvas) => {
			let base64image = canvas.toDataURL('image/png');
			// console.log(base64image);
			let pdf = new jsPDF();
			pdf.addImage(base64image, 'PNG', 0, 0, 180, 500);
			pdf.save('webtylepress-two.pdf');
		    });
	    });
    })
</script>