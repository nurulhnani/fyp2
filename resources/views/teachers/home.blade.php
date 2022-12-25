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
            <div class="dropdown">
                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    My Class
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Curriculum Merit</a>
                    <a class="dropdown-item" href="#">Behavioural Merit</a>
                    <a class="dropdown-item" href="#">Personality and Interest</a>
                </div>
            </div>            </div>
            <div class="float-right">
                <a class="button btn btn-light btn-sm" href="{{route('teacher.home2')}}">School Overview</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Curriculum Merits</h5>
                            <h2 class="card-title">Performance</h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
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
                    <h5 class="card-category">Sort by Level</h5>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="levelChart"></canvas>
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
                        <canvas id="levelChart"></canvas> -->
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
    <!-- </div>
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