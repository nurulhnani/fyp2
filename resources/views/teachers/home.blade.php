@extends('layouts.teacherapp')

@section('content')
@include('layouts.headers.cards')

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
                    <div class="chart-area" style="width:150px; height:150px; display: inline-block"">
                        <canvas id=" chart5"></canvas>
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

    <!--Tasks-->
    <div class="row">
        <div class="col-lg-6 col-md-42">
            <div class="card card-tasks">
                <div class="card-header ">
                    <h6 class="title d-inline">Tasks(5)</h6>
                    <p class="card-category d-inline">today</p>
                    <div class="dropdown">
                        <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                            <i class="tim-icons icon-settings-gear-63"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#pablo">Action</a>
                            <a class="dropdown-item" href="#pablo">Another action</a>
                            <a class="dropdown-item" href="#pablo">Something else</a>
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Update the Documentation</p>
                                        <p class="text-muted">Dwuamish Head, Seattle, WA 8:47 AM</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">GDPR Compliance</p>
                                        <p class="text-muted">The GDPR is a regulation that requires businesses to protect the personal data and privacy of Europe citizens for transactions that occur within EU member states.</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Solve the issues</p>
                                        <p class="text-muted">Fifty percent of all respondents said they would be more likely to shop at a company </p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Release v2.0.0</p>
                                        <p class="text-muted">Ra Ave SW, Seattle, WA 98116, SUA 11:19 AM</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Export the processed files</p>
                                        <p class="text-muted">The report also shows that consumers will not easily forgive a company once a breach exposing their personal data occurs. </p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Arival at export process</p>
                                        <p class="text-muted">Capitol Hill, Seattle, WA 12:34 AM</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-42">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Simple Table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Country
                                    </th>
                                    <th>
                                        City
                                    </th>
                                    <th class="text-center">
                                        Salary
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Dakota Rice
                                    </td>
                                    <td>
                                        Niger
                                    </td>
                                    <td>
                                        Oud-Turnhout
                                    </td>
                                    <td class="text-center">
                                        $36,738
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Minerva Hooper
                                    </td>
                                    <td>
                                        Curaçao
                                    </td>
                                    <td>
                                        Sinaai-Waas
                                    </td>
                                    <td class="text-center">
                                        $23,789
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Sage Rodriguez
                                    </td>
                                    <td>
                                        Netherlands
                                    </td>
                                    <td>
                                        Baileux
                                    </td>
                                    <td class="text-center">
                                        $56,142
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Philip Chaney
                                    </td>
                                    <td>
                                        Korea, South
                                    </td>
                                    <td>
                                        Overland Park
                                    </td>
                                    <td class="text-center">
                                        $38,735
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Doris Greene
                                    </td>
                                    <td>
                                        Malawi
                                    </td>
                                    <td>
                                        Feldkirchen in Kärnten
                                    </td>
                                    <td class="text-center">
                                        $63,542
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Mason Porter
                                    </td>
                                    <td>
                                        Chile
                                    </td>
                                    <td>
                                        Gloucester
                                    </td>
                                    <td class="text-center">
                                        $78,615
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Jon Porter
                                    </td>
                                    <td>
                                        Portugal
                                    </td>
                                    <td>
                                        Gloucester
                                    </td>
                                    <td class="text-center">
                                        $98,615
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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