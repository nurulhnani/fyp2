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
                    @if(isset($averagePersArr))
                    <!-- Chart -->
                    <div class="chart-area" style="width:40%; height:40%; margin:0 auto"><canvas id="marksChart"></canvas></div>
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
                                            foreach ($averagePersArr as $category => $mark) {
                                                echo "'" . $mark . "', ";
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

                    <p>This Big Five assessment measures your scores on five major dimensions of personality: Openness, Conscientiousness, Extraversion, Agreeableness, and Neuroticism (sometimes abbreviated OCEAN). In this free report, you'll see a description of each of these five factors of personality, as well as a graph of your score on that measure.</p>
                    <p class="pt-2"><strong>EXTRAVERSION</strong></p>
                    <p>Extraversion describes a person’s inclination to seek stimulation from the outside world, especially in the form of attention from other people. Extraverts engage actively with others to earn friendship, admiration, power, status, excitement, and romance. Introverts, on the other hand, conserve their energy, and do not work as hard to earn these social rewards.</p>
                    <div class="skillbar-wrapper">
                        <div class="skillbar clearfix html5" data-percent="{{ $averagePersArr['Extraversion'] }}%">
                            <h4 class="skillbar-title"><span>EXT</span></h4>
                            <div class="skillbar-bar"></div>
                            <div class="skill-bar-percent">{{ $averagePersArr['Extraversion'] }}%</div>
                        </div>
                    </div>

                    <p class="pt-2"><strong>AGREEABLENESS</strong></p>
                    <p>Agreeableness describes a person’s tendency to put others’ needs ahead of their own, and to cooperate rather than compete with others. People who are high in Agreeableness experience a great deal of empathy and tend to get pleasure out of serving and taking care of others. They are usually trusting and forgiving. People who are low in Agreeableness tend to experience less empathy and put their own concerns ahead of others.</p>
                    <div class="skillbar-wrapper">
                        <div class="skillbar clearfix css" data-percent="{{ $averagePersArr['Agreeableness'] }}%">
                            <h4 class="skillbar-title"><span>AGB</span></h4>
                            <div class="skillbar-bar"></div>
                            <div class="skill-bar-percent">{{ $averagePersArr['Agreeableness'] }}%</div>
                        </div>
                    </div>

                    <p class="pt-2"><strong>NEUROTICISM</strong></p>
                    <p>Neuroticism describes a person’s tendency to experience negative emotions, including fear, sadness, anxiety, guilt, and shame. While everyone experiences these emotions from time to time, some people are more prone to them than others. High Neuroticism scorers are more likely to react to a situation with fear, anger, sadness, and the like. Low Neuroticism scorers are more likely to brush off their misfortune and move on.</p>
                    <div class="skillbar-wrapper">
                        <div class="skillbar clearfix javascript" data-percent="{{ $averagePersArr['Neuroticism'] }}%">
                            <h4 class="skillbar-title"><span>NTM</span></h4>
                            <div class="skillbar-bar"></div>
                            <div class="skill-bar-percent">{{ $averagePersArr['Neuroticism'] }}%</div>
                        </div>
                    </div>

                    <p class="pt-2"><strong>CONSCIENTIOUSNESS</strong></p>
                    <p>Conscientiousness describes a person’s ability to exercise self-discipline and control in order to pursue their goals. High scorers are organized and determined, and are able to forego immediate gratification for the sake of long-term achievement. Low scorers are impulsive and easily sidetracked.</p>
                    <div class="skillbar-wrapper">
                        <div class="skillbar clearfix jquery" data-percent="{{ $averagePersArr['Conscientiousness'] }}%">
                            <h4 class="skillbar-title"><span>CSC</span></h4>
                            <div class="skillbar-bar"></div>
                            <div class="skill-bar-percent">{{ $averagePersArr['Conscientiousness'] }}%</div>
                        </div>
                    </div>

                    <p class="pt-2"><strong>OPENNESS</strong></p>
                    <p>Openness describes a person’s tendency to think in abstract, complex ways. High scorers tend to be creative, adventurous, and intellectual. They enjoy playing with ideas and discovering novel experiences. Low scorers tend to be practical, conventional, and focused on the concrete. They tend to avoid the unknown and follow traditional ways.</p>
                    <div class="skillbar-wrapper">
                        <div class="skillbar clearfix php" data-percent="{{ $averagePersArr['Openness'] }}%">
                            <h4 class="skillbar-title"><span>OPN</span></h4>
                            <div class="skillbar-bar"></div>
                            <div class="skill-bar-percent">{{ $averagePersArr['Openness'] }}%</div>
                        </div>
                    </div>

                    @else 
                    <h4>Your personality result is still in pending.</h4>
                    @endif
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