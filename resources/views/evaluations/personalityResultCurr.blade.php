@extends('layouts.teacherapp')

@section('content')
@include('layouts.headers.cards')

<!-- Header -->
<div class="header pb-5">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-black d-inline-block mb-0">Evaluation Page</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">Student List</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Current Personality Result</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="row">

        <div class="col-xl-5 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
                <div class="card-body pt-0 pt-md-4">
                    <div class="row">
                        <div class="col">
                            <div class="form-row">
                                <div class="form-group col">
                                    <input type="text" class="form-control text-center" id="inputEmail4" placeholder="{{ $student->name }}" readonly="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="chart-area"><canvas id="marksChart"></canvas></div>
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
                                                foreach ($averageArr as $category => $mark) {
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


                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Student Personality Trait Scores') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <p>This Big Five assessment measures your scores on five major dimensions of personality: Openness, Conscientiousness, Extraversion, Agreeableness, and Neuroticism (sometimes abbreviated OCEAN). In this free report, you'll see a description of each of these five factors of personality, as well as a graph of your score on that measure.</p>
                    <!-- <div class="pl-4">
                        <table class="table table-hover table-responsive">
                            <thead>
                                <tr>
                                    @foreach ($averageArr as $k => $v)
                                    <th scope="col">{{ $k }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    @foreach ($averageArr as $k => $v)
                                    <td class="text-center">{{ $v }}</td>
                                    @endforeach
                                </tr>

                            </tbody>
                        </table>
                    </div> -->
                    <p class="pt-2"><strong>EXTRAVERSION</strong></p>
                    <p>Extraversion describes a person’s inclination to seek stimulation from the outside world, especially in the form of attention from other people. Extraverts engage actively with others to earn friendship, admiration, power, status, excitement, and romance. Introverts, on the other hand, conserve their energy, and do not work as hard to earn these social rewards.</p>
                    <div class="skillbar-wrapper">
                        <div class="skillbar clearfix html5" data-percent="{{ $averageArr['Extraversion'] }}%">
                            <h4 class="skillbar-title"><span>EXT</span></h4>
                            <div class="skillbar-bar"></div>
                            <div class="skill-bar-percent">{{ $averageArr['Extraversion'] }}%</div>
                        </div>
                    </div>

                    <p class="pt-2"><strong>AGREEABLENESS</strong></p>
                    <p>Agreeableness describes a person’s tendency to put others’ needs ahead of their own, and to cooperate rather than compete with others. People who are high in Agreeableness experience a great deal of empathy and tend to get pleasure out of serving and taking care of others. They are usually trusting and forgiving. People who are low in Agreeableness tend to experience less empathy and put their own concerns ahead of others.</p>
                    <div class="skillbar-wrapper">
                        <div class="skillbar clearfix css" data-percent="{{ $averageArr['Agreeableness'] }}%">
                            <h4 class="skillbar-title"><span>AGB</span></h4>
                            <div class="skillbar-bar"></div>
                            <div class="skill-bar-percent">{{ $averageArr['Agreeableness'] }}%</div>
                        </div>
                    </div>

                    <p class="pt-2"><strong>NEUROTICISM</strong></p>
                    <p>Neuroticism describes a person’s tendency to experience negative emotions, including fear, sadness, anxiety, guilt, and shame. While everyone experiences these emotions from time to time, some people are more prone to them than others. High Neuroticism scorers are more likely to react to a situation with fear, anger, sadness, and the like. Low Neuroticism scorers are more likely to brush off their misfortune and move on.</p>
                    <div class="skillbar-wrapper">
                        <div class="skillbar clearfix javascript" data-percent="{{ $averageArr['Neuroticism'] }}%">
                            <h4 class="skillbar-title"><span>NTM</span></h4>
                            <div class="skillbar-bar"></div>
                            <div class="skill-bar-percent">{{ $averageArr['Neuroticism'] }}%</div>
                        </div>
                    </div>

                    <p class="pt-2"><strong>CONSCIENTIOUSNESS</strong></p>
                    <p>Conscientiousness describes a person’s ability to exercise self-discipline and control in order to pursue their goals. High scorers are organized and determined, and are able to forego immediate gratification for the sake of long-term achievement. Low scorers are impulsive and easily sidetracked.</p>
                    <div class="skillbar-wrapper">
                        <div class="skillbar clearfix jquery" data-percent="{{ $averageArr['Conscientiousness'] }}%">
                            <h4 class="skillbar-title"><span>CSC</span></h4>
                            <div class="skillbar-bar"></div>
                            <div class="skill-bar-percent">{{ $averageArr['Conscientiousness'] }}%</div>
                        </div>
                    </div>

                    <p class="pt-2"><strong>OPENNESS</strong></p>
                    <p>Openness describes a person’s tendency to think in abstract, complex ways. High scorers tend to be creative, adventurous, and intellectual. They enjoy playing with ideas and discovering novel experiences. Low scorers tend to be practical, conventional, and focused on the concrete. They tend to avoid the unknown and follow traditional ways.</p>
                    <div class="skillbar-wrapper">
                        <div class="skillbar clearfix php" data-percent="{{ $averageArr['Openness'] }}%">
                            <h4 class="skillbar-title"><span>OPN</span></h4>
                            <div class="skillbar-bar"></div>
                            <div class="skill-bar-percent">{{ $averageArr['Openness'] }}%</div>
                        </div>
                    </div>
                    <div class="float-right" style="margin-top: 10px">
                        <a class="btn btn-primary" href="{{ route('evaluations.index') }}">Finish Review</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('layouts.footers.auth')
</div>
@endsection


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

<style>
    /*= Skills */

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