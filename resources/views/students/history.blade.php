@extends('layouts.studentapp')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--2">
    
        <h2 class="mt-4">History</h2>

        <div class="card">
            <div class="card-body">
                <p>Below are the records of Co-curriculum merits, Behaviour merits, and Behaviour demerits for this student:</p>
                <form>
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="example-text-input" class="form-control-label">Student Name</label>
                        </div>
                        <div class="col-sm-10">
                            <p class="mb-0">{{$student->name}}</p>
                            {{-- <input class="form-control form-control-sm" type="text" value="{{$student->name}}" disabled> --}}
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
                </form>

                <div class="row mt-3">
                    <div class="col-xl-6 mb-3 mb-xl-0">
                        <div class="card bg-secondary">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="text-default mb-0">Co-curriculum merits</h3>
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
                                              borderColor : 'grey',
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

                    <div class="col-sm-6">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0">Co-curriculum merits records</h3>
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
                                            <th scope="col">Year</th>
                                            <th scope="col">Merit Name</th>
                                            <th scope="col" style="width: 5%">Merit Point</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <?php $index = 0?> --}}
                                        @foreach ($cocu_records as $cocu_record)
                                        <tr>
                                            {{-- <th scope="row">
                                                {{$index}}
                                            </th> --}}
                                            <td>
                                                {{$cocu_record->year}}
                                            </td>
                                            <td>
                                                {{$cocu_record->merit_name}}
                                            </td>
                                            <td class="text-center" style="width: 5%">
                                                {{$cocu_record->merit_point}}
                                            </td>
                                        </tr>
                                        {{-- <?php $index++ ?> --}}
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <nav aria-label="...">
                                  <ul class="pagination justify-content-end mb-0 mt-0">
                                    {{$cocu_records->links()}}
                                  </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-xl-6 mb-3 mb-xl-0">
                        <div class="card bg-secondary">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="text-default mb-0">Behaviour merits and demerits</h3>
                                    </div>
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
                                              borderColor : 'grey',
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
                                          legend: {
                                            display: true,
                                            position: 'bottom',
                                            // labels: {
                                            //     fontColor: "#000080",
                                            // }
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

                    <div class="col-sm-6">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0">Co-curriculum merits records</h3>
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
                                            <th scope="col">Year</th>
                                            <th scope="col">Merit Name</th>
                                            <th scope="col" style="width: 5%">Merit Point</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <?php $index = 0?> --}}
                                        @foreach ($cocu_records as $cocu_record)
                                        <tr>
                                            {{-- <th scope="row">
                                                {{$index}}
                                            </th> --}}
                                            <td>
                                                {{$cocu_record->year}}
                                            </td>
                                            <td>
                                                {{$cocu_record->merit_name}}
                                            </td>
                                            <td class="text-center" style="width: 5%">
                                                {{$cocu_record->merit_point}}
                                            </td>
                                        </tr>
                                        {{-- <?php $index++ ?> --}}
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <nav aria-label="...">
                                  <ul class="pagination justify-content-end mb-0 mt-0">
                                    {{$cocu_records->links()}}
                                  </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

    <style>

    .meritadmin
        {
            position: relative;

            height: 280px;
        }
    
    </style>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush