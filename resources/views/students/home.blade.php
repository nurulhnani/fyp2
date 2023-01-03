@extends('layouts.studentapp')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--2">
    
        <div class="row">
            <div class="col-sm-10">
                <h3 class="mt-4 heading-small text-muted">WELCOME TO STUDENT DASHBOARD!</h3>
            </div>
            <div class="mt-4 col-sm-2 text-right">
                <a href="#filterByYear" data-toggle="modal" class="btn btn-sm btn-primary">
                    <span class="d-none d-md-block">Filter By Year</span>
                    <span class="d-md-none"><i class="fa fa-plus"></i></span>
                </a>
            </div>
        </div>


        <!--Filter Modal -->
        <div class="modal fade" id="filterByYear" tabindex="-1" role="dialog" aria-labelledby="archiveModal" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Filter Dashboard By Year</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body text-center">
                    {{-- @foreach($years as $year)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox[]" class="custom-control-input" id="{{$year->year}}" value="{{$year->year}}">
                            <label class="custom-control-label" for="{{$year->year}}">{{$year->year}}</label>
                        </div>
                    @endforeach --}}
                {{-- <h4 class="text-center"></h4> --}}
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-sm-12 mb-xl-0">
                <div class="card bg-white">
                    <div class="card-header bg-white">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-category">Scores</h5>
                                <h2 class="card-title mb-0">Big 5 Personality Traits</h2>
                            </div>
                            {{-- <div class="col text-right">
                                <a tabindex="0" role="button" data-trigger="focus" class="btn btn-sm btn-primary" data-placement="left" data-color="primary" id="popover_cocu">See Details</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <div class="row">
                                <div class="col-sm-7 pl-6">
                                    <canvas id="marksChart" height="200pt"></canvas>
                                </div>
                                <div class="col-sm-5">
                                    <div class="skillbar-wrapper">
                                        <div class="skillbar clearfix html5" data-percent="{{ $averageArr['Extraversion'] }}%">
                                            <h4 class="skillbar-title"><span>EXTROVERSION</span></h4>
                                            <div class="skillbar-bar"></div>
                                            <div class="skill-bar-percent">{{ $averageArr['Extraversion'] }}%</div>
                                        </div>
                                    </div>
                                    <div class="skillbar-wrapper">
                                        <div class="skillbar clearfix css" data-percent="{{ $averageArr['Agreeableness'] }}%">
                                            <h4 class="skillbar-title"><span>AGREEABLENESS</span></h4>
                                            <div class="skillbar-bar"></div>
                                            <div class="skill-bar-percent">{{ $averageArr['Agreeableness'] }}%</div>
                                        </div>
                                    </div>
                                    <div class="skillbar-wrapper">
                                        <div class="skillbar clearfix javascript" data-percent="{{ $averageArr['Neuroticism'] }}%">
                                            <h4 class="skillbar-title"><span>NEUROTICISM</span></h4>
                                            <div class="skillbar-bar"></div>
                                            <div class="skill-bar-percent">{{ $averageArr['Neuroticism'] }}%</div>
                                        </div>
                                    </div>
                                    <div class="skillbar-wrapper">
                                        <div class="skillbar clearfix jquery" data-percent="{{ $averageArr['Conscientiousness'] }}%">
                                            <h4 class="skillbar-title"><span>CONSCIENTIOUSNESS</span></h4>
                                            <div class="skillbar-bar"></div>
                                            <div class="skill-bar-percent">{{ $averageArr['Conscientiousness'] }}%</div>
                                        </div>
                                    </div>
                                    <div class="skillbar-wrapper">
                                        <div class="skillbar clearfix php" data-percent="{{ $averageArr['Openness'] }}%">
                                            <h4 class="skillbar-title"><span>OPENNESS</span></h4>
                                            <div class="skillbar-bar"></div>
                                            <div class="skill-bar-percent">{{ $averageArr['Openness'] }}%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

        @if($averageInterest != "No result found")
        <?php
            $category = [];
            if(max($averageInterest['Realistic'],$averageInterest['Investigative'],$averageInterest['Artistic'],$averageInterest['Social'],$averageInterest['Enterprising'],$averageInterest['Conventional']) == $averageInterest['Realistic']){
                $category[] = "Realistic";
            }
            if(max($averageInterest['Realistic'],$averageInterest['Investigative'],$averageInterest['Artistic'],$averageInterest['Social'],$averageInterest['Enterprising'],$averageInterest['Conventional']) == $averageInterest['Investigative']){
                $category[] = "Investigative";
            }
            if(max($averageInterest['Realistic'],$averageInterest['Investigative'],$averageInterest['Artistic'],$averageInterest['Social'],$averageInterest['Enterprising'],$averageInterest['Conventional']) == $averageInterest['Artistic']){
                $category[] = "Artistic";
            }
            if(max($averageInterest['Realistic'],$averageInterest['Investigative'],$averageInterest['Artistic'],$averageInterest['Social'],$averageInterest['Enterprising'],$averageInterest['Conventional']) == $averageInterest['Social']){
                $category[] = "Social";
            }
            if(max($averageInterest['Realistic'],$averageInterest['Investigative'],$averageInterest['Artistic'],$averageInterest['Social'],$averageInterest['Enterprising'],$averageInterest['Conventional']) == $averageInterest['Enterprising']){
                $category[] = "Enterprising";
            }
            if(max($averageInterest['Realistic'],$averageInterest['Investigative'],$averageInterest['Artistic'],$averageInterest['Social'],$averageInterest['Enterprising'],$averageInterest['Conventional']) == $averageInterest['Conventional']){
                $category[] = "Conventional";
            }
        ?>  
        <div class="row mt-3">     
            <div class="col-xl-8 mb-xl-0">
                <div class="card bg-white">
                    <div class="card-header bg-white pb-1">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-category pt-0">Interest Inventory Evaluation</h5>
                                <h3 class="card-category">Tendency</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($averageInterest != null)
                        <div class="pieadmin">
                            <canvas id="interest-chart" height="230"></canvas>
                            <?php
                                $interest = "";
                                $i=0; 
                                $total = 0;
                            foreach($averageInterest as $avg){
                                $total += $avg;
                            }
                            foreach($averageInterest as $avg){
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
            <div class="col-xl-4 mb-xl-0">
                <div class="card bg-white">
                    <div class="card-body">
                        <div class="interest-res">
                            
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
                </div>
            </div>
        </div>
        @else
        <div class="row mt-3">     
            <div class="col-xl-12 mb-xl-0">
                <div class="card bg-white">
                    <div class="card-body">
                        <div style="height: 80pt">
                            <div class="col">
                                <h5 class="card-category pt-0">Interest Inventory Evaluation</h5>
                                <h3 class="card-category">No result found</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row mt-3">
            <div class="col-xl-12 mb-xl-0">
                <div class="card bg-white">
                    <div class="card-header bg-white">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-category">Co-curriculum Merits</h5>
                                <h2 class="card-title mb-0">Performance</h2>
                            </div>
                            <div class="col text-right">
                                <a tabindex="0" role="button" data-trigger="focus" class="btn btn-sm btn-primary" data-placement="left" data-color="primary" id="popover_cocu">See Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="meritadmin">
                            <canvas id="student_merit" width="100" height="100"></canvas>
                        </div>   
                            <!-- javascript -->
                            <script>
                            $(function(){
                                //get the pie chart canvas
                                var cData = JSON.parse(`<?php echo $student_cocumerit; ?>`);
                                var ctx = $("#student_merit");
                            
                                //pie chart data
                                var data = {
                                    labels: ["January","February","March","April","May","June","July","August","September","October","November","December"],
                                    datasets: [
                                    {
                                        data: cData.data,
                                        borderColor : '#BCCEF8',
                                    //   backgroundColor: ['white'],
                                    },
                                    ],
                                };
                            
                                //options
                                var options = {
                                    responsive: true,
                                };
                            
                                //create Pie Chart class object
                                var chart1 = new Chart(ctx, {
                                    type: "line",
                                    data: data,
                                    options: options,
                                });
                            
                            });
                            </script>
                    </div>
                </div>
            </div>
            
            {{-- performance popover --}}
            <div id="cocu-popover" style="display: none;">
                <table class="table align-items-center mb-0">
                    <thead class="bg-secondary">
                        <tr>
                            <th>Year</th>
                            <th>Merit Name</th>
                            <th>Merit Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cocu_records as $cocu_record)
                        <tr>
                            <td>
                                {{$cocu_record->year}}
                            </td>
                            <td>
                                {{$cocu_record->merit_name}}
                            </td>
                            <td class="text-center">
                                {{$cocu_record->merit_point}}
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>

            <script>
                $(function(){
                // Enabling Popover Example 2 - JS (hidden content and title capturing)
                $("#popover_cocu").popover({
                    html : true, 
                    content: function() {
                    return $('#cocu-popover').html();
                    },
                    // title: function() {
                    // return $('#commentPopoverHiddenTitle').html();
                    // }
                });
                });
            </script>
                    
                
        </div>

        <div class="row mt-3">
            <div class="col-xl-12 mb-3 mb-xl-0">
                <div class="card bg-white">
                    <div class="card-header bg-white">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-category">Behaviour Merits and Demerits</h5>
                            </div>
                            <div class="col text-right">
                                <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">

                                    <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                        <input type="radio" class="d-none d-sm-none" name="options" checked>
                                        <a tabindex="1" role="button" data-trigger="focus" class="d-none d-sm-block d-md-block d-lg-block d-xl-block text-white" data-placement="left" data-color="primary" id="popover_behamerit">Merit Details</a>
                                        {{-- <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Merit Details</span> --}}
                                        {{-- <span class="d-block d-sm-none">
                                            <i class="tim-icons icon-single-02"></i>
                                        </span> --}}
                                    </label>
                                    <label class="btn btn-sm btn-primary btn-simple" id="1">
                                        <input type="radio" class="d-none d-sm-none" name="options1">
                                        <a tabindex="2" role="button" data-trigger="focus" class="d-none d-sm-block d-md-block d-lg-block d-xl-block text-white" data-placement="left" data-color="primary" id="popover_behademerit">Demerit Details</a>
                                        {{-- <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Demerit Details</span> --}}
                                        {{-- <span class="d-block d-sm-none">
                                            <i class="tim-icons icon-gift-2"></i>
                                        </span> --}}
                                    </label>
    
                                </div>
                            </div>
                            {{-- <div class="col text-right">
                                <a tabindex="0" role="button" data-trigger="focus" class="btn btn-sm btn-primary" data-placement="left" data-color="primary" id="popover_cocu">See Details</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="meritadmin">
                            <canvas id="student_behaviourmerit" width="100" height="100"></canvas>
                        </div>   
                            <!-- javascript -->
                            <script>
                            $(function(){
                                //get the pie chart canvas
                                var cData = JSON.parse(`<?php echo $student_behaviourmerit; ?>`);
                                var cData2 = JSON.parse(`<?php echo $student_behaviourdemerit; ?>`);
                                var ctx = $("#student_behaviourmerit");
                            
                                //pie chart data
                                var data = {
                                    labels: ["January","February","March","April","May","June","July","August","September","October","November","December"],
                                    datasets: [
                                    {
                                        label: "Merit",
                                        data: cData.data,
                                        borderColor : "#F2D1D1",
                                        backgroundColor: '#F2D1D1',
                                        fill: false,
                                    },
                                    {
                                        label: "Demerit",
                                        data: cData2.data,
                                        borderColor : '#DAEAF1',
                                        backgroundColor: '#DAEAF1',
                                        fill: false
                                    },
                                    ],
                                };
                            
                                //options
                                var options = {
                                    responsive: true,
                                    legend: {
                                    display: true,
                                    position: 'bottom',
                                    }
                                };
                            
                                //create Pie Chart class object
                                var chart1 = new Chart(ctx, {
                                    type: "line",
                                    data: data,
                                    options: options,
                                });
                            
                            });
                            </script>
                    </div>
                </div>
            </div>

            {{-- Behaviour merit popover --}}
            <div id="behavmerit-popover" style="display: none;">
                <table class="table align-items-center table-flush mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Year</th>
                            <th>Merit Name</th>
                            <th>Merit Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($behavmerit_records as $behavmerit_record)
                        <tr>
                            <td>
                                {{$behavmerit_record->year}}
                            </td>
                            <td>
                                {{$behavmerit_record->merit_name}}
                            </td>
                            <td class="text-center">
                                {{$behavmerit_record->merit_point}}
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>

            {{-- Behaviour demerit popover --}}
            <div id="behavdemerit-popover" style="display: none;">
                <table class="table align-items-center table-flush mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Year</th>
                            <th>Merit Name</th>
                            <th>Demerit Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($behavdemerit_records as $behavdemerit_record)
                        <tr>
                            <td>
                                {{$behavdemerit_record->year}}
                            </td>
                            <td>
                                {{$behavdemerit_record->merit_name}}
                            </td>
                            <td class="text-center">
                                {{abs($behavdemerit_record->merit_point)}}
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>

            <script>
                $(function(){
                // Enabling Popover Example 2 - JS (hidden content and title capturing)
                    $("#popover_behamerit").popover({
                        html : true, 
                        content: function() {
                        return $('#behavmerit-popover').html();
                        },
                    });

                });
                $(function(){

                    $("#popover_behademerit").popover({
                        html : true, 
                        content: function() {
                        return $('#behavdemerit-popover').html();
                        },
                    });
                });
            </script>

        </div>

        @include('layouts.footers.auth')
    </div>

    <style>

    .meritadmin
    {
        position: relative;

        height: 180px;
    }
    .pieadmin
    {
        position: relative;

        height: 210px;
    }
    .interest-res
    {
        position: relative;

        height: 270px;
    }
    
    </style>
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
    .chart-area{
        height: 250pt;
    }

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
        width: 150px;
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
        background: #863A6F;
    }

    .html5 .skillbar-bar {
        background: #c26da9;
    }


    .css .skillbar-title {
        background: #997994;
    }

    .css .skillbar-bar {
        background: #D989B5;
    }

    .javascript .skillbar-title {
        background: #e7a5ca;
    }

    .javascript .skillbar-bar {
        background: #f5bdc8;
    }

    .jquery .skillbar-title {
        background: #7F669D;
    }

    .jquery .skillbar-bar {
        background: #9d8cb1;
    }

    .php .skillbar-title {
        background: #FFADBC;
    }

    .php .skillbar-bar {
        background: #f8c4cd;
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

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush