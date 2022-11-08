@extends('layouts.adminapp')

@section('content')
    @include('layouts.headers.cards')
    {{-- Header --}}
    <div class="header bg-gradient-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                {{-- <h6 class="h2 text-white d-inline-block mb-4">Manage Class</h6> --}}
                <form class="navbar-search navbar-search-dark form-inline mr-sm-3" id="navbar-search-main">
                  <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                      </div>
                      <input class="form-control" placeholder="Search" type="search" id="searchStd" onkeyup="myFunction()">
                    </div>
                  </div>
                  {{-- <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button> --}}
                  <div class="nav-item d-sm-none">
                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                      <i class="ni ni-zoom-split-in"></i>
                    </a>
                  </div>
                </form>
                {{-- <a href="" class="btn btn-sm btn-neutral">
                  <span class="d-none d-md-block">Add New Student</span>
                  <span class="d-md-none"><i class="fa fa-plus"></i></span>
                </a> --}}
              </div>
              <div class="col-lg-6 col-5 text-right">
                <a href="#AddNewClass" data-toggle="modal" class="btn btn-sm btn-neutral">Add New Class</a>
                {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Class List</h3>
                      </div>
                    <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="myTable">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col" style="width: 10%">Class name</th>
                            <th scope="col" class="text-center">Num of Student</th>
                            <th scope="col">Classroom teacher</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody class="list">
                          @foreach ($classes as $class)
                            {{-- @if($student->status == 'active') --}}
                              <tr>
                                <th scope="row" style="width: 10%">{{ $class->class_name }}</th>
                                <?php
                                  $totalStudent = (int)$class->maleStudent + (int)$class->femaleStudent;
                                ?>
                                <td id="name" class="text-center"><?php echo $totalStudent ?></td>
                                <?php
                                  $classteacher = App\Models\Teacher::where('classlist_id',$class->id)->first()->name;
                                ?>
                                @if(isset($classteacher))
                                  <td id="class">{{ $classteacher }}</td>
                                @else 
                                  <td id="class">Not Assigned Yet</td>
                                @endif                        
                                <td style="width: 10%">
                                  <div class="col-lg-6 col-5 text-right mb-0">
                                    <a href="#viewClass{{$class->id}}" data-toggle="modal">
                                      <button class="btn btn-sm btn-primary"><i class="fa fa-address-book"></i></button>
                                      {{-- <span class="d-none d-md-block"><i class="fa fa-address-book"></i></span>
                                      <span class="d-md-none"><i class="fa fa-address-book"></i></span> --}}
                                    </a>
                                    <a href="{{route('classes.edit',$class->id)}}">
                                      <button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                                      {{-- <span class="d-none d-md-block"><i class="fa fa-address-book"></i></span>
                                      <span class="d-md-none"><i class="fa fa-address-book"></i></span> --}}
                                    </a>
                                    <a href="#delete{{$class->id}}" data-toggle="modal">
                                      <button class="btn btn-sm btn-primary"><i class="fa fa-trash"></i></button>
                                      {{-- <span class="d-none d-md-block"><i class="fa fa-address-book"></i></span>
                                      <span class="d-md-none"><i class="fa fa-address-book"></i></span> --}}
                                    </a>
                                    @include('classes.classaction')
                                  </div>
                                </td>
                                {{-- <td>
                                        <ul class="nav nav-pills justify-content-end">
                                            <li class="nav-item mr-2 mr-md-0">
                                                <a href="#viewClass{{$class->id}}" class="nav-link py-1 px-2 active" data-toggle="modal">
                                                    <span class="d-none d-md-block"><i class="fa fa-address-book"></i></span>
                                                    <span class="d-md-none"><i class="fa fa-address-book"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item mr-2 mr-md-0">
                                                <a href="#editClass{{$class->id}}" class="nav-link py-1 px-2 active" data-toggle="modal">
                                                    <span class="d-none d-md-block"><i class="fa fa-edit" aria-hidden="true"></i></span>
                                                    <span class="d-md-none"><i class="fa fa-edit" aria-hidden="true"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item mr-2 mr-md-0">
                                                <a href="#delete{{$class->id}}" class="nav-link py-1 px-2 active" data-toggle="modal">
                                                    <span class="d-none d-md-block"><i class="fa fa-trash"></i></span>
                                                    <span class="d-md-none"><i class="fa fa-trash"></i></span>
                                                </a>
                                            </li>
                                            @include('classes.classaction')

                                        </ul>
                                    </div>
                                </td> --}}
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
        
                            {{-- @endif  --}}
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
            </div> 

        </div>
  
        
  <!--Add New Class Modal -->
  <div class="modal fade" id="AddNewClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Class</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('classes.store')}}" method="POST" id="addClassModal">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="class_name" class="form-control-label">Class Name</label>
                  <input type="text" class="form-control form-control-alternative" name="class_name" id="class_name" placeholder="Enter Class Name" value="">
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col">
                <div class="form-group">
                  <label for="maleStudent" class="form-control-label">Male students</label>
                  <input type="text" class="form-control form-control-alternative" name="maleStudent" id="maleStudent" placeholder="No. of male student" value="">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="femaleStudent" class="form-control-label">Female students</label>
                  <input type="text" class="form-control form-control-alternative" name="femaleStudent" id="femaleStudent" placeholder="No. of female student" value="">
                </div>
              </div>
            </div>
            <div class="w-100"></div>
            <div class="row">
              <div class="col">
              <div class="form-group">
                <label for="classroom_teacher" class="form-control-label" >Classroom Teacher</label>
                    <select class="form-control form-control-alternative" name="classroom_teacher" id="classroom_teacher">
                        <option value="" selected>Search by Teacher Name</option>
                        @foreach($teacher as $teacher)
                        @if($teacher->classlist_id == null)
                          <option value="{{$teacher->name}}">{{$teacher->name}}</option>
                        @endif
                        @endforeach
                    </select>
              </div> 
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
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