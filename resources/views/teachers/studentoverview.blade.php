@extends('layouts.teacherapp')

@section('content')
@include('layouts.headers.cards')

<!-- Header -->
<div class="header">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-12 col-12">
                    <h6 class="h2 text-black d-inline-block mb-0">Student Overview</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('studentlist') }}">Student List</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$student->name}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--2">

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
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false">
                    <i class="ni ni-diamond mr-2"></i>Behavioural</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-5-tab" data-toggle="tab" href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-5" aria-selected="false">
                    <i class="fa fa-heart mr-2"></i>Health</a>
            </li>
        </ul>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                {{-- Interest Tab --}}
                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    @if($averageArr == 'No result found')
                    <h4>No result found for {{$student->name}}.</h4>
                    @else
                    <div class="row">

                        <div class="col-sm-12">
                            {{-- <div class="description"> --}}
                            <?php
                            if (max($averageArr['Realistic'], $averageArr['Investigative'], $averageArr['Artistic'], $averageArr['Social'], $averageArr['Enterprising'], $averageArr['Conventional']) == $averageArr['Realistic']) {
                                $category[] = "Realistic";
                            }
                            if (max($averageArr['Realistic'], $averageArr['Investigative'], $averageArr['Artistic'], $averageArr['Social'], $averageArr['Enterprising'], $averageArr['Conventional']) == $averageArr['Investigative']) {
                                $category[] = "Investigative";
                            }
                            if (max($averageArr['Realistic'], $averageArr['Investigative'], $averageArr['Artistic'], $averageArr['Social'], $averageArr['Enterprising'], $averageArr['Conventional']) == $averageArr['Artistic']) {
                                $category[] = "Artistic";
                            }
                            if (max($averageArr['Realistic'], $averageArr['Investigative'], $averageArr['Artistic'], $averageArr['Social'], $averageArr['Enterprising'], $averageArr['Conventional']) == $averageArr['Social']) {
                                $category[] = "Social";
                            }
                            if (max($averageArr['Realistic'], $averageArr['Investigative'], $averageArr['Artistic'], $averageArr['Social'], $averageArr['Enterprising'], $averageArr['Conventional']) == $averageArr['Enterprising']) {
                                $category[] = "Enterprising";
                            }
                            if (max($averageArr['Realistic'], $averageArr['Investigative'], $averageArr['Artistic'], $averageArr['Social'], $averageArr['Enterprising'], $averageArr['Conventional']) == $averageArr['Conventional']) {
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
                                        <?php $cat = implode(', ', $category); ?>
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
                                        <?php $i = 1; ?>
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
                        .bg-interestres {
                            background-color: #F9F9F9;
                        }

                        .resultimg {
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
                                        $i = 0;
                                        $total = 0;
                                        foreach ($averageArr as $avg) {
                                            $total += $avg;
                                        }
                                        foreach ($averageArr as $avg) {
                                            if ($i == 0) {
                                                $interest = round(($avg / $total) * 100, 0);
                                            } else {
                                                $interest .= ", " . round(($avg / $total) * 100, 0);
                                            }
                                            $i++;
                                        }
                                        ?>
                                        <input type="hidden" id="0" value="{{$interest}}">

                                        <script>
                                            $(function() {
                                                obj = document.getElementById('0').value.replace(" ", "").split(',');
                                                console.log(obj);
                                                //get the pie chart canvas
                                                var ctx = $("#interest-chart");

                                                //pie chart data
                                                var data = {
                                                    labels: ["Realistic", "Investigative", "Artistic", "Social", "Enterprising", "Conventional"],
                                                    datasets: [{
                                                        indexAxis: 'y',
                                                        data: obj,
                                                        backgroundColor: ['#540375', '#BA94D1', '#863A6F', '#DEBACE', '#C060A1', '#D989B5'],
                                                    }],
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
                            {{-- <a href="#">
                                <img id="output_image" src="{{asset('assets/img/interestResult/electrician.jpg')}}" width="130" height="190" class="resultimg">
                            </a> --}}
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
                    @if(isset($averagePersArr))
                    <div class=row>
                        <div class="col">
                            <h5 class="h3 card-category">Personality Assessment Result</h5>
                        </div>
                    </div>
                    <!-- Chart -->
                    <div class="chart-area" style="width:30%; height:30%; margin:0 auto"><canvas id="marksChart"></canvas></div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                    <script>
                        var marksCanvas = document.getElementById("marksChart");

                        var marksData = {
                            labels: [
                                'EXT',
                                'AGB',
                                'NTM',
                                'CSC',
                                'OPN',
                            ],
                            datasets: [{
                                    label: "Big 5 Personality",
                                    backgroundColor: "rgba(200,0,0,0.2)",
                                    data: [<?php
                                            foreach ($averagePersArr as $arr) {
                                                echo "'" . $arr['category'] . "', ";
                                            } ?>],
                                },

                            ]
                        };

                        var options = {
                            responsive: true,
                            maintainAspectRatio: true,
                            scale: {
                                ticks: {
                                    beginAtZero: true,
                                    max: 100
                                }
                            }


                        };

                        var radarChart = new Chart(marksCanvas, {
                            type: 'radar',
                            data: marksData,
                            options: options,
                        });
                    </script>
                    <!--End Chart-->
                    <p class="card-text mt-2">This Big Five assessment measures student's scores on five major dimensions of personality: <strong>Openness, Conscientiousness, Extraversion, Agreeableness, and Neuroticism</strong>.
                        Below is the table of general characteristics for both high and low scorer of each category.</p>

                    <div class="table-responsive pt-2">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center"></th>
                                    <th scope="col" class="text-center">LOW SCORER</th>
                                    <th scope="col" class="text-center" style="width: 20%;"></th>
                                    <th scope="col" class="text-center">HIGH SCORER</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($averagePersArr as $average => $values)
                                <tr>
                                    <th scope="row">
                                        <div class="px-1 py-1 text-center" style="background-color:powderblue; border-radius: 10px;"><strong>{{ $average }}</strong></div>
                                    </th>
                                    <!--Low Scorer-->
                                    <td>
                                        <ul>
                                            @foreach ($values['low'] as $index => $val)
                                            <li>{{ $val }}</li>
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td>
                                        <input type="range" class="win10-thumb" disabled value="{{ $values['category'] }}" />
                                    </td>

                                    <!--High Scorer-->
                                    <td>
                                        <ul>
                                            @foreach ($values['high'] as $index => $val)
                                            <li>{{ $val }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h4>No result found for {{$student->name}}.</h4>
                    @endif
                </div>
                {{-- Co-curriculum Tab --}}
                <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    @if(isset($merits))
                    <div class=row>
                        <div class="col">
                            <h5 class="h3 card-category">Curriculum Merit Transcript</h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">ACTIVITY</th>
                                    <th scope="col" class="sort" data-sort="budget">LEVEL</th>
                                    <th scope="col" class="sort" data-sort="status">ACHIEVEMENT</th>
                                    <th scope="col">MERIT</th>
                                    <th scope="col" class="sort" data-sort="completion">DATE</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($merits as $merit)
                                <tr>
                                    <th scope="row">
                                        {{ $merit->merit_name }}
                                    </th>
                                    <td class="budget">
                                        {{ $merit->level }}
                                    </td>
                                    <td>
                                        {{ $merit->achievement }}
                                    </td>
                                    <td>
                                        {{ $merit->merit_point }}
                                    </td>
                                    <td>
                                        {{ $merit->date }}
                                    </td>
                                </tr>
                                @endforeach
                                <h5 class="float-right"> Total Merits Accumulated: <?php echo $merits->sum('merit_point'); ?></h5>

                            </tbody>
                        </table>
                        <p class="btn-secondary h5 card-text text-right pt-3">Latest Record Updated at: {{ $latestDate->created_at->toDateString() }}</p>

                    </div>
                    @else
                    <h4>No result found for {{$student->name}}.</h4>
                    @endif

                </div>

                {{-- Behavioural Tab --}}
                <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                    @if(count($behaMerits) == 0 && count($behaDemerits) == 0)
                    <h4>No result found for {{$student->name}}.</h4>
                    @else
                    <div class=row>
                        <div class="col">
                            <h5 class="h3 card-category">Behavioural Merit and Demerit Transcript</h5>
                        </div>
                    </div>
                    <h5 class="float-right"> Total Merits Accumulated: <?php echo $behaMerits->sum('merit_point'); ?></h5>
                    <!-- Card header -->
                    <div class="card mt-5">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="mb-0">Merit Records</h4>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">ACTIVITY</th>
                                        <th scope="col" class="sort" data-sort="budget">CATEGORY</th>
                                        <th scope="col">MERIT</th>
                                        <th scope="col" class="sort" data-sort="completion">DATE</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($behaMerits as $merit)
                                    <th scope="row">
                                        {{ $merit->merit_name }}
                                    </th>
                                    <td class="budget">
                                        {{ $merit->level }}
                                    </td>
                                    <td>
                                        {{ $merit->merit_point }}
                                    </td>
                                    <td>
                                        {{ $merit->date }}
                                    </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @if(isset($behaLatestDate))
                            <p class="btn-secondary h5 card-text text-right pt-3">Latest Record Updated at: {{ $behaLatestDate->created_at->toDateString() }}</p>
                            @endif
                        </div>
                    </div>
                    <!-- Card header -->
                    <div class="card mt-5">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="mb-0">Demerit Records</h4>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">ACTIVITY</th>
                                        <th scope="col" class="sort" data-sort="budget">CATEGORY</th>
                                        <th scope="col">DEMERIT</th>
                                        <th scope="col" class="sort" data-sort="completion">DATE</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($behaDemerits as $merit)
                                    <tr>
                                        <th scope="row">
                                            {{ $merit->merit_name }}
                                        </th>
                                        <td class="budget">
                                            {{ $merit->level }}
                                        </td>
                                        <td>
                                            {{ $merit->merit_point }}
                                        </td>
                                        <td>
                                            {{ $merit->date }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if(isset($behaLatestDate))
                            <p class="btn-secondary h5 card-text text-right pt-3">Latest Record Updated at: {{ $behaLatestDate->created_at->toDateString() }}</p>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Health Tab --}}
                <div class="tab-pane fade" id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">
                    @if($record == null)
                        <h4>No result found for {{$student->name}}.</h4>
                    @else
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
                        </div>
                        @else
                        <div class="col-sm-3">
                            <p class="text-default">Not Yet Assigned</p>
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
                            <p name="height" class="text-default">@if($record != null){{$record->height}} @else N/A @endif</p>
                        </div>
                        <div class="col-sm-1">
                            <h4>Weight</h4>
                        </div>
                        <div class="col-sm-3">
                            <p name="weight" class="text-default">@if($record != null){{$record->weight}} @else N/A @endif</p>
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col">
                            <h3 class="heading text-muted">STUDENT'S HEALTH HISTORY</h3>
                        </div>
                    </div>

                    <?php
                    if ($record != null) {
                        if ($record->health_history == null) {
                            $health_explode = ["N/A"];
                        } else {
                            $health_history = $record->health_history;
                            $health_explode = explode(',', $health_history);
                        }
                    } else {
                        $health_explode = ["N/A"];
                    }

                    // dd($health_explode);
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Heart Disease',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Permanent defect from illness',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Fainting, dizziness',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Stomach Ulcer',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Asthma',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Allergies',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Rheumatic fever',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Eye disease',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Tuberculosis',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Hearing difficulty',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Ear, nose, throat trouble-sinus',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Hepatitis',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Kidney disease',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Nervous disorder',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Respiratory disease',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Muscular disease',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Mental illness',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('High Blood Pressure',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Hernia',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Arthritis, joint disease',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Diabetes',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Cancer',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Back Injuries" @if(in_array('Headaches',$health_explode)) checked="checked" @endif>
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
                                    <input type="checkbox" name="Medical treatment" @if(in_array('Medical treatment',$health_explode)) checked="checked" @endif>
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
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group">
                                    <textarea class="form-control" aria-label="With textarea">@if($record != null) @if($record->description != null){{{$record->description}}} @else N/A @endif @else N/A @endif</textarea>
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
                            @if($record->medication_allergies != null)
                            <p class="text-default">{{$record->medication_allergies}}</p>
                            @else
                            <p class="text-default">N/A</p>
                            @endif
                            @else
                            <p class="text-default">N/A</p>
                            @endif
                        </div>
                        <div class="col-sm-2">
                            <h4>Medications Now Taking</h4>
                        </div>
                        <div class="col-sm-4">
                            @if($record != null)
                            @if($record->medications_now_taking != null)
                            <p class="text-default">{{$record->medications_now_taking}}</p>
                            @else
                            <p class="text-default">N/A</p>
                            @endif
                            @else
                            <p class="text-default">N/A</p>
                            @endif
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col">
                            <h4>Childhood Diseases:</h4>
                        </div>
                    </div>
                    <?php
                    if ($record != null) {
                        if ($record->chicken_pox != null) {
                            $chickenpox = explode(',', $record->chicken_pox);
                        } else {
                            $chickenpox = "N/A";
                        }

                        if ($record->measles != null) {
                            $measles = explode(',', $record->chicken_pox);
                        } else {
                            $measles = ["N/A"];
                        }

                        if ($record->mumps != null) {
                            $mumps = explode(',', $record->mumps);
                        } else {
                            $mumps = ["N/A"];
                        }
                    } else {
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
                                            <input type="checkbox" aria-label="Checkbox for following text input" name="had_chickenpox" @if(in_array('Had',$chickenpox)) checked="checked" @endif>
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
                                            <input type="checkbox" aria-label="Checkbox for following text input" name="immunized_chickenpox" @if(in_array('Immunized',$chickenpox)) checked="checked" @endif>
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
                                            <input type="checkbox" aria-label="Checkbox for following text input" name="had_measles" @if(in_array('Had',$measles)) checked="checked" @endif>
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
                                            <input type="checkbox" aria-label="Checkbox for following text input" name="immunized_measles" @if(in_array('Immunized',$measles)) checked="checked" @endif>
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
                                            <input type="checkbox" aria-label="Checkbox for following text input" name="had_mumps" @if(in_array('Had',$mumps)) checked="checked" @endif>
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
                                            <input type="checkbox" aria-label="Checkbox for following text input" name="immunized_mumps" @if(in_array('Immunized',$mumps)) checked="checked" @endif>
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
                                            <input type="checkbox" aria-label="Checkbox for following text input" name="Excellent" @if($record !=null) @if($record->present_health == "Excellent") checked="checked"@endif @endif>
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
                                            <input type="checkbox" aria-label="Checkbox for following text input" name="Good" @if($record !=null) @if($record->present_health == "Good") checked="checked"@endif @endif>
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
                                            <input type="checkbox" aria-label="Checkbox for following text input" name="Fair" @if($record !=null) @if($record->present_health == "Fair") checked="checked"@endif @endif>
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
                                            <input type="checkbox" aria-label="Checkbox for following text input" name="Poor" @if($record !=null) @if($record->present_health == "Poor") checked="checked"@endif @endif>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="Poor">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col text-left py-4">
            <a class="btn btn-secondary" href="{{ route('studentlist') }}">Back</a>
        </div>
    </div>
    @include('layouts.footers.auth')

</div>

<style>
    #pieadmin {
        position: relative;

        height: 300pt;
    }

    .bg-interestres {
        background-color: #F9F9F9;
    }

    .resultimg {
        padding-top: 2pt;
    }

    /*= Personality Tab */

    .skillbar-wrapper {
        margin: 1.5em auto;
        max-width: 960px;
    }

    .skillbar {
        position: relative;
        margin-bottom: 15px;
        width: 100%;
        background: #eee;
        height: 35px;
        border-radius: 3px;
    }

    .skillbar-title {
        position: absolute;
        top: 0;
        left: 0;
        width: 110px;
        font-weight: bold;
        font-size: 13px;
        color: #fff;
        border-top-left-radius: 3px;
        border-bottom-left-radius: 3px;
        margin: 0;
    }

    .skillbar-title span {
        display: block;
        background: rgba(0, 0, 0, 0.1);
        padding: 0 20px;
        height: 35px;
        line-height: 35px;
        border-top-left-radius: 3px;
        border-bottom-left-radius: 3px;
    }

    .skillbar-bar {
        height: 35px;
        width: 0%;
        border-radius: 3px;
        transition: 500ms linear;
        transition-property: width, background-color;
    }

    .skill-bar-percent {
        position: absolute;
        right: 10px;
        top: 0;
        font-size: 11px;
        height: 35px;
        line-height: 35px;
        color: rgba(0, 0, 0, 0.4);
        transition: color 500ms ease-out;
    }

    .complete .skill-bar-percent {
        color: #808080;
    }

    .complete.server .skill-bar-percent {
        color: #333;
    }

    .html5 .skillbar-title {
        background: #d35400;
    }

    .html5 .skillbar-bar {
        background: #e67e22;
    }


    .css .skillbar-title {
        background: #2980b9;
    }

    .css .skillbar-bar {
        background: #3498db;
    }

    .javascript .skillbar-title {
        background: #fac552;
    }

    .javascript .skillbar-bar {
        background: #f1ac18;
    }

    .jquery .skillbar-title {
        background: #2c3e50;
    }

    .jquery .skillbar-bar {
        background: #2c3e50;
    }

    .php .skillbar-title {
        background: #46465e;
    }

    .php .skillbar-bar {
        background: #5a68a5;
    }

    .wordpress .skillbar-title {
        background: #333333;
    }

    .wordpress .skillbar-bar {
        background: #525252;
    }

    .server .skillbar-title {
        background: #5e2750;
    }

    .server .skillbar-bar {
        background: #d43227;
    }

    /* === range slider === */
    input[type="range"] {
        font-size: 1.5rem;
        width: 12.5em;
    }

    input[type="range"] {
        color: #ef233c;
        --thumb-height: 1.125em;
        --track-height: 0.125em;
        --track-color: rgba(0, 0, 0, 0.2);
        --brightness-hover: 180%;
        --brightness-down: 80%;
        --clip-edges: 0.125em;
    }

    input[type="range"].win10-thumb {
        color: #2b2d42;

        --thumb-height: 1.375em;
        --thumb-width: 0.5em;
        --clip-edges: 0.0125em;
    }

    @media (prefers-color-scheme: dark) {
        html {
            background-color: #000;
        }

        html::before {
            background: radial-gradient(circle at center, #101112, #000);
        }

        input[type="range"] {
            color: #f07167;
            --track-color: rgba(255, 255, 255, 0.1);
        }

        input[type="range"].win10-thumb {
            color: #3a86ff;
        }
    }

    input[type="range"] {
        position: relative;
        background: #fff0;
        overflow: hidden;
    }

    input[type="range"]:active {
        cursor: grabbing;
    }

    input[type="range"]:disabled {
        filter: grayscale(1);
        opacity: 0.3;
        cursor: not-allowed;
    }

    input[type="range"],
    input[type="range"]::-webkit-slider-runnable-track,
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        transition: all ease 100ms;
        height: var(--thumb-height);
    }

    input[type="range"]::-webkit-slider-runnable-track,
    input[type="range"]::-webkit-slider-thumb {
        position: relative;
    }

    input[type="range"]::-webkit-slider-thumb {
        --thumb-radius: calc((var(--thumb-height) * 0.5) - 1px);
        --clip-top: calc((var(--thumb-height) - var(--track-height)) * 0.5 - 0.5px);
        --clip-bottom: calc(var(--thumb-height) - var(--clip-top));
        --clip-further: calc(100% + 1px);
        --box-fill: calc(-100vmax - var(--thumb-width, var(--thumb-height))) 0 0 100vmax currentColor;

        width: var(--thumb-width, var(--thumb-height));
        background: linear-gradient(currentColor 0 0) scroll no-repeat left center / 50% calc(var(--track-height) + 1px);
        background-color: currentColor;
        box-shadow: var(--box-fill);
        border-radius: var(--thumb-width, var(--thumb-height));

        filter: brightness(100%);
        clip-path: polygon(100% -1px,
                var(--clip-edges) -1px,
                0 var(--clip-top),
                -100vmax var(--clip-top),
                -100vmax var(--clip-bottom),
                0 var(--clip-bottom),
                var(--clip-edges) 100%,
                var(--clip-further) var(--clip-further));
    }

    input[type="range"]:hover::-webkit-slider-thumb {
        filter: brightness(var(--brightness-hover));
        cursor: grab;
    }

    input[type="range"]:active::-webkit-slider-thumb {
        filter: brightness(var(--brightness-down));
        cursor: grabbing;
    }

    input[type="range"]::-webkit-slider-runnable-track {
        background: linear-gradient(var(--track-color) 0 0) scroll no-repeat center / 100% calc(var(--track-height) + 1px);
    }

    input[type="range"]:disabled::-webkit-slider-thumb {
        cursor: not-allowed;
    }
</style>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush

<script>
    (function() {

        var SkillsBar = function(bars) {
            this.bars = document.querySelectorAll(bars);
            if (this.bars.length > 0) {
                this.init();
            }
        };

        SkillsBar.prototype = {
            init: function() {
                var self = this;
                self.index = -1;
                self.timer = setTimeout(function() {
                    self.action();
                }, 500);


            },
            select: function(n) {
                var self = this,
                    bar = self.bars[n];

                if (bar) {
                    var width = bar.parentNode.dataset.percent;

                    bar.style.width = width;
                    bar.parentNode.classList.add("complete");
                }
            },
            action: function() {
                var self = this;
                self.index++;
                if (self.index == self.bars.length) {
                    clearTimeout(self.timer);
                } else {
                    self.select(self.index);
                }

                setTimeout(function() {
                    self.action();
                }, 500);
            }
        };

        window.SkillsBar = SkillsBar;

    })();

    (function() {
        document.addEventListener("DOMContentLoaded", function() {
            var skills = new SkillsBar(".skillbar-bar");
        });
    })();
</script>