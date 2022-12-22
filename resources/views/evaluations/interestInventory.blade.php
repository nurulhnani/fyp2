@extends('layouts.teacherapp')

@section('content')
@include('layouts.headers.cards')

<!-- Header -->
<div class="header pb-5">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-7 col-7">
                    <h6 class="h2 text-black d-inline-block mb-0">Evaluation Page</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">Evaluation</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Interest Inventory</li>
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
        <div class="col-sm-10">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="mb-0">Interest Inventory Evaluation</h3>
                        </div>
                        {{-- <div class="col-4 text-right">
                            <a href="/studentlist-evaluation/interestresult/{{$student->id}}" class="btn btn-sm btn-neutral">View Current Result</a>
                        </div> --}}
                    </div>
                </div>

                <div class="card-body">
                    <p class="card-text mb-4">This section is for you to evaluate your student's interest in several categories. Please evaluate and tick the checkboxes according to the student's interest. You are allowed to leave it untick.</p>
                    
                    <form id="myForm" method="post" action="{{route('interest.store')}}">
                        @csrf
                        @method('PUT')
                        

                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-alternative" name="studentname"  value="{{$student->name}}" disabled>
                                    <input type="hidden" class="form-control form-control-alternative" name="studentname"  value="{{$student->name}}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-alternative" name="classname" value="{{$student->class->class_name}}" disabled>
                                    <input type="hidden" class="form-control form-control-alternative" name="classname" value="{{$student->class->class_name}}">
                                </div>
                            </div>
                        </div>
                  
                        <div style="text-align:center">
                          {{-- <span class="step" id = "step-1">1</span>
                          <span class="step" id = "step-2">2</span>
                          <span class="step" id = "step-3">3</span>
                          <span class="step" id = "step-4">4</span> --}}
                          

                        </div>
                        <div class="tab" id = "tab-1">
                            <?php $index = 1; ?>
                            @foreach ($realisticquestions as $realisticquestion)
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label class="form-control-label" for="{{ $realisticquestion->questions }}"><?php echo $index ?>. {{ $realisticquestion->questions }}</label>
                                    </div>
                                </div>
                                <div class="col-sm-2 text-right">
                                    <div class="form-group">
                                        <input type="checkbox" class="form-control-alternative" name="realistic[]">
                                    </div>
                                </div>
                            </div>
                            <?php $index++; ?>
                            @endforeach

                            <div class="float-right">
                                <div class="btn btn-primary" onclick="run(1, 2);">Next</div>
                            </div>

                        </div>
                  
                        <div class="tab" id = "tab-2">
                            <?php $index = 6; ?>
                            @foreach ($investigativequestions as $investigativequestion)
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label class="form-control-label" for="{{ $investigativequestion->questions }}"><?php echo $index ?>. {{ $investigativequestion->questions }}</label>
                                    </div>
                                </div>
                                <div class="col-sm-2 text-right">
                                    <div class="form-group">
                                        <input type="checkbox" class="btn btn-outline-success" name="investigative[]">
                                        {{-- <button type="button" name="{{ $investigativequestion->questions }}" class="btn btn-outline-success btn-group-toggle" data-toggle="buttons"><i class="fa fa-check" style="font-size:15px"></i></button> --}}
                                    </div>
                                </div>
                            </div>
                            <?php $index++; ?>
                            @endforeach

                            <div class="float-left">
                                <div class="btn btn-primary" onclick="run(2, 1);">Previous</div>
                            </div>
                            <div class="float-right">
                                <div class="btn btn-primary" onclick="run(2, 3);">Next</div>
                            </div>
                        </div>
                  
                        <div class="tab" id = "tab-3">
                            <?php $index = 11; ?>
                            @foreach ($artisticquestions as $artisticquestion)
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label class="form-control-label" for="{{ $artisticquestion->questions }}"><?php echo $index ?>. {{ $artisticquestion->questions }}</label>
                                    </div>
                                </div>
                                <div class="col-sm-2 text-right">
                                    <div class="form-group">
                                        <input type="checkbox" class="btn btn-outline-success" name="artistic[]">
                                        {{-- <button type="button" name="{{ $artisticquestion->questions }}" class="btn btn-outline-success btn-group-toggle" data-toggle="buttons"><i class="fa fa-check" style="font-size:15px"></i></button> --}}
                                    </div>
                                </div>
                            </div>
                            <?php $index++; ?>
                            @endforeach

                            <div class="float-left">
                                <div class="btn btn-primary" onclick="run(3, 2);">Previous</div>
                            </div>
                            <div class="float-right">
                                <div class="btn btn-primary" onclick="run(3, 4);">Next</div>
                            </div>

                        </div>
                  
                        <div class="tab" id = "tab-4">
                          <?php $index = 16; ?>
                            @foreach ($socialquestions as $socialquestion)
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label class="form-control-label" for="{{ $socialquestion->questions }}"><?php echo $index ?>. {{ $socialquestion->questions }}</label>
                                    </div>
                                </div>
                                <div class="col-sm-2 text-right">
                                    <div class="form-group">
                                        <input type="checkbox" class="btn btn-outline-success" name="social[]">
                                        {{-- <button type="button" name="{{ $socialquestion->questions }}" class="btn btn-outline-success btn-group-toggle" data-toggle="buttons"><i class="fa fa-check" style="font-size:15px"></i></button> --}}
                                    </div>
                                </div>
                            </div>
                            <?php $index++; ?>
                            @endforeach

                            <div class="float-left">
                                <div class="btn btn-primary" onclick="run(4, 3);">Previous</div>
                            </div>
                            <div class="float-right">
                                <div class="btn btn-primary" onclick="run(4, 5);">Next</div>
                            </div>

                          {{-- <div class="index-btn-wrapper">
                            <div class="index-btn" onclick="run(4, 3);">Previous</div>
                            <div class="index-btn" onclick="run(4, 5);">Next</div>
                          </div> --}}
                        </div>

                        <div class="tab" id = "tab-5">
                            <?php $index = 21; ?>
                              @foreach ($enterprisingquestions as $enterprisingquestion)
                              <div class="row">
                                  <div class="col-sm-10">
                                      <div class="form-group">
                                          <label class="form-control-label" for="{{ $enterprisingquestion->questions }}"><?php echo $index ?>. {{ $enterprisingquestion->questions }}</label>
                                      </div>
                                  </div>
                                  <div class="col-sm-2 text-right">
                                      <div class="form-group">
                                        <input type="checkbox" class="btn btn-outline-success" name="enterprising[]">
                                          {{-- <button type="button" name="{{ $enterprisingquestion->questions }}" class="btn btn-outline-success btn-group-toggle" data-toggle="buttons"><i class="fa fa-check" style="font-size:15px"></i></button> --}}
                                      </div>
                                  </div>
                              </div>
                              <?php $index++; ?>
                              @endforeach
  
                              <div class="float-left">
                                  <div class="btn btn-primary" onclick="run(5, 4);">Previous</div>
                              </div>
                              <div class="float-right">
                                  <div class="btn btn-primary" onclick="run(5, 6);">Next</div>
                              </div>

                        </div>

                        <div class="tab" id = "tab-6">
                            <?php $index = 26; ?>
                              @foreach ($conventionalquestions as $conventionalquestion)
                              <div class="row">
                                  <div class="col-sm-10">
                                      <div class="form-group">
                                          <label class="form-control-label" for="{{ $conventionalquestion->questions }}"><?php echo $index ?>. {{ $conventionalquestion->questions }}</label>
                                      </div>
                                  </div>
                                  <div class="col-sm-2 text-right">
                                      <div class="form-group">
                                        <input type="checkbox" class="btn btn-outline-success" name="conventional[]">
                                          {{-- <button type="button" name="{{ $conventionalquestion->questions }}" class="btn btn-outline-success btn-group-toggle" data-toggle="buttons"><i class="fa fa-check" style="font-size:15px"></i></button> --}}
                                      </div>
                                  </div>
                              </div>
                              <?php $index++; ?>
                              @endforeach
  
                              <div class="float-left">
                                  <div class="btn btn-primary" onclick="run(6, 5);">Previous</div>
                              </div>
                              <div class="float-right">
                                  <div class="btn btn-primary" onclick="run(6, 7);">Next</div>
                              </div>

                        </div>
                  
                        <div class="tab" id = "tab-7">
                            <p class="card-text text-center mb-5 mt-5">All answers will be saved into the system. Confirm to submit?</p>
                            <div class="float-left">
                                <div class="btn btn-primary" onclick="run(7, 6);">Previous</div>
                            </div>
                            <div class="float-right">
                                <button class = "btn btn-success" type="submit" name="submit">Submit</button>
                            </div>


                          {{-- <div class="index-btn-wrapper">
                            <div class="btn btn-primary" onclick="run(5, 4);">Previous</div>
                            <button class = "btn btn-success" type="submit" name="submit">Submit</button>
                          </div> --}}
                        </div>
                      </form>
                  
                      <script>
                        // Default tab
                        $(".tab").css("display", "none");
                        $(".tab").css("margin-top", "20pt");
                        $("#tab-1").css("display", "block");
                  
                        function run(hideTab, showTab){
                          if(hideTab < showTab){ // If not press previous button
                            // Validation if press next button
                            var currentTab = 0;
                            x = $('#tab-'+hideTab);
                            y = $(x).find("input")
                            for (i = 0; i < y.length; i++){
                              if (y[i].value == ""){
                                $(y[i]).css("background", "#ffdddd");
                                return false;
                              }
                            }
                          }
                  
                          // Progress bar
                          for (i = 1; i < showTab; i++){
                            $("#step-"+i).css("background", "blue");
                            $("#step-"+i).css("color", "white");
                          }
                  
                          // Switch tab
                          $("#tab-"+hideTab).css("display", "none");
                          $("#tab-"+showTab).css("display", "block");
                        //   $("input").css("background", "#fff");
                        }
                    </script>

                    <script>
                        $(function() {
                        $('.toggle-class').change(function() {
                            var status = $(this).prop('checked') == true ? 1 : 0; 
                            var user_id = $(this).data('id'); 
                            
                            $.ajax({
                                type: "GET",
                                dataType: "json",
                                url: '/submitInterest',
                                data: {'status': status, 'user_id': user_id},
                                success: function(data){
                                    console.log(data.success)
                                }
                            });
                        })
                        })
                    </script>

                    
                </div>

                
            </div>
        </div>
        <div class="col-sm-2">
            {{-- Progress Card --}}
            <div class="card">
                <!-- Card header -->
                {{-- <div class="card-header border-0">
                    
                </div> --}}

                <div class="card-body">
                    <p class="card-text text-center">Completion of evaluation: </p>
                    <nav aria-label="...">
                        <ul class="justify-content-center mt-4" style="list-style-type: none; padding-left:30%;padding-right:30%;">
                            {{-- <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">
                                <i class="fas fa-angle-left"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                            </li> --}}
                            <li class="page-item mb-2">
                                <span class="page-link step" id = "step-1">1</span>
                            </li>
                            <li class="page-item mb-2">
                                <span class="page-link step" id = "step-2">2</span>
                            </li>
                            <li class="page-item mb-2">
                                <span class="page-link step" id = "step-3">3</span>
                            </li>
                            <li class="page-item mb-2">
                                <span class="page-link step" id = "step-4">4</span>
                            </li>
                            <li class="page-item mb-2">
                                <span class="page-link step" id = "step-5">5</span>
                            </li>
                            <li class="page-item mb-2">
                                <span class="page-link step" id = "step-6">6</span>
                            </li>
                            {{-- <li class="page-item">
                            <a class="page-link" href="#">
                                <i class="fas fa-angle-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                            </li> --}}
                        </ul>
                    </nav>  

                    <script>
                        // Default tab
                        $(".tab").css("display", "none");
                        $("#tab-1").css("display", "block");
                
                        function run(hideTab, showTab){
                        if(hideTab < showTab){ // If not press previous button
                            // Validation if press next button
                            var currentTab = 0;
                            x = $('#tab-'+hideTab);
                            y = $(x).find("input")
                            for (i = 0; i < y.length; i++){
                            if (y[i].value == ""){
                                $(y[i]).css("background", "#ffdddd");
                                return false;
                            }
                            }
                        }
                
                        // Progress bar
                        for (i = 1; i < showTab; i++){
                            $("#step-"+i).css("background", "blue");
                            $("#step-"+i).css("color", "white");
                        }
                
                        // Switch tab
                        $("#tab-"+hideTab).css("display", "none");
                        $("#tab-"+showTab).css("display", "block");
                        //   $("input").css("background", "#fff");
                        }
                    </script>

                    <script>
                        $(function() {
                        $('.toggle-class').change(function() {
                            var status = $(this).prop('checked') == true ? 1 : 0; 
                            var user_id = $(this).data('id'); 
                            
                            $.ajax({
                                type: "GET",
                                dataType: "json",
                                url: '/submitInterest',
                                data: {'status': status, 'user_id': user_id},
                                success: function(data){
                                    console.log(data.success)
                                }
                            });
                        })
                        })
                    </script>

                    
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

<style>
    /* html,
    body {
        padding: 0;
        margin: 0;
    }

    .wrap {
        font: 12px Arial, san-serif;
    } */

    /* h1.likert-header {
        padding-left: 4.25%;
        margin: 20px 0 0;
    }*/

    form .statement {
        /* display: block; */
        font-size: 14px;
        /* font-weight: bold; */
        /* padding: 30px 0 0 4.25%; */
        /* margin-bottom: 10px; */
    }

    form .likert {
        list-style: none;
        width: 100%;
        margin: 0;
        padding: 30px 0 30px;
        display: block;
        border-bottom: 2px solid #efefef;
    }

    form .likert:last-of-type {
        border-bottom: 0;
    }

    form .likert:before {
        content: '';
        position: relative;
        top: 11px;
        left: 9.5%;
        display: block;
        background-color: #efefef;
        height: 4px;
        width: 78%;
    }

    form .likert li {
        display: inline-block;
        width: 19%;
        text-align: center;
        vertical-align: top;
    }

    form .likert li input[type=radio] {
        display: block;
        position: relative;
        top: 0;
        left: 50%;
        margin-left: -6px;

    }

    form .likert li label {
        width: 100%;
    }

    /* form .buttons {
        margin: 30px 0;
        padding: 0 4.25%;
        text-align: right
    }

    form .buttons button {
        padding: 5px 10px;
        background-color: #67ab49;
        border: 0;
        border-radius: 3px;
    }

    form .buttons .clear {
        background-color: #e9e9e9;
    }

    form .buttons .submit {
        background-color: #67ab49;
    }

    form .buttons .clear:hover {
        background-color: #ccc;
    }

    form .buttons .submit:hover {
        background-color: #14892c;
    } */
</style>