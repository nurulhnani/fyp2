@extends('layouts.app')

@section('content')
    {{-- @include('layouts.headers.cards') --}}
    
    <div class="header bg-gradient-primary pb-5 pt-md-7">
        <div class="container-fluid mt--2">

            <div class="header-body">
                <h3 class="text-white mb-3">{{ __('Welcome to Admin Dashboard!') }}</h3>

                <?php  
                    $news = App\Models\Merit::where('type', '=', 'c')
                    ->leftJoin('students','students.mykid','=','merits.student_mykid')
                    ->leftJoin('classlists','classlists.id','=','students.classlist_id')
                    ->select(App\Models\Merit::raw("COUNT(*) as count"),App\Models\Merit::raw("SUM(merit_point) as merit_point"),App\Models\Merit::raw("merit_name as merit_name"),App\Models\Student::raw("name as name"),App\Models\Classlist::raw("class_name as class_name"))
                    ->groupBy('name','class_name','merit_point','merit_name')
                    ->orderBy('merits.updated_at', 'desc')
                    ->limit(1)
                    ->get();
                    // dd($new);
                ?>

                @foreach($news as $new)
                <div class="alert alert-success" role="alert">
                    <strong>Latest news! {{$new->name}} from {{$new->class_name}} has collected {{$new->merit_point}} merit point from participating in {{$new->merit_name}}</strong>
                </div>
                @endforeach
                
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center mt-2">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Active Students</h5>
                                    </div>
                                </div>
                                <?php $activestudent = App\Models\Student::where('status','=','active')->get(); ?>
                                <p id="student-card" class="h2 font-weight-bold text-center">{{Count($activestudent)}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                            <i class='fas fa-chalkboard-teacher'></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center mt-2">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Active Teachers</h5>
                                    </div>
                                </div>
                                <?php $activeteacher = App\Models\Teacher::where('status','=','active')->get(); ?>
                                <p class="h2 font-weight-bold text-center">{{Count($activeteacher)}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
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
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
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

    <div class="container-fluid mt--4">
        <div class="row">
            <div class="col-xl-3 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-header bg-transparent pt-2 pb-1">
                        <div class="row align-items-center">
                            <div class="col">
                                {{-- <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6> --}}
                                <h4 class="text-default">Active Students</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="pieadmin">
                            {{-- // Chart wrapper --}}
                            <canvas id="student-gender" class="chart-canvas"></canvas>
                        </div>
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
                                    backgroundColor: ['orange','blue'],
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
                                var chart1 = new Chart(ctx, {
                                type: "pie",
                                data: data,
                                options: options,
                                });
                            
                            });
                        </script>
                    </div>
                </div>

                <div class="card bg-white shadow mt-2">
                    <div class="card-header bg-transparent pt-2 pb-1">
                        <div class="row align-items-center">
                            <div class="col">
                                {{-- <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6> --}}
                                <h4 class="text-default">Active Teachers</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="pieadmin">
                            {{-- // Chart wrapper --}}
                            <canvas id="teacher-gender" class="chart-canvas"></canvas>
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
                                    data: cData.data,
                                    backgroundColor: ['orange','blue'],
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
                                var chart1 = new Chart(ctx, {
                                type: "pie",
                                // showInLegend: true, 
                                data: data,
                                options: options,
                                });
                            
                            });
                        </script>
                    </div>
                </div>
            </div>

            {{-- <form action="" method="GET"> --}}
            <div class="col-xl-9 mb-5 mb-xl-0">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                <div class="card bg-white shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="text-default">Students in School</h3>
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
                                <div class="col-sm-9">
                                    <canvas id="student-chart" width="100" height="100"></canvas>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group mt-0">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="grade" name="grade[]" aria-label="Checkbox for following text input" value="1" <?php if(isset($_GET['grade']) && in_array(1,$_GET['grade'])) echo 'checked="checked"'; ?>>
                                        </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="Grade 1">
                                    </div>
        
                                    <div class="input-group mt-1">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="grade" name="grade[]" aria-label="Checkbox for following text input" value="2" <?php if(isset($_GET['grade']) && in_array(2,$_GET['grade'])) echo 'checked="checked"'; ?>>
                                        </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="Grade 2">
                                    </div>
        
                                    <div class="input-group mt-1">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="grade[]" aria-label="Checkbox for following text input" value="3">
                                        </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="Grade 3">
                                    </div>
        
                                    <div class="input-group mt-1">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="grade[]" aria-label="Checkbox for following text input" value="4">
                                        </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="Grade 4">
                                    </div>
        
                                    <div class="input-group mt-1">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="grade[]" aria-label="Checkbox for following text input" value="5">
                                        </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="Grade 5">
                                    </div>
        
                                    <div class="input-group mt-1">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="grade[]" aria-label="Checkbox for following text input" value="6">
                                        </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="Grade 6">
                                    </div>

                                    <div class="text-center pt-2">
                                        <button type="submit" class="btn btn-sm btn-default" name="btnSubmit">Filter</button>
                                        <button type="submit" class="btn btn-sm btn-neutral">Reset</button>
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
                                labels: ["2020","2021","2022"],
                                datasets: [
                                  {
                                    label: "Active",
                                    data: cData.data,
                                    backgroundColor: 'default',
                                  },
                                  {
                                    label: "Inactive",
                                    data: cData2.data,
                                    backgroundColor: 'lightblue',
                                  }
                                ],
                              };
                         
                              //options
                              var options = {
                                responsive: true,
                                // scales: {
                                //     y: [{
                                //         ticks: {
                                //             callback: function(label, index, labels) {
                                //                 return label/1000+'k';
                                //             }
                                //         },
                                //         scaleLabel: {
                                //             display: true,
                                //             labelString: '1k = 1000'
                                //         }
                                //     }],
                                //     x: [{
                                //         ticks: {
                                //             fontColor: "black",
                                //         }
                                //     }]
                                // },
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

                            // function filterData(){
                            //     var grades = document.querySelectorAll('input');
                            //     var grades_array = [...grades]; 
                            //     var array = [];
                            //     grades_array.forEach(grades => {
                            //         if(grades.checked){
                            //             array.push(grades.value);
                            //         }
                            //     });

                            //     const filterresult = student_chart.data.datasets[0].data.filter(value => value);
                            //     console.log(filterresult);
                            // };
                        </script>
                    </div>
                </div>
                </form>

                
            </div>
            {{-- </form> --}}

            {{-- <div class="col-xl-3 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-header bg-transparent pt-2 pb-1">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                <h4 class="text-default">Grade</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="chart" style="height: 300px">
                            // Chart wrapper
                        <form action="#" method="GET">

                            <div class="text-right">
                                <button type="button" class="btn btn-sm btn-default" onclick="filterData()">Filter</button>
                                <button type="button" class="btn btn-sm btn-neutral">Reset</button>
                            </div>

                            <div class="input-group mt-0">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="grade" name="grade" aria-label="Checkbox for following text input" value="Grade 1">
                                </div>
                                </div>
                                <input type="text" class="form-control" aria-label="Text input with checkbox" value="Grade 1">
                            </div>

                            <div class="input-group mt-1">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="grade" name="grade" aria-label="Checkbox for following text input" value="Grade 2">
                                </div>
                                </div>
                                <input type="text" class="form-control" aria-label="Text input with checkbox" value="Grade 2">
                            </div>

                            <div class="input-group mt-1">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" name="grade" aria-label="Checkbox for following text input" value="Grade 3">
                                </div>
                                </div>
                                <input type="text" class="form-control" aria-label="Text input with checkbox" value="Grade 3">
                            </div>

                            <div class="input-group mt-1">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" name="grade" aria-label="Checkbox for following text input" value="Grade 4">
                                </div>
                                </div>
                                <input type="text" class="form-control" aria-label="Text input with checkbox" value="Grade 4">
                            </div>

                            <div class="input-group mt-1">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" name="grade" aria-label="Checkbox for following text input" value="Grade 5">
                                </div>
                                </div>
                                <input type="text" class="form-control" aria-label="Text input with checkbox" value="Grade 5">
                            </div>

                            <div class="input-group mt-1">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" name="grade" aria-label="Checkbox for following text input" value="Grade 6">
                                </div>
                                </div>
                                <input type="text" class="form-control" aria-label="Text input with checkbox" value="Grade 6">
                            </div>

                        <script>
                            function filterData(){
                                var grades = document.querySelectorAll('input');
                                var grades_array = [...grades]; // converts NodeList to Array
                                var array = [];
                                grades_array.forEach(grades => {
                                    if(grades.checked){
                                        array.push(grades.value);
                                    }
                                });

                                const filterresult = student_chart.data.datasets[0].data.filter(value => value > 2);
                                console.log(filterresult);
                            }
                        </script>
                            
                        </form>

                        </div>
                    
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="row mt-3">

            <div class="col-xl-3 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-header bg-transparent pt-2 pb-1">
                        <div class="row align-items-center">
                            <div class="col">
                                {{-- <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6> --}}
                                <h4 class="text-default">Completion of Interest Inventory Evaluation</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2 pb-2">
                        <?php $interestevaluated = App\Models\Interest_Inventory_Results::all()
                                                    ->groupBy('student_id');
                                                     
                        $completion =  (Count($interestevaluated) / Count($activestudent))*100 ;
                        $incomplete = 100 - $completion;
                        ?>

                        <div class="pieadmin">
                            <p class="h3 font-weight-bold"
                                style="width: 100%; height: 100%; position: absolute; top: 60%; left: 0; margin-top: -20px; line-height:19px; text-align: center; z-index: 999999999999999">
                                {{round($completion,0)}}%<Br />
                            </p>
                            <canvas id="interest_eval" width="100" height="100"></canvas>
                        </div>
                        
                        <div class="row">
                            <div class="col text-center mt-2">
                                <h5 class="card-title text-muted mb-0">{{Count($interestevaluated)}} / {{Count($activestudent)}} students</h5>
                            </div>
                        </div>
                          <!-- javascript -->
                         
                           <script>
                          $(function(){
                              //get the pie chart canvas
                            //   var cData = JSON.parse(`<?php echo $interest_eval; ?>`);
                              var ctx = $("#interest_eval");
                         
                              //pie chart data
                              var data = {
                                labels: ['completed','incomplete'],
                                datasets: [
                                  {
                                    // label: "Student",
                                    data: [{{round($completion,0)}}, {{round($incomplete,0)}}],
                                    backgroundColor: ['blue','white'],
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
                </div>

                <div class="card bg-white shadow mt-2">
                    <div class="card-header bg-transparent pt-2 pb-1">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="text-default">Completion of Personality Evaluation</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2 pb-2">

                        <div class="pieadmin">
                            {{-- <p class="h3 font-weight-bold text-default"
                                style="width: 100%; height: 100%; position: absolute; top: 60%; left: 0; margin-top: -20px; line-height:19px; text-align: center; z-index: 999999999999999">
                                {{round($completion,0)}}%<Br />
                            </p> --}}
                            {{-- <p class=" h5 text-muted text-default"
                                style="width: 100%; height: 40px; position: absolute; top: 65%; left: 0; margin-top: -20px; line-height:19px; text-align: center; z-index: 999999999999999">
                                {{Count($interestevaluated)}} / {{Count($activestudent)}} students
                            </p> --}}
                            {{-- <canvas id="personality_eval" width="100" height="100"></canvas> --}}
                        </div> 
                        
                          <!-- javascript -->
                          <script>
                            $(function(){
                                //get the pie chart canvas
                              //   var cData = JSON.parse(`<?php echo $interest_eval; ?>`);
                                var ctx = $("#personality_eval");
                           
                                //pie chart data
                                var data = {
                                  labels: ['completed','incomplete'],
                                  datasets: [
                                    {
                                      // label: "Student",
                                      data: [{{round($completion,2)}}, {{round($incomplete,2)}}],
                                      backgroundColor: [
                                          'rgba(41, 121, 255, 1)',
                                          'rgba(38, 198, 218, 1)',
                                          'rgba(138, 178, 248, 1)',
                                          'rgba(255, 100, 200, 1)',
                                          'rgba(116, 96, 238, 1)',
                                          'rgba(215, 119, 74, 1)',
                                          'rgba(173, 92, 210, 1)',
                                          'rgba(255, 159, 64, 1)',
                                          'rgba(247, 247, 247, 1)',
                                          'rgba(227, 247, 227, 1)',
                                      ],
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

            <div class="col-xl-9 mb-5 mb-xl-0">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                {{-- <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6> --}}
                                <h3 class="text-default mb-0">Teachers in School</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="chartadmin">
                            {{-- // Chart wrapper --}}
                            <div class="row">
                                <div class="col-sm-9 chartadmin"><canvas id="teacher-chart"></canvas></div>
                                <div class="col-sm-3">
                                    <div class="input-group mt-0">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="gender" name="gender[]" aria-label="Checkbox for following text input" value="male" <?php if(isset($_GET['gender']) && in_array("male",$_GET['gender'])) echo 'checked="checked"'; ?>>
                                        </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="Male">
                                        </div>
            
                                        <div class="input-group mt-1">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" id="gender" name="gender[]" aria-label="Checkbox for following text input" value="female" <?php if(isset($_GET['gender']) && in_array("female",$_GET['gender'])) echo 'checked="checked"'; ?>>
                                            </div>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Text input with checkbox" value="Female">
                                        </div>

                                        <div class="text-center pt-2">
                                            <button type="submit" class="btn btn-sm btn-default" name="btnSubmit2">Filter</button>
                                            <button type="submit" class="btn btn-sm btn-neutral">Reset</button>
                                        </div>
                                </div>
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
                                    backgroundColor: 'orange',
                                  },{
                                    label: "Inactive",
                                    data: cData2.data,
                                    backgroundColor: 'red',
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

        </div>

        <div class="row mt-3">
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card bg-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="text-white mb-0">Co-curriculum merit</h3>
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
                                  labels: ['Grade 1','Grade 2','Grade 3','Grade 4','Grade 5','Grade 6'],
                                  datasets: [
                                    {
                                      label: "Co-curriculum",
                                      data: cData.data,
                                      borderColor : 'white',
                                      backgroundColor: ['white'],
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

            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Top 5 Co-curriculum Achievement Ranking</h3>
                            </div>
                            {{-- <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Student name</th>
                                    <th scope="col">Class name</th>
                                    <th scope="col">Merit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $students = App\Models\Merit::where('type', '=', 'c')
                                                ->leftJoin('students','students.mykid','=','merits.student_mykid')
                                                ->leftJoin('classlists','classlists.id','=','students.classlist_id')
                                                ->select(App\Models\Merit::raw("COUNT(*) as count"),App\Models\Merit::raw("SUM(merit_point) as merit_point"),App\Models\Student::raw("name as name"),App\Models\Classlist::raw("class_name as class_name"))
                                                ->groupBy('name','class_name')
                                                ->orderBy('merit_point','DESC')
                                                ->limit(5)
                                                ->get() ;
                                    // dd($students);
                                ?>
                                <?php $index = 1?>
                                @foreach ($students as $student)
                                <tr>
                                    <th scope="row">
                                        {{$index}}
                                    </th>
                                    <td>
                                        {{$student->name}}
                                    </td>
                                    <td>
                                        {{$student->class_name}}
                                    </td>
                                    <td>
                                        {{$student->merit_point}}
                                    </td>
                                </tr>
                                <?php $index++ ?>
                                @endforeach
                                {{-- <tr>
                                    <th scope="row">
                                        /argon/index.html
                                    </th>
                                    <td>
                                        3,985
                                    </td>
                                    <td>
                                        319
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-down text-warning mr-3"></i> 46,53%
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        /argon/charts.html
                                    </th>
                                    <td>
                                        3,513
                                    </td>
                                    <td>
                                        294
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-down text-warning mr-3"></i> 36,49%
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        /argon/tables.html
                                    </th>
                                    <td>
                                        2,050
                                    </td>
                                    <td>
                                        147
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-up text-success mr-3"></i> 50,87%
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        /argon/profile.html
                                    </th>
                                    <td>
                                        1,795
                                    </td>
                                    <td>
                                        190
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-down text-danger mr-3"></i> 46,53%
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-3">

            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card bg-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="text-white mb-0">Behaviour merit & demerit</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="bmerit">
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
                                  labels: ['Grade 1','Grade 2','Grade 3','Grade 4','Grade 5','Grade 6'],
                                  datasets: [
                                    {
                                      label: "Merit",
                                      data: cData.data,
                                      borderColor : 'white',
                                    //   backgroundColor: ['white'],
                                    },
                                    {
                                      label: "Demerit",
                                      data: cData2.data,
                                      borderColor : 'orange',
                                    //   backgroundColor: ['blue'],
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

            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Top 3 Students with Highest Behaviour Merit</h3>
                            </div>
                            {{-- <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Student name</th>
                                    <th scope="col">Class name</th>
                                    <th scope="col">Merit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $students = App\Models\Merit::where('type', '=', 'b')
                                                ->where('merit_point','>','0')
                                                ->leftJoin('students','students.mykid','=','merits.student_mykid')
                                                ->leftJoin('classlists','classlists.id','=','students.classlist_id')
                                                ->select(App\Models\Merit::raw("COUNT(*) as count"),App\Models\Merit::raw("SUM(merit_point) as merit_point"),App\Models\Student::raw("name as name"),App\Models\Classlist::raw("class_name as class_name"))
                                                ->groupBy('name','class_name')
                                                ->orderBy('merit_point','DESC')
                                                ->limit(3)
                                                ->get() ;
                                    // dd($students);
                                ?>
                                <?php $index = 1?>
                                @foreach ($students as $student)
                                <tr>
                                    <th scope="row">
                                        {{$index}}
                                    </th>
                                    <td>
                                        {{$student->name}}
                                    </td>
                                    <td>
                                        {{$student->class_name}}
                                    </td>
                                    <td>
                                        {{$student->merit_point}}
                                    </td>
                                </tr>
                                <?php $index++ ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card shadow mt-2">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Students with Highest Behaviour Demerit</h3>
                            </div>
                            {{-- <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Student name</th>
                                    <th scope="col">Class name</th>
                                    <th scope="col">Demerit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $students = App\Models\Merit::where('type', '=', 'b')
                                                ->where('merit_point','<','0')
                                                ->leftJoin('students','students.mykid','=','merits.student_mykid')
                                                ->leftJoin('classlists','classlists.id','=','students.classlist_id')
                                                ->select(App\Models\Merit::raw("COUNT(*) as count"),App\Models\Merit::raw("SUM(merit_point) as merit_point"),App\Models\Student::raw("name as name"),App\Models\Classlist::raw("class_name as class_name"))
                                                ->groupBy('name','class_name')
                                                ->orderBy('merit_point','ASC')
                                                ->limit(3)
                                                ->get() ;
                                    // dd($students);
                                ?>
                                <?php $index = 1?>
                                @foreach ($students as $student)
                                <tr>
                                    <th scope="row">
                                        {{$index}}
                                    </th>
                                    <td>
                                        {{$student->name}}
                                    </td>
                                    <td>
                                        {{$student->class_name}}
                                    </td>
                                    <td>
                                        {{abs($student->merit_point)}}
                                    </td>
                                </tr>
                                <?php $index++ ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        @include('layouts.footers.auth')
    </div>

    <style>
        .chartadmin
        {
            position: relative;

            height: 327px;
        }

        .pieadmin
        {
            position: relative;

            height: 128px;
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