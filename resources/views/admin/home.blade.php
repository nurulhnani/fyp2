@extends('layouts.adminapp')

@section('content')
    {{-- @include('layouts.headers.cards') --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <div class="header bg-gradient-primary pb-5 pt-md-5">
        <div class="container-fluid mt--2">
            
            <div class="row mb-2">
                <div class="col">
                    <h3 class="mt-4 heading-small text-white">WELCOME TO ADMIN DASHBOARD!</h3>
                </div>
                
            </div>

             <!--Filter Modal -->
        <div class="modal fade" id="filterByYear" tabindex="-1" role="dialog" aria-labelledby="archiveModal" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                    @csrf
                    @method('PUT')
                <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Filter Dashboard By Year</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body text-center">
                    @foreach($years as $year)
                        <?php $newyear = (string)$year;?>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="{{$newyear}}" name="year[]" value="{{$newyear}}">
                            <label class="custom-control-label" for="{{$newyear}}">{{$newyear}}</label>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" >Reset</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
                </form>
            </div>
            </div>
        </div>

            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body bg-admingreen pb-0">
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="icon icon-shape bg-gradient-adminpurple text-creme rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center mt-2">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Active Students</h5>
                                    </div>
                                </div>
                                {{-- <?php $activestudent = App\Models\Student::where('status','=','active')->count(); ?> --}}
                                <p id="student-card" class="h2 font-weight-bold text-center">{{$activestudent}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="icon icon-shape bg-gradient-adminpurple text-creme rounded-circle shadow">
                                            <i class='fas fa-chalkboard-teacher'></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center mt-2">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Active Teachers</h5>
                                    </div>
                                </div>
                                <?php $activeteacher = App\Models\Teacher::where('status','=','active')->count(); ?>
                                <p class="h2 font-weight-bold text-center">{{$activeteacher}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body bg-admingreen pb-0">
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="icon icon-shape bg-gradient-adminpurple text-creme rounded-circle shadow">
                                            <i class='fas fa-shapes'></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center mt-2">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Classes</h5>
                                    </div>
                                </div>
                                <?php $classes = App\Models\Classlist::all(); ?>
                                <p class="h2 font-weight-bold text-center">{{Count($classes)}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="icon icon-shape bg-gradient-adminpurple text-creme rounded-circle shadow">
                                            <i class="fa fa-book"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center mt-2">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Subjects</h5>
                                    </div>
                                </div>
                                <?php $subjects = App\Models\Subject::all(); ?>
                                <p class="h2 font-weight-bold text-center">{{Count($subjects)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container-fluid mt-5">

        <div class="row pb-3">
            <div class="col">
                <div class="float-right">
                    <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#filterByYear">Filter <i class="fa fa-filter" aria-hidden="true"></i></button>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="text-default">Statistics</h4>
                                <h5 class="card-category">System visits by users</h5>
                            </div>
                            <div class="col text-right">
                                <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">

                                    <label class="btn btn-sm bg-admingreen btn-simple active" id="0">
                                        <input type="radio" class="d-none d-sm-none" name="options" checked>
                                        <a tabindex="1" role="button" data-trigger="focus" class="d-none d-sm-block d-md-block d-lg-block d-xl-block text-adminpurple" data-placement="left" data-color="primary" id="popover_teacherlogin">Teacher</a>
                                    </label>
                                    <label class="btn btn-sm bg-adminpurple btn-simple" id="1">
                                        <input type="radio" class="d-none d-sm-none" name="options1">
                                        <a tabindex="2" role="button" data-trigger="focus" class="d-none d-sm-block d-md-block d-lg-block d-xl-block text-creme" data-placement="left" data-color="primary" id="popover_studentlogin">Student</a>
                                    </label>
    
                                </div>
                            </div>


                            {{-- Teacher login popover --}}
                            <div id="teacherlogin-popover" style="display: none;">
                                <h5 class="card-category pt-2">Top 5 Teachers with Highest System Visits</h5>
                                <table class="table align-items-center table-flush mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            {{-- <th>Month</th> --}}
                                            <th>Teacher Name</th>
                                            <th>Num of Visits</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teacherlogin as $teacherlogin)
                                        <tr>
                                            <td>
                                                {{$teacherlogin->name}}
                                            </td>
                                            <td class="text-center">
                                                {{$teacherlogin->count}}
                                            </td>
                                            {{-- <td class="text-center">
                                                {{$behavmerit_record->merit_point}}
                                            </td> --}}
                                        </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>

                            {{-- Student login popover --}}
                            <div id="studentlogin-popover" style="display: none;">
                                <h5 class="card-category pt-2">Top 5 Students with Highest System Visits</h5>
                                <table class="table align-items-center table-flush mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            {{-- <th>Month</th> --}}
                                            <th>Student Name</th>
                                            <th>Num of Visits</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($studentlogin as $studentlogin)
                                        <tr>
                                            <td>
                                                {{$studentlogin->name}}
                                            </td>
                                            <td class="text-center">
                                                {{$studentlogin->count}}
                                            </td>
                                            {{-- <td class="text-center">
                                                {{$behavmerit_record->merit_point}}
                                            </td> --}}
                                        </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>

                            <script>
                                $(function(){
                                // Enabling Popover Example 2 - JS (hidden content and title capturing)
                                    $("#popover_teacherlogin").popover({
                                        html : true, 
                                        content: function() {
                                        return $('#teacherlogin-popover').html();
                                        },
                                    });
        
                                });
                                $(function(){
        
                                    $("#popover_studentlogin").popover({
                                        html : true, 
                                        content: function() {
                                        return $('#studentlogin-popover').html();
                                        },
                                    });
                                });
                            </script>
                    
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="chartadmin">
                            {{-- // Chart wrapper --}}
                                <canvas id="login-chart"></canvas>
                        </div>

                        </div>
                          <!-- javascript -->
                         
                           <script>
                          $(function(){
                              //get the pie chart canvas
                              var cData = JSON.parse(`<?php echo $teacher_login_counts; ?>`);
                              var cData2 = JSON.parse(`<?php echo $student_login_counts; ?>`);
                              var ctx = $("#login-chart");
                         
                              //pie chart data
                              var data = {
                                labels: ["January","February","March","April","May","June","July","August","September","October","November","December"],
                                datasets: [
                                  {
                                    label:'Teacher',
                                    data: cData.data,
                                    backgroundColor: '#f590e7',
                                    borderColor: '#f590e7',
                                    fill: false,
                                  },{
                                    label:'Student',
                                    data: cData2.data,
                                    backgroundColor: '#BEAEE2',
                                    borderColor: '#BEAEE2',
                                    fill: false,
                                  }
                                ],
                              };
                         
                              //options
                              var options = {
                                responsive: true,
                                legend: {
                                    display: true,
                                    position: 'bottom',
                                    labels: {
                                        fontColor: "#000080",
                                    }
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

        <div class="row mt-3">
            <div class="col-xl-3 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-header bg-transparent pt-2 pb-1">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-category">Active Students</h4>
                                {{-- <div class="col text-right pt-0">
                                    <div class="icon icon-shape text-transparent">
                                        <i class="fa fa-male" style="font-size:20px"></i>
                                        <i class="fa fa-female" style="font-size:20px"></i>
                                    </div>                              
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="pieadmin">
                                    {{-- // Chart wrapper --}}
                                    <canvas id="student-gender"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 mb-0">
                            <div class="col-sm-5">
                                <?php 
                                    $malepercent = round(($malestudent/$activestudent)*100,0)
                                ?>
                                <div class="progress bg-white shadow-none">
                                    <div class="progress-bar bg-adminpurple" role="progressbar" aria-valuenow="{{$malepercent}}"
                                    aria-valuemin="0" aria-valuemax="100" style="width:{{$malepercent}}%">
                                    </div>
                                </div>
                                <h5 class="text-muted mb-0">Male</h5>
                                <h4 class="text-default mt-0">{{$malepercent}}%</h4>
                            </div>

                            <div class="col-sm-1"><div class="vl"></div></div>
                            
                            <div class="col-sm-5 text-right">
                                <?php 
                                    $femalepercent = round(($femalestudent/$activestudent)*100,0);
                                    $todisplay = 100 - $femalepercent; 
                                ?>
                                <div class="progress bg-admingreen shadow-none">
                                  <div class="progress-bar bg-white" role="progressbar" aria-valuenow="{{$todisplay}}"
                                  aria-valuemin="0" aria-valuemax="100" style="width:{{$todisplay}}%">
                                  </div>
                                </div>
                                
                                <h5 class="text-muted mb-0">Female</h5>
                                <h4 class="text-default mt-0">{{$femalepercent}}%</h4>
                            </div>
                        </div>

                        <style>
                        .vl {
                            border-left: 1px solid gainsboro;
                            height: 70px;
                        }
                        </style>
            
                            <!-- javascript -->
                            
                        <script>
                            $(function(){
                            //get the pie chart canvas
                            var cData = JSON.parse(`<?php echo $student_gender; ?>`);
                            var ctx = $("#student-gender");
                        
                            //pie chart data
                            var data = {
                            labels: cData.label,
                            datasets: [
                                {
                                // label: "Male",
                                data: cData.data,
                                backgroundColor: ['#E7FBBE','#BEAEE2'],
                                }
                            ],
                            };
                        
                            //options
                            var options = {
                                responsive: true,
                                // legend: {
                                //     display: true,
                                //     position: 'bottom',
                                //     textAlign: 'center',
                                //     labels: {
                                //         fontColor: "#000080",
                                //     }
                                // },
                                
                            };
                        
                            //create Pie Chart class object
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

            <div class="col-xl-9 mb-5 mb-xl-0">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                <div class="card bg-white shadow">
                    <div class="card-header bg-transparent pt-2 pb-1">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="text-default">Students in School</h4>
                            </div>
                            {{-- <div class="col">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-sm btn-default" onclick="">Filter</button>
                                    <button type="submit" class="btn btn-sm btn-neutral">Reset</button>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="chartadmin">
                            {{-- // Chart wrapper --}}
                            <div class="row">
                                <div class="col-sm-9 chartadmin">
                                    <canvas id="student-chart"></canvas>
                                </div>
                                <div class="col-sm-3 text-right chartadmin">

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="grade1" name="grade[]" value="1" <?php if(isset($_GET['grade']) && in_array(1,$_GET['grade'])) echo 'checked="checked"'; ?>>
                                        <label class="custom-control-label" for="grade1">Grade 1</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-1">
                                        <input type="checkbox" class="custom-control-input" id="grade2" name="grade[]" value="2" <?php if(isset($_GET['grade']) && in_array(2,$_GET['grade'])) echo 'checked="checked"'; ?>>
                                        <label class="custom-control-label" for="grade2">Grade 2</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-1">
                                        <input type="checkbox" class="custom-control-input" id="grade3" name="grade[]" value="3" <?php if(isset($_GET['grade']) && in_array(3,$_GET['grade'])) echo 'checked="checked"'; ?>>
                                        <label class="custom-control-label" for="grade3">Grade 3</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-1">
                                        <input type="checkbox" class="custom-control-input" id="grade4" name="grade[]" value="4" <?php if(isset($_GET['grade']) && in_array(4,$_GET['grade'])) echo 'checked="checked"'; ?>>
                                        <label class="custom-control-label" for="grade4">Grade 4</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-1">
                                        <input type="checkbox" class="custom-control-input" id="grade5" name="grade[]" value="5" <?php if(isset($_GET['grade']) && in_array(5,$_GET['grade'])) echo 'checked="checked"'; ?>>
                                        <label class="custom-control-label" for="grade5">Grade 5</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-1">
                                        <input type="checkbox" class="custom-control-input" id="grade6" name="grade[]" value="6" <?php if(isset($_GET['grade']) && in_array(6,$_GET['grade'])) echo 'checked="checked"'; ?>>
                                        <label class="custom-control-label" for="grade6">Grade 6</label>
                                    </div>

                                    <div class="text-right pt-2">
                                        <button type="submit" class="btn btn-sm bg-adminpurple text-creme" name="btnSubmit">Filter</button>
                                    </div>

                                </div>
                            </div>
                           
                        </div>
                          <!-- javascript -->
                         
                           <script>
                          $(function(){
                              //get the pie chart canvas
                              var cData = JSON.parse(`<?php echo $chart_student; ?>`);
                              var cData2 = JSON.parse(`<?php echo $chart_studentinactive; ?>`);
                              var ctx = $("#student-chart");
                         
                              //pie chart data
                              var data = {
                                labels: cData.label,
                                datasets: [
                                  {
                                    label: "Active",
                                    data: cData.data,
                                    backgroundColor: '#f590e7',
                                    borderColor: '#f590e7'
                                  },
                                  {
                                    label: "Inactive",
                                    data: cData2.data,
                                    backgroundColor: '#E7FBBE',
                                    borderColor:'#E7FBBE'
                                  }
                                ],
                              };
                         
                              //options
                              var options = {
                                responsive: true,
                                legend: {
                                    display: true,
                                    position: 'bottom',
                                    labels: {
                                        fontColor: "#000080",
                                    }
                                },
                              };
                         
                              //create Pie Chart class object
                              var student_chart = new Chart(ctx, {
                                type: "bar",
                                data: data,
                                options: options,
                              });
                         
                          });
                        </script>
                    </div>
                </div>
                </form>

                
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-xl-3 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-header bg-transparent pt-2 pb-1">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="text-default">Active Teachers</h4>
                                {{-- <div class="col text-right pt-0">
                                    <div class="icon icon-shape text-transparent">
                                        <i class="fa fa-male" style="font-size:20px"></i>
                                        <i class="fa fa-female" style="font-size:20px"></i>
                                    </div>                              
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="pieadmin">
                                    {{-- // Chart wrapper --}}
                                    <canvas id="teacher-gender"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 mb-0">
                            <div class="col-sm-5">
                                <?php 
                                    $tmalepercent = round(($maleteacher/$activeteacher)*100,0)
                                ?>
                                <div class="progress bg-white shadow-none">
                                    <div class="progress-bar bg-admingreen" role="progressbar" aria-valuenow="{{$tmalepercent}}"
                                    aria-valuemin="0" aria-valuemax="100" style="width:{{$tmalepercent}}%">
                                    </div>
                                </div>
                                <h5 class="text-muted mb-0">Male</h5>
                                <h4 class="text-default mt-0">{{$tmalepercent}}%</h4>
                            </div>

                            <div class="col-sm-1"><div class="vl"></div></div>
                            
                            <div class="col-sm-5 text-right">
                                <?php 
                                    $tfemalepercent = round(($femaleteacher/$activeteacher)*100,0);
                                    $todisplayt = 100 - $tfemalepercent; 
                                ?>
                                <div class="progress bg-adminpink shadow-none">
                                  <div class="progress-bar bg-white" role="progressbar" aria-valuenow="{{$todisplayt}}"
                                  aria-valuemin="0" aria-valuemax="100" style="width:{{$todisplayt}}%">
                                  </div>
                                </div>
                                
                                <h5 class="text-muted mb-0">Female</h5>
                                <h4 class="text-default mt-0">{{$tfemalepercent}}%</h4>
                            </div>
                        </div>

            
                            <!-- javascript -->
                            
                        <script>
                            $(function(){
                            //get the pie chart canvas
                            var cData = JSON.parse(`<?php echo $teacher_gender; ?>`);
                            var ctx = $("#teacher-gender");
                        
                            //pie chart data
                            var data = {
                            labels: cData.label,
                            datasets: [
                                {
                                // label: "Male",
                                data: cData.data,
                                backgroundColor: ['#f590e7','#E7FBBE'],
                                }
                            ],
                            };
                        
                            //options
                            var options = {
                                responsive: true,
                                // legend: {
                                //     display: true,
                                //     position: 'bottom',
                                //     // textAlign: 'center',
                                //     labels: {
                                //         fontColor: "#000080",
                                //     }
                                // },
                                
                            };
                        
                            //create Pie Chart class object
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

            <div class="col-xl-9 mb-5 mb-xl-0">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                <div class="card shadow">
                    <div class="card-header bg-transparent pt-2 pb-1">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="text-default">Teachers in School</h4>
                            </div>
                            {{-- <div class="col">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-sm btn-default" onclick="">Filter</button>
                                    <button type="submit" class="btn btn-sm btn-neutral">Reset</button>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="chartadmin">
                            {{-- // Chart wrapper --}}
                                <canvas id="teacher-chart"></canvas>
                        </div>

                        </div>
                          <!-- javascript -->
                         
                           <script>
                          $(function(){
                              //get the pie chart canvas
                              var cData = JSON.parse(`<?php echo $chart_teacher; ?>`);
                              var cData2 = JSON.parse(`<?php echo $chart_teacherinactive; ?>`);
                              var ctx = $("#teacher-chart");
                         
                              //pie chart data
                              var data = {
                                labels: cData.label,
                                datasets: [
                                  {
                                    label: "Active",
                                    data: cData.data,
                                    backgroundColor: '#BEAEE2',
                                    borderColor: '#BEAEE2'
                                  },{
                                    label: "Inactive",
                                    data: cData2.data,
                                    backgroundColor: '#E7FBBE',
                                    borderColor: '#E7FBBE'
                                  }
                                ],
                              };
                         
                              //options
                              var options = {
                                responsive: true,
                                legend: {
                                    display: true,
                                    position: 'bottom',
                                    labels: {
                                        fontColor: "#000080",
                                    }
                                }
                              };
                         
                              //create Pie Chart class object
                              var chart1 = new Chart(ctx, {
                                type: "bar",
                                data: data,
                                options: options,
                              });
                         
                          });
                        </script>
                    </div>
                </div>
                </form>
                
            </div>    
        
        <div class="row mt-3">
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-header bg-transparent pt-2 pb-1">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="text-default">Completion of Interest Inventory Evaluation</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2 pb-2">

                        <div class="pieadmin">
                            <p class="h3 font-weight-bold"
                                style="width: 100%; height: 100%; position: absolute; top: 60%; left: 0; margin-top: -20px; line-height:19px; text-align: center; z-index: 999999999999999">
                                {{round($interestcompletion,0)}}%<Br />
                            </p>
                            <canvas id="interest_eval" width="100" height="100"></canvas>
                        </div>
                        
                        <div class="row">
                            <div class="col text-center mt-2">
                                <h5 class="card-title text-muted mb-0">{{Count($interestevaluated)}} / {{$activestudent}} students</h5>
                            </div>
                        </div>
                          <!-- javascript -->
                         
                           <script>
                          $(function(){
                              var ctx = $("#interest_eval");
                         
                              var data = {
                                labels: ['completed','incomplete'],
                                datasets: [
                                  {
                                    data: [{{round($interestcompletion,0)}}, {{round($interestincomplete,0)}}],
                                    backgroundColor: ['#f590e7','white'],
                                  }
                                ],
                              };
                         
                              var options = {
                                responsive: true,
                                maintainAspectRatio: false,
                                cutoutPercentage: 80,
                                tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                    return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + '%';
                                    }
                                }
                                }
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

            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-header bg-transparent pt-2 pb-1">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="text-default">Completion of Personality Evaluation</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2 pb-2">
                        <div class="pieadmin">
                            <p class="h3 font-weight-bold text-default"
                                style="width: 100%; height: 100%; position: absolute; top: 60%; left: 0; margin-top: -20px; line-height:19px; text-align: center; z-index: 999999999999999">
                                {{round($persocompletion,0)}}%<Br />
                            </p>
                            <canvas id="personality_eval" width="100" height="100"></canvas>
                        </div> 

                        <div class="row">
                            <div class="col text-center mt-2">
                                <h5 class="card-title text-muted mb-0">{{Count($personalityevaluated)}} / {{$activestudent}} students</h5>
                            </div>
                        </div>
                        
                          <!-- javascript -->
                          <script>
                            $(function(){
                                //get the pie chart canvas
                                var ctx = $("#personality_eval");
                           
                                //pie chart data
                                var data = {
                                  labels: ['completed','incomplete'],
                                  datasets: [
                                    {
                                      // label: "Student",
                                      data: [{{round($persocompletion,2)}}, {{round($persoincomplete,2)}}],
                                      backgroundColor: ['#f590e7','white'],
                                    }
                                  ],
                                };
                           
                                //options
                                var options = {
                                  responsive: true,
                                  maintainAspectRatio: false,
                                  cutoutPercentage: 80,
                                  tooltips: {
                                  callbacks: {
                                      label: function(tooltipItem, data) {
                                      return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + '%';
                                      }
                                  }
                                  }
                                };
                           
                                //create Pie Chart class object
                                var chart1 = new Chart(ctx, {
                                  type: "doughnut",
                                  data: data,
                                  options: options,
                                });
                           
                            });
                          </script>
                    </div>

                    {{-- <p class="h5 text-muted text-default"
                            style="width: 100%; height: 40px; position: absolute; top: 65%; left: 0; margin-top: -20px; line-height:19px; text-align: center; z-index: 999999999999999">
                            {{Count($interestevaluated)}} / {{Count($activestudent)}} students
                    </p>   --}}
                </div>
            </div>
        </div>
        
        

        @include('layouts.footers.auth')
    </div>

    <style>
        .bg-adminpurple{
            background-color: #BEAEE2;
        }
        .bg-admindarkpurple{
            background-color: #85586F;
        }
        .bg-gradient-adminpurple{
            background: linear-gradient(87deg, #BEAEE2 0, #f590e7 100%) !important;
        }
        .bg-admingreen{
            background-color: #E7FBBE;
        }
        .bg-adminpink{
            background-color: #f590e7;
        }
        .bg-admincreme{
            background-color: #f5cd96;
        }
        .text-creme{
            color: #F9F9F9;
        }
        .text-adminpink{
            color: #f590e7;
        }
        .text-adminpurple{
            color: #85586F;
        }
        /* .text-admindarkpurple{
            color: #85586F;
        } */
        .btn-admingreen{
            background-color: #CDF0EA;
        }
        .chartadmin
        {
            position: relative;

            height: 240px;
        }

        #pieadmin
        {
            position: relative;

            height: 165px;
        }

        .meritadmin
        {
            position: relative;

            height: 255px;
        }

        .bmerit
        {
            position: relative;

            height: 425px;
        }

    </style>


@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush