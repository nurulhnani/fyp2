@extends('layouts.studentapp')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--2">
    
        <h4 class="mt-4 heading-small text-muted">WELCOME TO STUDENT DASHBOARD!</h4>

        {{-- <div class="card"> --}}
            {{-- <div class="card-body"> --}}
                {{-- <p>Below are the records of Co-curriculum merits, Behaviour merits, and Behaviour demerits for this student:</p> --}}
                {{-- <form>
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="example-text-input" class="form-control-label">Student Name</label>
                        </div>
                        <div class="col-sm-10">
                            <p class="mb-0">{{$student->name}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="example-text-input" class="form-control-label">Class Name</label>
                        </div>
                        <div class="col-sm-10">
                            <p class="mb-0">{{$student->class->class_name}}</p>
                        </div>
                    </div>
                </form> --}}

                <div class="row mt-0">
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
                                          labels: cData.label,
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
                                          labels: cData.label,
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
    
    </style>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush