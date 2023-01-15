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
    <div class="header pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-12 col-12">
              <h6 class="h2 text-black d-inline-block mb-0">Edit Class</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">Manage Class</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Class</li>
                </ol>
              </nav>
            </div>
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
                        <input class="form-control form-control-alternative" type="text" value="{{$class->class_name}}" id="class_name" name="class_name" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                              <?php $numOfmale =  App\Models\Student::where([
                                                  ['classlist_id','=',$class->id],
                                                  ['gender','=','Male'],
                                                  ])->count(); ?>
                                <label for="maleStudent" class="form-control-label">Male students</label>
                                <input type="text" class="form-control form-control-alternative" name="maleStudent" id="maleStudent" placeholder="No. of male student" value="{{$numOfmale}}" disabled>
                                </div>
                            </div>
                        <div class="col">
                            <div class="form-group">
                              <?php $numOffemale =  App\Models\Student::where([
                                                  ['classlist_id','=',$class->id],
                                                  ['gender','=','Female'],
                                                  ])->count(); ?>
                                <label for="femaleStudent" class="form-control-label">Female students</label>
                                <input type="text" class="form-control form-control-alternative" name="femaleStudent" id="femaleStudent" placeholder="No. of female student" value="{{$numOffemale}}" disabled>
                            </div>
                        </div>
                      </div>
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Classroom Teacher</label>
                        <select class="form-control form-control-alternative" name="classroom_teacher" id="classroom_teacher" required>
                        <?php
                            $classteacher = App\Models\Teacher::where('classlist_id',$class->id)->first();
                        ?>
                            @if(isset($classteacher))
                            <option value="{{$classteacher->name}}" selected>{{$classteacher->name}}</option>
                            @else
                            <option value="" selected>Select Classroom Teacher</option>
                            @endif
                            @foreach($teacher as $teacher)
                            <option value="{{$teacher->name}}">{{$teacher->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <hr class="my-4" />
                    <div class="h5 text-muted text-uppercase mb-4">
                        <i class="ni business_briefcase-24"></i>{{ __('Assign student to class') }}
                    </div>

                    {{-- <div class="">
                        <label><strong>Select Category :</strong></label><br/>
                        <select class="selectpicker">
                          <?php
                              $student = App\Models\Student::all();
                          ?>
                          @foreach ($student as $student)
                            @if($student->status == 'active')
                            <option value="{{$student->name}}">{{$student->name}}</option>
                            @endif
                          @endforeach                        
                        </select>
                    </div> --}}
                    <div class="form-group">
                      <label for="selectstudent" class="form-control-label">Select student by name</label>
                      {{-- <label for="selectstudent">Select student by name</label><br/> --}}
                        <select class="form-control form-control-alternative selectstudent" name="studentInClass[]" id="selectstudent">
                          <?php
                              $student = App\Models\Student::all();
                          ?>
                          @foreach ($student as $student)
                            @if($student->status == 'active')
                            <option value="{{$student->id}}">{{$student->name}}</option>
                            @endif
                          @endforeach                        
                        </select>
                        <input type="hidden" name="classid" class="classid" value="{{$class->id}}">
                    </div>
                    <script>
                      $('.selectstudent').select2({
                        placeholder: 'Select student',
                        multiple: true
                      });

                      var classid = $(".classid").val();
                      console.log(classid);
                      $.get("{{ url('getStudent') }}/" + classid, function(data) {
                          $('.selectstudent').html(classid);
                      });

                      // var selected = $('.selectstudent').val();
                      // console.log(selected);
                    </script>

                    <div class="form-group">
                        <label for="example-email-input" class="form-control-label">Current students in class</label>
                        {{-- <input class="form-control form-control-alternative" placeholder="Search" type="search" id="searchStd" onkeyup="myFunction()"> --}}
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="myTable">
                                <thead class="thead-light">
                                    <tr>
                                    <th scope="col" style="width: 30%">Mykid</th>
                                    <th scope="col" style="width: 50%">Student name</th>
                                    <th scope="col" style="width: 20%"></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php $index = 1; ?>
                                    <?php
                                        $student = App\Models\Student::all();
                                    ?>
                                    @foreach ($student as $student)
                                    @if($student->status == 'active' && $student->classlist_id == $class->id)
                                      <tr>
                                        <td scope="row" style="width: 30%">{{ $student->mykid }}</td>  
                                        <td scope="row" style="width: 50%">{{ $student->name }}</td>                 
                                        <td class="text-right" style="width: 20%">
                                          <div class="text-right">
                                            <a href="#removeStudent{{$student->id}}" data-toggle="modal">
                                            <button class="btn btn-sm btn-primary"><i class="fa fa-trash"></i></button>
                                            </a>
                                            @include('classes.removestudentaction')
                                          </div>
                                          
                                            {{-- <div class="custom-control custom-checkbox nopadding">
                                                <input type="checkbox" class="custom-control-input" name="checklist[]" value="{{ $student->id }}" id="customCheck<?php echo $index ?>">
                                                <label class="custom-control-label" for="customCheck<?php echo $index ?>"></label>
                                            </div> --}}
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
                            <form method="" action="" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="custom-file">
                                    <label for="example-url-input" class="form-control-label">Upload Student List</label>
                                        <!-- <input type="file" class="custom-file-input" id="customFileLang" lang="en">
                                        <label class="custom-file-label" for="customFileLang">Select file</label> -->
                                    <div class="mb-3">
                                        <input class="form-control form-control-alternative" type="file" name="file" id="file">
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

{{-- @push('page_script')
<script>
  $('.selectstudent').select2({
    placeholder: 'Select an option'
  });
</script>
@endpush --}}