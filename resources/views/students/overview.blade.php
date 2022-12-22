@extends('layouts.studentapp')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--2">
    
        <h2 class="mt-4">Student Overview</h2>
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                            <i class="fa fa-street-view mr-2"></i>Personality</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
                            <i class="fa fa-thumbs-up mr-2"></i>Interest</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">
                            <i class="fa fa-trophy mr-2"></i>Co-curriculum</a>
                    </li>
                </ul>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            <p class="description">Personality</p>
                            <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                            <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.</p>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <div class="row">

                                <div class="col-sm-12">
                                    {{-- <div class="description"> --}}
                                    @if($result != 'No result found')
                                        <?php
                                            if(max($result->realistic,$result->investigative,$result->artistic,$result->social,$result->enterprising,$result->conventional) == $result->realistic){
                                                $category[] = "Realistic";
                                            }
                                            if(max($result->realistic,$result->investigative,$result->artistic,$result->social,$result->enterprising,$result->conventional) == $result->investigative){
                                                $category[] = "Investigative";
                                            }
                                            if(max($result->realistic,$result->investigative,$result->artistic,$result->social,$result->enterprising,$result->conventional) == $result->artistic){
                                                $category[] = "Artistic";
                                            }
                                            if(max($result->realistic,$result->investigative,$result->artistic,$result->social,$result->enterprising,$result->conventional) == $result->social){
                                                $category[] = "Social";
                                            }
                                            if(max($result->realistic,$result->investigative,$result->artistic,$result->social,$result->enterprising,$result->conventional) == $result->enterprising){
                                                $category[] = "Enterprising";
                                            }
                                            if(max($result->realistic,$result->investigative,$result->artistic,$result->social,$result->enterprising,$result->conventional) == $result->conventional){
                                                $category[] = "Conventional";
                                            };
                                        ?>  
                                        <form>
                                            <div class="row">
                                            <div class="col-sm-2">
                                                <label for="example-text-input" class="form-control-label">Student Name</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <p class="mb-0">{{$student->name}}</p>
                                                {{-- <input class="form-control form-control-sm" type="text" value="{{$student->name}}" disabled> --}}
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-sm-2">
                                                <label for="example-text-input" class="form-control-label">Category</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <?php $cat = implode(', ',$category);?>
                                                <p class="mb-0">{{$cat}}</p>
                                                {{-- <input class="form-control form-control-sm" type="text" value="{{$cat}}" disabled> --}}
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-sm-2">
                                                <label for="example-text-input" class="form-control-label">Evaluated by</label>
                                            </div>
                                            <?php
                                                $teachers = [];
                                                foreach ($teacherids as $key => $teacherid) {
                                                $teachers[] = App\Models\Teacher::find($teacherid)->name;
                                                }  
                                            ?>
                                            <div class="col-sm-10">
                                                <?php $i=1;?>
                                                @foreach ($teachers as $teacher)
                                                <p class="mb-0">{{$i}}. {{$teacher}}</p>
                                                <?php $i++ ?>
                                                @endforeach
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                    {{-- </div> --}}
                                </div>
                            </div>

                            <hr class="my-4" />
                            <div class="row">
                                
                                    @if($result == 'No result found')
                                <div class="col-sm-12">
                                    <p class="card-text">No result found for this student. Please complete the evaluation to view the result.</p>
                                </div> 
                                    @else
                                <div class="col-sm-7">
                                    <p class="card-text">Below are the interest inventory result which have been evaluated by your teachers:</p>

                                    <?php
                                    if(max($result->realistic,$result->investigative,$result->artistic,$result->social,$result->enterprising,$result->conventional) == $result->realistic){
                                        $category[] = "Realistic";
                                    }
                                    if(max($result->realistic,$result->investigative,$result->artistic,$result->social,$result->enterprising,$result->conventional) == $result->investigative){
                                        $category[] = "Investigative";
                                    }
                                    if(max($result->realistic,$result->investigative,$result->artistic,$result->social,$result->enterprising,$result->conventional) == $result->artistic){
                                        $category[] = "Artistic";
                                    }
                                    if(max($result->realistic,$result->investigative,$result->artistic,$result->social,$result->enterprising,$result->conventional) == $result->social){
                                        $category[] = "Social";
                                    }
                                    if(max($result->realistic,$result->investigative,$result->artistic,$result->social,$result->enterprising,$result->conventional) == $result->enterprising){
                                        $category[] = "Enterprising";
                                    }
                                    if(max($result->realistic,$result->investigative,$result->artistic,$result->social,$result->enterprising,$result->conventional) == $result->conventional){
                                        $category[] = "Conventional";
                                    };
                                    ?>

                                    @if(in_array('Realistic',$category))
                                    <div class="row pt-3">
                                    <div class="col-sm-12 text-center">
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/electrician.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/carpenter.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/soldier.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/mechanic.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    </div>
                                    </div>

                                    <div class="row pt-3">
                                    <div class="col-sm-12 text-center">
                                    <p class="card-text mt-4">Realistic careers are those that involve working with your hands and often involve physical labor. Examples of a realistic work environment may include working as an electrician, carpenter, military service, or mechanic.</p>
                                    </div>
                                    </div>
                                    @endif

                                    @if(in_array('Investigative',$category))
                                    <div class="row pt-3">
                                    <div class="col-sm-12 text-center">
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/journalist.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/doctor.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/scientist.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    </div>
                                    </div>

                                    <div class="row pt-3">
                                    <div class="col-sm-12 text-center">
                                    <p class="card-text mt-4">Investigative careers are those that require knowledge and often involve research or science. Examples of an investigative work environment may include working as a journalist, doctor, or scientist.</p>
                                    </div>
                                    </div>
                                    @endif

                                    @if(in_array('Artistic',$category))
                                    <div class="row pt-3">
                                    <div class="col-sm-12 text-center">
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/musicians.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/celebrity.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/artist.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    </div>
                                    </div>

                                    <div class="row pt-3">
                                    <div class="col-sm-12 text-center">
                                    <p class="card-text mt-4">Artistic careers are those that allow you to express your creativity and often involve design or performance. Examples of an artistic work environment may include working as a musician, actor or artist.</p>
                                    </div>
                                    </div>
                                    @endif

                                    @if(in_array('Social',$category))
                                    <div class="row pt-3">
                                    <div class="col-sm-12 text-center">
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/teacher.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/nurse.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/counselor.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    </div>
                                    </div>

                                    <div class="row pt-3">
                                    <div class="col-sm-12 text-center">
                                    <p class="card-text mt-4">Social careers are those that involve working with people and often involve teaching or counseling. Examples of a social work environment may include working as english teachers, language teachers, nurse or counselors.</p>
                                    </div>
                                    </div>
                                    @endif

                                    @if(in_array('Enterprising',$category))
                                    <div class="row pt-3">
                                    <div class="col-sm-12 text-center">
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/businessman.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/manager.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/estate-agent.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    </div>
                                    </div>

                                    <div class="row pt-3">
                                    <div class="col-sm-12 text-center">
                                    <p class="card-text mt-4">Enterprising careers are those that involve leadership and often involve sales or management. Examples of an enterprising work environment may include working as a business owner, manager or salesperson.</p>
                                    </div>
                                    </div>
                                    @endif

                                    @if(in_array('Conventional',$category))
                                    <div class="row pt-3">
                                    <div class="col-sm-12 text-center">
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/blogger.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/bookkeeping.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    <a href="#">
                                        <img id="output_image" src="{{asset('assets/img/interestResult/secretary.png')}}" class="rounded-circle resultimg">
                                    </a>
                                    </div>
                                    </div>

                                    <div class="row pt-3">
                                    <div class="col-sm-12 text-center">
                                    <p class="card-text mt-4">Conventional careers are those that require organization and often involve clerical work or administration. Examples of conventional work environments may include working as an office administrator, bookkeeper or secretary.</p>
                                    </div>
                                    </div>
                                    @endif

                                    <style>
                                    .resultimg{
                                    padding-right: 10pt;
                                    width: 25%;
                                    height: 100%;
                                    /* box-shadow: 10px 10px; */
                                    }
                                    </style>

                                    {{-- </div> --}}
                                    @endif
                                </div>

                                @if($data != null)
                                <div class="col-sm-5">
                                    <div id="pieadmin">
                                        {{-- // Chart wrapper --}}
                                        <canvas id="interest-chart" class="chart-canvas"></canvas>
                                        <?php
                                            $interest = "";
                                            $i=0; 
                                            foreach($data as $data){
                                                if($i==0){
                                                    $interest = $data;                              
                                                }else{
                                                    $interest .= ", ".$data;
                                                }
                                                $i++;
                                            }
                                            // dd($interest);    
                                        ?>
                                        <input type="hidden" id="0" value="{{$interest}}">
                                    </div>
    
                                    <script>
                                        $(function(){
                                            obj = document.getElementById('0').value.replace(" ", "").split(',');
                                            console.log(obj);
                                            //get the pie chart canvas
                                            var ctx = $("#interest-chart");
                                        
                                            //pie chart data
                                            var data = {
                                            labels: ["Realistic","Investigative","Artistic","Social","Enterprising","Conventional"],
                                            datasets: [
                                                {
                                                // data: [1,2,3,1,4,5],
                                                data: obj,
                                                backgroundColor: ['#540375','#BA94D1','#863A6F','#DEBACE','#C060A1','#D989B5'],
                                                }
                                            ],
                                            };
                                        
                                            //options
                                            var options = {
                                            responsive: true,
                                            legend: {
                                                display: true,
                                                position: 'bottom',
                                                labels: {
                                                    fontColor: "#000080",
                                                }
                                            },
                                            tooltips: {
                                                callbacks: {
                                                    label: function(tooltipItem, data) {
                                                        return data.labels[tooltipItem.index] + ': ' + data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] + '%';
                                                    }
                                                }
                                            }
                                            };
                                        
                                            //create Pie Chart class object
                                            var chart1 = new Chart(ctx, {
                                            type: "pie",
                                            // showInLegend: true, 
                                            data: data,
                                            options: options,
                                            });
                                        
                                        });
                                    </script>
                                </div>
                                @endif
                            </div>

                            
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                            <p class="description">Co-curriculum</p>
                            <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                        </div>
                    </div>
                </div>
            </div>

        @include('layouts.footers.auth')
    </div>

    <style>

        #pieadmin
        {
            position: relative;

            height: 100%;
        }

    </style>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush