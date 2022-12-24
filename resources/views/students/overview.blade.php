@extends('layouts.studentapp')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--2">
    
        <h2 class="mt-4">Student Overview</h2>
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                            <i class="fa fa-thumbs-up mr-2"></i>Interest</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
                            <i class="fa fa-street-view mr-2"></i>Personality</a>
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
                        {{-- Interest Tab --}}
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            @if($averageArr == 'No result found')
                                <p>No result found for this student. Please perform the evaluation to view the result</p>
                            @else
                                <div class="row">
                        
                                <div class="col-sm-12">
                                    {{-- <div class="description"> --}}
                                        <?php
                                            if(max($averageArr['Realistic'],$averageArr['Investigative'],$averageArr['Artistic'],$averageArr['Social'],$averageArr['Enterprising'],$averageArr['Conventional']) == $averageArr['Realistic']){
                                                $category[] = "Realistic";
                                            }
                                            if(max($averageArr['Realistic'],$averageArr['Investigative'],$averageArr['Artistic'],$averageArr['Social'],$averageArr['Enterprising'],$averageArr['Conventional']) == $averageArr['Investigative']){
                                                $category[] = "Investigative";
                                            }
                                            if(max($averageArr['Realistic'],$averageArr['Investigative'],$averageArr['Artistic'],$averageArr['Social'],$averageArr['Enterprising'],$averageArr['Conventional']) == $averageArr['Artistic']){
                                                $category[] = "Artistic";
                                            }
                                            if(max($averageArr['Realistic'],$averageArr['Investigative'],$averageArr['Artistic'],$averageArr['Social'],$averageArr['Enterprising'],$averageArr['Conventional']) == $averageArr['Social']){
                                                $category[] = "Social";
                                            }
                                            if(max($averageArr['Realistic'],$averageArr['Investigative'],$averageArr['Artistic'],$averageArr['Social'],$averageArr['Enterprising'],$averageArr['Conventional']) == $averageArr['Enterprising']){
                                                $category[] = "Enterprising";
                                            }
                                            if(max($averageArr['Realistic'],$averageArr['Investigative'],$averageArr['Artistic'],$averageArr['Social'],$averageArr['Enterprising'],$averageArr['Conventional']) == $averageArr['Conventional']){
                                                $category[] = "Conventional";
                                            }
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
                                    {{-- </div> --}}
                                </div>
                                </div>
                        
                                <hr class="my-4" />
                        
                                <style>
                                    .bg-interestres{
                                        background-color: #F9F9F9;
                                    }
                                    .resultimg{
                                        padding-top: 2pt;
                                    }
                                </style>
                                <div class="row pt-4 pb-4">
                                    <div class="col-sm-12 text-left">
                        
                                        <div class="card bg-interestres">
                                            <div class="card-header bg-interestres pb-1">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h3 class="card-category">Results</h3>
                                                        <h5 class="card-category pt-0">Interest Inventory Category</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @if($averageArr != null)
                                                <div class="pieadmin">
                                                    <canvas id="interest-chart" height="230"></canvas>
                                                    <?php
                                                        $interest = "";
                                                        $i=0; 
                                                        $total = 0;
                                                    foreach($averageArr as $avg){
                                                        $total += $avg;
                                                    }
                                                    foreach($averageArr as $avg){
                                                        if($i==0){
                                                            $interest = round(($avg/$total)*100,0);                              
                                                        }else{
                                                            $interest .= ", ".round(($avg/$total)*100,0);
                                                        }
                                                        $i++;
                                                    }
                                                    ?>
                                                    <input type="hidden" id="0" value="{{$interest}}"> 
                                                    
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
                                                                    indexAxis: 'y',
                                                                    data: obj,
                                                                    backgroundColor: ['#540375','#BA94D1','#863A6F','#DEBACE','#C060A1','#D989B5'],
                                                                }
                                                            ],
                                                            };
                                                        
                                                            //options
                                                            var options = {
                                                            responsive: true,
                                                            // scales: {
                                                            //     xAxes: [{
                                                            //         ticks: {
                                                            //         beginAtZero: true
                                                            //         }
                                                            //     }],
                                                            //     yAxes: [{
                                                            //     stacked: true
                                                            //     }]
                                                            // }
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
                                                            type: "horizontalBar",
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
                        
                                    
                                    </div>
                                </div>
                                <div class="row pt-4 pb-2">
                                    <div class="col-sm-6 text-center">
                                        @if(in_array('Realistic',$category))             
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/electrician.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/carpenter.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/soldier.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/mechanic.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                        @endif
                                        @if(in_array('Investigative',$category))            
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/journalist.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/doctor.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/scientist.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>  
                                        @endif
                                        @if(in_array('Artistic',$category))
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/musicians.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/celebrity.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/artist.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                        @endif
                                        @if(in_array('Social',$category))
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/teacher.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/nurse.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/counselor.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                        @endif
                                        @if(in_array('Enterprising',$category))
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/businessman.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/manager.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/salesperson.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                        @endif
                                        @if(in_array('Conventional',$category))
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/blogger.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/bookkeeping.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/interestResult/secretary.jpg')}}" width="130" height="190" class="resultimg">
                                            </a>
                                        @endif
                                    </div>
                        
                                    <div class="col-sm-6">
                        
                                        @if(in_array('Realistic',$category))
                                        <div class="col-sm-12">
                                            <h2 class="card-category mt-4">Realistic</h2>
                                            <p class="card-text">Realistic careers are those that involve working with your hands and often involve physical labor. Examples of a realistic work environment may include working as an electrician, carpenter, military service, or mechanic.</p>
                                        </div>
                                        @endif
                        
                                        @if(in_array('Investigative',$category))
                                        <div class="col-sm-12">
                                            <h2 class="card-category mt-4">Investigative</h2>
                                            <p class="card-text">Investigative careers are those that require knowledge and often involve research or science. Examples of an investigative work environment may include working as a journalist, doctor, or scientist.</p>
                                        </div>
                                        @endif
                        
                                        @if(in_array('Artistic',$category))
                                        <div class="col-sm-12">
                                            <h2 class="card-category mt-4">Artistic</h2>
                                            <p class="card-text">Artistic careers are those that allow you to express your creativity and often involve design or performance. Examples of an artistic work environment may include working as a musician, actor or artist.</p>
                                        </div>
                                        @endif
                        
                                        @if(in_array('Social',$category))
                                        <div class="col-sm-12">
                                            <h2 class="card-category mt-4">Social</h2>
                                            <p class="card-text">Social careers are those that involve working with people and often involve teaching or counseling. Examples of a social work environment may include working as english teachers, language teachers, nurse or counselors.</p>
                                        </div>
                                        @endif
                        
                                        @if(in_array('Enterprising',$category))
                                        <div class="col-sm-12">
                                        <h2 class="card-category mt-4">Enterprising</h2>
                                        <p class="card-text">Enterprising careers are those that involve leadership and often involve sales or management. Examples of an enterprising work environment may include working as a business owner, manager or salesperson.</p>
                                        </div>
                                        @endif
                        
                                        @if(in_array('Conventional',$category))
                                        <div class="col-sm-12">
                                            <h2 class="card-category mt-4">Conventional</h2>
                                            <p class="card-text">Conventional careers are those that require organization and often involve clerical work or administration. Examples of conventional work environments may include working as an office administrator, bookkeeper or secretary.</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>                            
                            @endif 
                        </div>
                        {{-- Personality Tab --}}
                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            
                        </div>
                        {{-- Co-curriculum Tab --}}
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

            height: 300pt;
        }

        .bg-interestres{
            background-color: #F9F9F9;
        }
        .resultimg{
            padding-top: 2pt;
        }
    </style>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush