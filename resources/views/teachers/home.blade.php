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
                                <span class="text-nowrap">Still in Pending</span>
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
                                <span class="text-nowrap">Still in Pending</span>
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
        <div class="btn-group px-3 py-3">
            <button class="btn btn-secondary btn-sm" type="button">Overall in School</button>
            <button type="button" class="btn btn-light btn-sm" style="border-radius: 5px;">My Class</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Student Merits</h5>
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

                                <label class="btn btn-sm btn-primary btn-simple active" id="0">
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
                                </label>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="meritsChart"></canvas>
                    </div>
                </div>
                <script>
                    $(function() {
                        var ctx = $("#meritsChart");

                        var data = {
                            labels: ['January', 'February', 'March', 'April', 'May', 'Jun', 'July'],
                            datasets: [{
                                data: [20, 59, 80, 31, 56, 95, 40],
                                fill: false,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.1
                            }],
                        };

                        var options = {
                            responsive: true,
                        };

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