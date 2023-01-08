@extends('layouts.teacherapp')

@section('content')

<div class="header bg-gradient-primary pb-5 pt-md-7">
    <div class="container-fluid mt--2">

        <h3 class="text-white mb-3">Welcome back {{auth()->user()->name}}!</h3>
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Personality Assessment in Pending</h5>
                                    <span class="h2 font-weight-bold mb-0"> {{ $pendingPersonality }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Interest Inventory Assessment in Pending</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $pendingInterest }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>
<!-- Header -->
<div class="header pb-5">
    <div class="container-fluid">
        <div class="header-body">
        </div>
    </div>
</div>
<div class="container-fluid mt--2">
    <div class="row pb-3">
        <div class="col">
            <div class="float-right">
                <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target=".bd-example-modal-sm">Filter <i class="fa fa-filter" aria-hidden="true"></i></button>
                </button>
            </div>
        </div>
    </div>
    <!-- Merit and Demerit -->
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="card-category">Student Merits and Demerits</h5>
                            <h3 class="mb-0">Performance</h3>
                        </div>
                    </div>
                </div>
                <div class="card card-chart">
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="behaMeritsChart"></canvas>
                        </div>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
                    <script>
                        var ctx = document.getElementById("behaMeritsChart").getContext('2d');

                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ["January", "February", "March", "April", "May", "Jun", "July", "August", "September", "October", "November", "December"],
                                datasets: [{
                                        label: 'Curriculum Merit', 
                                        data: <?php echo json_encode(array_values($currMeritsArr)); ?>, 
                                        fill: false,
                                        borderColor: '#2196f3', 
                                        backgroundColor: '#2196f3', 
                                        borderWidth: 1 
                                    },
                                    {
                                        label: 'Behavioural Merit', 
                                        data: <?php echo json_encode(array_values($behaMeritsArr)); ?>, 
                                        fill: false,
                                        borderColor: '#4CAF50', 
                                        backgroundColor: '#4CAF50', 
                                        borderWidth: 1 
                                    },
                                    {
                                        label: 'Behavioural Demerit', 
                                        data: <?php echo json_encode(array_values($behaDemeritsArr)); ?>, 
                                        fill: false,
                                        borderColor: '#4CAF50', 
                                        backgroundColor: '#4CAF50', 
                                        borderWidth: 1 
                                    }
                                ]
                            },
                            options: {
                                responsive: true, 
                                maintainAspectRatio: false, 
                                legend: {
                                    display: true,
                                    position: 'bottom',
                                },
                                scales: {
                                    xAxes: [{
                                        gridLines: {
                                            display: false
                                        }
                                    }],
                                    yAxes: [{
                                        ticks: {
                                            // stepSize: 1
                                            beginAtZero: true
                                        },
                                        gridLines: {
                                            display: false
                                        }
                                    }]
                                },
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card shadow pb-2">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Performance By Class</h3>
                        </div>
                    </div>
                </div>
                <div class="card card-chart">
                    <div class="card-body">
                        <canvas id="densityChart"></canvas>
                    </div>

                    <script>
                        var densityCanvas = document.getElementById("densityChart");

                        Chart.defaults.global.defaultFontFamily = "Open Sans, sans-serif";
                        Chart.defaults.global.defaultFontSize = 12;

                        var densityData = {
                            label: 'Merit',
                            data: <?php echo json_encode(array_values($classMeritsArr)); ?>,
                            backgroundColor: 'rgba(0, 99, 132, 0.6)',
                            borderColor: 'rgba(0, 99, 132, 1)',
                        };

                        var gravityData = {
                            label: 'Demerit',
                            data: <?php echo json_encode(array_values($classDemeritsArr)); ?>,
                            backgroundColor: 'rgba(99, 132, 0, 0.6)',
                            borderColor: 'rgba(99, 132, 0, 1)',
                        };

                        var planetData = {
                            labels: <?php echo json_encode(array_keys($classMeritsArr)); ?>,
                            datasets: [densityData, gravityData]
                        };

                        var chartOptions = {
                            scales: {
                                xAxes: [{
                                    barPercentage: 1,
                                    categoryPercentage: 0.6,
                                    gridLines: {
                                        display: false
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    },
                                    gridLines: {
                                        display: false
                                    }
                                }]
                            },
                            legend: {
                                display: true,
                                position: 'bottom',
                            }
                        };

                        var barChart = new Chart(densityCanvas, {
                            type: 'bar',
                            data: planetData,
                            options: chartOptions
                        });
                    </script>

                </div>

            </div>
        </div>
        <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Top Merit Contributers</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Merit</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topMeritArr as $topMerit)
                            <tr>
                                <th scope="row">
                                    {{ $topMerit->student->name }}
                                </th>
                                <td>
                                    <i class="fas fa-plus text-success mr-2"></i>{{ $topMerit->merit_point }} pts
                                </td>
                                <td>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Top Demerit Contributers</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Demerit</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topDemeritArr as $topDemerit)
                            <tr>
                                <th scope="row">
                                    {{ $topDemerit->student->name }}
                                </th>
                                <td>
                                    <i class="fas fa-minus text-danger mr-2"></i>{{ $topDemerit->merit_point }} pts
                                </td>
                                <td>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="card-category">Student Evaluation</h5>
                            <h3 class="mb-0">Personality Traits</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center">
                    <div class="chart-area" style="width:130px; height:130px; display: inline-block">
                        <canvas id="chart1"></canvas>
                        <div class="donut-inner">
                            <h5 style="color:white">EXT</h5>
                            <span><i>Extraversion</i></span>
                        </div>
                    </div>
                    <div class="chart-area" style="width:130px; height:130px; display: inline-block">
                        <canvas id="chart2"></canvas>
                        <div class="donut-inner">
                            <h5 style="color:white">OPN</h5>
                            <span><i>Agreeableness</i></span>
                        </div>
                    </div>
                    <div class="chart-area" style="width:130px; height:130px; display: inline-block">
                        <canvas id="chart3"></canvas>
                        <div class="donut-inner">
                            <h5 style="color:white">AGB</h5>
                            <span><i>Neuroticism</i></span>
                        </div>
                    </div>
                    <div class="chart-area" style="width:130px; height:130px; display: inline-block">
                        <canvas id="chart4"></canvas>
                        <div class="donut-inner">
                            <h5 style="color:white">NTM</h5>
                            <span><i>Conscientiousness</i></span>
                        </div>
                    </div>
                    <div class="chart-area" style="width:130px; height:130px; display: inline-block">
                        <canvas id="chart5"></canvas>
                        <div class="donut-inner">
                            <h5 style="color:white">CSC</h5>
                            <span><i>Openness</i></span>
                        </div>
                    </div>
                </div>
                <script>
                    $(function() {
                        var ctx = $("#chart1");

                        var data = {
                            labels: <?php echo json_encode(array_keys($Extraversion)); ?>,
                            datasets: [{
                                data: <?php echo json_encode(array_values($Extraversion)); ?>,
                                backgroundColor: ['rgb(255, 99, 132)',
                                    'rgb(255, 205, 86)'
                                ],
                                hoverOffset: 4
                            }],
                        };

                        var options = {
                            responsive: true,
                        };

                        var chart1 = new Chart(ctx, {
                            type: "doughnut",
                            data: data,
                            options: options,
                        });

                    });
                </script>

                <script>
                    $(function() {
                        var ctx = $("#chart2");

                        var data = {
                            labels: <?php echo json_encode(array_keys($Agreeableness)); ?>,
                            datasets: [{
                                data: <?php echo json_encode(array_values($Agreeableness)); ?>,
                                backgroundColor: ['rgb(255, 99, 132)',
                                    'rgb(255, 205, 86)'
                                ],
                                hoverOffset: 4
                            }],
                        };

                        var options = {
                            responsive: true,
                        };

                        var chart1 = new Chart(ctx, {
                            type: "doughnut",
                            data: data,
                            options: options,
                        });

                    });
                </script>

                <script>
                    $(function() {
                        var ctx = $("#chart3");

                        var data = {
                            labels: <?php echo json_encode(array_keys($Neuroticism)); ?>,
                            datasets: [{
                                data: <?php echo json_encode(array_values($Neuroticism)); ?>,
                                backgroundColor: ['rgb(255, 99, 132)',
                                    'rgb(255, 205, 86)'
                                ],
                                hoverOffset: 4
                            }],
                        };

                        var options = {
                            responsive: true,
                        };

                        var chart1 = new Chart(ctx, {
                            type: "doughnut",
                            data: data,
                            options: options,
                        });

                    });
                </script>

                <script>
                    $(function() {
                        var ctx = $("#chart4");

                        var data = {
                            labels: <?php echo json_encode(array_keys($Conscientiousness)); ?>,
                            datasets: [{
                                data: <?php echo json_encode(array_values($Conscientiousness)); ?>,
                                backgroundColor: ['rgb(255, 99, 132)',
                                    'rgb(255, 205, 86)'
                                ],
                                hoverOffset: 4
                            }],
                        };

                        var options = {
                            responsive: true,
                        };

                        var chart1 = new Chart(ctx, {
                            type: "doughnut",
                            data: data,
                            options: options,
                        });

                    });
                </script>

                <script>
                    $(function() {
                        var ctx = $("#chart5");

                        var data = {
                            labels: <?php echo json_encode(array_keys($Openness)); ?>,
                            datasets: [{
                                data: <?php echo json_encode(array_values($Openness)); ?>,
                                backgroundColor: ['rgb(255, 99, 132)',
                                    'rgb(255, 205, 86)'
                                ],
                                hoverOffset: 4
                            }],
                        };

                        var options = {
                            responsive: true,
                        };

                        var chart1 = new Chart(ctx, {
                            type: "doughnut",
                            data: data,
                            options: options,
                        });

                    });
                </script>
            </div>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Interest Inventory</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center">
                    <canvas id="interest-chart" height="230"></canvas>
                    <?php
                    $interest = "";
                    $i = 0;
                    $total = 0;
                    foreach ($InterestResultArr as $avg) {
                        $total += $avg;
                    }
                    foreach ($InterestResultArr as $avg) {
                        if ($total != 0) {
                            if ($i == 0) {
                                $interest = round(($avg / $total) * 100, 0);
                            } else {
                                $interest .= ", " . round(($avg / $total) * 100, 0);
                            }
                        }
                        $i++;
                    }
                    ?>
                    <input type="hidden" id="0" value="{{$interest}}">
                </div>

                <script>
                    $(function() {
                        obj = document.getElementById('0').value.replace(" ", "").split(',');
                        var ctx = $("#interest-chart");

                        var data = {
                            labels: ["Realistic", "Investigative", "Artistic", "Social", "Enterprising", "Conventional"],
                            datasets: [{
                                indexAxis: 'y',
                                data: obj,
                                backgroundColor: ['#540375', '#BA94D1', '#863A6F', '#DEBACE', '#C060A1', '#D989B5'],
                            }],
                        };

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

                        var chart1 = new Chart(ctx, {
                            type: "horizontalBar",
                            data: data,
                            options: options,
                        });

                    });
                </script>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection

<!-- Filter Modal -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                    <div class="form-row">
                        <label style="font-size:14px" for="inputCity">Class</label>
                        <select id="inputState" class="form-control custom-select" name="class">
                            <option value="" selected disabled hidden>Choose...</option>
                            @foreach ($classes as $class)
                            <option value="<?php echo $class->id ?>">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row pt-3">
                        <label style="font-size:14px" for="inputState">Year</label>
                        <select id="inputState" class="form-control custom-select" name="year">
                            <option value="" selected disabled hidden>Choose...</option>
                            @foreach ($years as $index => $year)
                            <option value="<?php echo $year ?>">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <button type="submit" class="btn btn-sm btn-secondary float-right mt-3">School Overview</button> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>

        </div>
    </div>
</div>
</div>

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>
    $(function() {
        $(".ddl-select").each(function() {
            $(this).hide();
            var $select = $(this);
            var _id = $(this).attr("id");
            var wrapper = document.createElement("div");
            wrapper.setAttribute("class", "ddl ddl_" + _id);

            var input = document.createElement("input");
            input.setAttribute("type", "text");
            input.setAttribute("class", "ddl-input");
            input.setAttribute("id", "ddl_" + _id);
            input.setAttribute("readonly", "readonly");
            input.setAttribute(
                "placeholder",
                $(this)[0].options[$(this)[0].selectedIndex].innerText
            );

            $(this).before(wrapper);
            var $ddl = $(".ddl_" + _id);
            $ddl.append(input);
            $ddl.append("<div class='ddl-options ddl-options-" + _id + "'></div>");
            var $ddl_input = $("#ddl_" + _id);
            var $ops_list = $(".ddl-options-" + _id);
            var $ops = $(this)[0].options;
            for (var i = 0; i < $ops.length; i++) {
                $ops_list.append(
                    "<div data-value='" +
                    $ops[i].value +
                    "'>" +
                    $ops[i].innerText +
                    "</div>"
                );
            }

            $ddl_input.click(function() {
                $ddl.toggleClass("active");
            });
            $ddl_input.blur(function() {
                $ddl.removeClass("active");
            });
            $ops_list.find("div").click(function() {
                $select.val($(this).data("value")).trigger("change");
                $ddl_input.val($(this).text());
                $ddl.removeClass("active");
            });
        });
    });
</script>

<style>
    .card {
        margin-bottom: 10px;
    }

    .donut-inner {
        margin-top: -100px;
        margin-bottom: 100px;
    }

    .donut-inner h5 {
        margin-bottom: 5px;
        margin-top: 0;
    }

    .donut-inner span {
        font-size: 12px;
    }
</style>