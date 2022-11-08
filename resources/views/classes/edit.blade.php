@extends('layouts.adminapp')

@section('content')
    @include('layouts.headers.cards')

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Header --}}
    <div class="header bg-gradient-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-4">Edit Class</h6>
              </div>
              {{-- <div class="col-lg-6 col-5 text-right mb-4">
                <a href="{{route('students.create')}}" class="btn btn-sm btn-neutral">Add New Student</a>
              </div> --}}
            </div>
          </div>
        </div>
      </div>

    <div class="container-fluid mt--7 justify-content-center"> 

        <div class="card bg-secondary shadow">
            <div class="card-body">

                <form action="{{ route('classes.update',$class->id) }}" method="POST" enctype='multipart/form-data'>
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Class Name</label>
                        <input class="form-control form-control-alternative" type="text" value="{{$class->class_name}}" id="class_name" name="class_name">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="maleStudent" class="form-control-label">Male students</label>
                                <input type="text" class="form-control form-control-alternative" name="maleStudent" id="maleStudent" placeholder="No. of male student" value="{{$class->maleStudent}}">
                                </div>
                            </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="femaleStudent" class="form-control-label">Female students</label>
                                <input type="text" class="form-control form-control-alternative" name="femaleStudent" id="femaleStudent" placeholder="No. of female student" value="{{$class->femaleStudent}}">
                            </div>
                        </div>
                      </div>
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Classroom Teacher</label>
                        {{-- <input class="form-control" type="search" value="Tell me your secret ..." id="example-search-input"> --}}
                        <select class="form-control form-control-alternative" name="classroom_teacher" id="classroom_teacher">
                        <?php
                            $classteacher = App\Models\Teacher::where('classlist_id',$class->id)->first()->name;
                        ?>
                            <option value="{{$classteacher}}" selected>{{$classteacher}}</option>
                            @foreach($teacher as $teacher)
                            <option value="{{$teacher->name}}">{{$teacher->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <hr class="my-4" />
                    <div class="h5 text-muted text-uppercase mb-4">
                        <i class="ni business_briefcase-24"></i>{{ __('Assign student to class') }}
                    </div>


                    <div class="form-group">
                        <label for="example-email-input" class="form-control-label">Select student by name</label>
                        <input class="form-control" placeholder="Search" type="search" id="searchStd" onkeyup="myFunction()">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="myTable">
                                <thead class="thead-light">
                                    <tr>
                                    <th scope="col">Student name</th>
                                    <th scope="col">Mykid</th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php $index = 1; ?>
                                    <?php
                                        $student = App\Models\Student::all();
                                    ?>
                                    @foreach ($student as $student)
                                    @if($student->status == 'active')
                                      <tr>
                                        <td scope="row">{{ $student->name }}</td>                
                                        <td scope="row">{{ $student->mykid }}</td>   
                                        <td class="text-right">
                                            <div class="custom-control custom-checkbox nopadding">
                                                <input type="checkbox" class="custom-control-input" name="checklist[]" value="{{ $student->id }}" id="customCheck<?php echo $index ?>">
                                                <label class="custom-control-label" for="customCheck<?php echo $index ?>"></label>
                                            </div>
                                        </td>
                                        <style>
                                            .nopadding {
                                                padding: 0 !important;
                                                margin: 0 !important;
                                            }
                                            #myTable {
                                                border-collapse: collapse;
                                                /* Collapse borders */
                                                width: 100%;
                                                /* Full-width */
                                                border: 1px solid #ddd;
                                                /* Add a grey border */
                                                font-size: 18px;
                                                /* Increase font-size */
                                            }

                                            #myTable th,
                                            #myTable td {
                                                text-align: left;
                                                /* Left-align text */
                                                padding: 12px;
                                                /* Add padding */
                                            }

                                            #myTable tr {
                                                /* Add a bottom border to all table rows */
                                                border-bottom: 1px solid #ddd;
                                            }

                                            #myTable tr.header,
                                            #myTable tr:hover {
                                                /* Add a grey background color to the table header and on hover */
                                                background-color: #f1f1f1;
                                            }
                                        </style>
                                      </tr>
                
                                      <script>
                                        function myFunction() {
                                          // Declare variables
                                          var input, filter, table, tr, td, i, txtValue;
                                          input = document.getElementById("searchStd");
                                          filter = input.value.toUpperCase();
                                          table = document.getElementById("myTable");
                                          tr = table.getElementsByTagName("tr");
                                        
                                          // Loop through all table rows, and hide those who don't match the search query
                                          for (i = 0; i < tr.length; i++) {
                                            td = tr[i].getElementsByTagName("td")[0];
                                            if (td) {
                                              txtValue = td.textContent || td.innerText;
                                              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                tr[i].style.display = "";
                                              } else {
                                                tr[i].style.display = "none";
                                              }
                                            }
                                          }
                                        }
                                      </script>
                
                                        <script>
                                        function searchFilter(){
                                          var input, filter, table, tr, td, i;
                                          input = document.getElementById("filterByClass");
                                          filter = input.value.toUpperCase();
                                          table = document.getElementById("myTable");
                                          tr = table.getElementsByTagName("tr");
                                          for (i = 0; i < tr.length; i++) {
                                            td = tr[i].getElementsByTagName("td")[1];
                                            if (td) {
                                              if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                                tr[i].style.display = "";
                                              } else {
                                                tr[i].style.display = "none";
                                              }
                                            }       
                                          }
                                        }
                                        function resetTable(){
                                          var input = document.getElementById("filterByClass");
                                          input.value = '';
                                          searchFilter();
                                        }
                                        </script>
                
                                    @endif 
                                    <?php $index++; ?>
                                  @endforeach
                                </tbody>
                                </table>
                            </div>
                    </div>

                    <h5 class="text-muted text-center my-2">OR</h5>

                    <div class="form-group dropzone dropzone-single" data-toggle="dropzone" data-dropzone-url="http://">
                        <div class="fallback">
                            <form method="post" action="{{ route('file-import') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="custom-file">
                                    <label for="example-url-input" class="form-control-label">Upload Student List</label>
                                        <!-- <input type="file" class="custom-file-input" id="customFileLang" lang="en">
                                        <label class="custom-file-label" for="customFileLang">Select file</label> -->
                                    <div class="mb-3">
                                        <input class="form-control" type="file" name="file" id="file">
                                    </div>
                                </div>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="example-url-input" class="form-control-label">Upload Student List</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFileLang" lang="en">
                            <label class="custom-file-label" for="customFileLang">Select file</label>
                        </div>
                    </div> --}}
                 
                    <div class="text-center py-2">
                        <button type="submit" class="btn btn-success ml-auto">Submit</button>
                    </div>
                </form>
                

            

            </div>
        </div>
                                    
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush