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
                                    <h5 class="card-title text-uppercase text-muted mb-0">Personality Assessment</h5>
                                    <span class="h2 font-weight-bold mb-0">5</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">in Pending</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Interest Inventory Assessment</h5>
                                    <span class="h2 font-weight-bold mb-0">6</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">in Pending</span>
                            </p>
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
    <div class="row">
        <div class="col">
            <div class="btn-group px-3 pb-3">
                <a type="button" class="button btn btn-secondary btn-sm" style="border-radius: 5px;" href="{{route('teacher.home')}}">My Class</a>
            </div>
            <div class="float-right">
                <button class="btn btn-light btn-sm" type="button">School Overview</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Student Merits and Demerits</h5>
                            <h2 class="card-title">Performance</h2>
                        </div>
                        <div class="col-sm-6">
                            <!-- <div class="btn-group btn-group-toggle float-left" data-toggle="buttons">
                                <label class="btn btn-sm btn-warning btn-simple active" id="0">
                                    <input type="radio" name="options" checked>
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Demerits</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-single-02"></i>
                                    </span>
                                </label>
                            </div> -->
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">

                                <!-- <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                    <input type="radio" name="options" checked>
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Curriculum</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-single-02"></i>
                                    </span>
                                </label>
                                <label class="btn btn-sm btn-primary btn-simple" id="1">
                                    <input type="radio" class="d-none d-sm-none" name="options">
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Behavioural</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-gift-2"></i>
                                    </span>
                                </label> -->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="meritsChart"></canvas>
                    </div>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
                <script>
                    var ctx = document.getElementById("meritsChart").getContext('2d');

                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ["Tokyo", "Mumbai", "Mexico City", "Shanghai", "Sao Paulo", "New York", "Karachi", "Buenos Aires", "Delhi", "Moscow"],
                            datasets: [{
                                    label: 'Series 1', // Name the series
                                    data: [500, 50, 2424, 14040, 14141, 4111, 4544, 47, 5555, 6811], // Specify the data values array
                                    fill: false,
                                    borderColor: '#2196f3', // Add custom color border (Line)
                                    backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
                                    borderWidth: 1 // Specify bar border width
                                },
                                {
                                    label: 'Series 2', // Name the series
                                    data: [1288, 88942, 44545, 7588, 99, 242, 1417, 5504, 75, 457], // Specify the data values array
                                    fill: false,
                                    borderColor: '#4CAF50', // Add custom color border (Line)
                                    backgroundColor: '#4CAF50', // Add custom color background (Points and Fill)
                                    borderWidth: 1 // Specify bar border width
                                }
                            ]
                        },
                        options: {
                            responsive: true, // Instruct chart js to respond nicely.
                            maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
                        }
                    });
                </script>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Sort By Gender</h5>
                    <!-- <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> 763,215</h3> -->
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="extrchart"></canvas>
                        <script>
                            $(function() {
                                var ctx = $("#extrchart");

                                var data = {
                                    labels: ['Male', 'Female'],
                                    datasets: [{
                                        data: [20, 10],
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
                                    type: "pie",
                                    data: data,
                                    options: options,
                                });

                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Sort by Class</h5>
                    <!-- <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> 3,500€</h3> -->
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="intchart"></canvas>
                        <script>
                            $(function() {
                                var ctx = $("#intchart");

                                var data = {
                                    labels: ['1 Amanah', '1 Bestari', '2 Amanah', '2 Bestari', '3 Amanah', '3 Bestari', '4 Amanah'],
                                    datasets: [{
                                        data: [20, 59, 80, 31, 56, 95, 40],
                                        backgroundColor: ['rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(255, 205, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(201, 203, 207, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(255, 159, 64)',
                                            'rgb(255, 205, 86)',
                                            'rgb(75, 192, 192)',
                                            'rgb(54, 162, 235)',
                                            'rgb(153, 102, 255)',
                                            'rgb(201, 203, 207)'
                                        ],
                                        borderWidth: 1
                                    }],
                                };

                                var options = {
                                    scales: {
                                        responsive: true,
                                        y: {
                                            beginAtZero: true
                                        }
                                    },

                                };

                                var chart2 = new Chart(ctx, {
                                    type: "bar",
                                    data: data,
                                    options: options,
                                });

                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-sm">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Sort By Level</h5>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="levelChart"></canvas>
                        <script type="text/javascript">
                            window.onload = function() {
                                var MeSeContext = document.getElementById("levelChart").getContext("2d");
                                var MeSeData = {
                                    labels: [
                                        "International",
                                        "School"
                                    ],
                                    datasets: [{
                                        label: "Test",
                                        data: [100, 75],
                                        backgroundColor: ["#669911", "#119966"],
                                        hoverBackgroundColor: ["#66A2EB", "#FCCE56"]
                                    }]
                                };
                                var MeSeChart = new Chart(MeSeContext, {
                                    type: 'horizontalBar',
                                    data: MeSeData,
                                    options: {
                                        scales: {
                                            xAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }],
                                            yAxes: [{
                                                stacked: true
                                            }]
                                        }
                                    }
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Student Personality</h5>
                            <h2 class="card-title">Big 5 Personality Traits</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center">
                    <div class="chart-area" style="width:150px; height:150px; display: inline-block">
                        <canvas id="chart1"></canvas>
                        <div class="donut-inner">
                            <h5>EXT</h5>
                            <span>(30 / 25 st)</span>
                        </div>
                    </div>
                    <div class="chart-area" style="width:150px; height:150px; display: inline-block">
                        <canvas id="chart2"></canvas>
                        <div class="donut-inner">
                            <h5>OPN</h5>
                            <span>(30 / 25 st)</span>
                        </div>
                    </div>
                    <div class="chart-area" style="width:150px; height:150px; display: inline-block">
                        <canvas id="chart3"></canvas>
                        <div class="donut-inner">
                            <h5>AGB</h5>
                            <span>(30 / 25 st)</span>
                        </div>
                    </div>
                    <div class="chart-area" style="width:150px; height:150px; display: inline-block">
                        <canvas id="chart4"></canvas>
                        <div class="donut-inner">
                            <h5>NTM</h5>
                            <span>(30 / 25 st)</span>
                        </div>
                    </div>
                    <div class="chart-area" style="width:150px; height:150px; display: inline-block">
                        <canvas id="chart5"></canvas>
                        <div class="donut-inner">
                            <h5>CSC</h5>
                            <span>(30 / 25 st)</span>
                        </div>
                    </div>
                </div>
                <script>
                    $(function() {
                        var ctx = $("#chart1");

                        var data = {
                            labels: ['Male', 'Female'],
                            datasets: [{
                                data: [20, 10],
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
                            labels: ['Male', 'Female'],
                            datasets: [{
                                data: [50, 70],
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
                            labels: ['Male', 'Female'],
                            datasets: [{
                                data: [32, 20],
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
                            labels: ['Male', 'Female'],
                            datasets: [{
                                data: [40, 60],
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
                            labels: ['Male', 'Female'],
                            datasets: [{
                                data: [20, 10],
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

    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush

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