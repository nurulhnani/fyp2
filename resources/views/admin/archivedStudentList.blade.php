@extends('layouts.adminapp')

@section('content')
    @include('layouts.headers.cards')
    {{-- Header --}}
    <div class="header bg-gradient-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-12 col-12">
                <h6 class="h2 text-white d-inline-block mb-4">Archived Student List</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                      <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}"><i class="fas fa-home"></i></a></li>
                      <li class="breadcrumb-item"><a href="{{route('students.index')}}">Manage Student</a></li>
                      <li class="breadcrumb-item active">Archived Student List</li>
                  </ol>
                </nav> 
              
              </div>
            </div>


            <div class="row align-items-center py-4">
              <div class="col-lg-12 col-12">
                {{-- Search form --}}
              <form class="navbar-search navbar-search-dark form-inline" id="navbar-search-main">
                <div class="form-group">
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
              </form>
              
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
                        <h3 class="mb-0">Archived Student List</h3>
                      </div>
                    <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="myTable">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Mykid</th>
                            <th scope="col">Student Name</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody class="list">
                          @foreach ($students as $student)
                            @if($student->status == 'inactive')
                              <tr>
                                <th scope="row">{{ $student->mykid }}</th>
                                <td id="name">{{ $student->name }}</td>
                                <td style="width: 10%">
                                  <div class="col-lg-6 col-5 text-right mb-0">
                                    <a href="{{route('students.edit',$student->id)}}"><button class="btn btn-sm btn-primary">View</button></a>
                                    <a href="#unarchiveStudent{{$student->id}}" data-toggle="modal"><button class="btn btn-sm btn-primary">Unarchive</button></a>
                                    @include('admin.actionArchiveStudent')
                                  </div>
                                </td>
                                {{-- <td> --}}
                                    {{-- <a href="#" class="btn btn-sm btn-primary">View Profile</a>
                                    <a href="#" class="btn btn-sm btn-primary">Archive Profile</a> --}}
                                    {{-- <div class="col"> --}}
                                        {{-- <ul class="nav nav-pills justify-content-end">
                                            <li class="nav-item mr-2 mr-md-0">
                                                <a href="{{route('students.edit',$student->id)}}" class="nav-link py-1 px-2 active">
                                                    <span class="d-none d-md-block">View</span>
                                                    <span class="d-md-none"><i class="fa fa-user"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item mr-2 mr-md-0">
                                                <a href="#unarchiveModal{{$student->id}}" class="nav-link py-1 px-2 active" data-toggle="modal">
                                                    <span class="d-none d-md-block">Archive</span>
                                                    <span class="d-md-none"><i class="fa fa-eye-slash"></i></span>
                                                </a>
                                            </li> --}}
                                            {{-- <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='' data-prefix="$" data-suffix="k">
                                                <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                                    <span class="d-none d-md-block">Week</span>
                                                    <span class="d-md-none">W</span>
                                                </a>
                                            </li> --}}
                                        {{-- </ul>
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
        
                            @endif 
                          @endforeach
                        </tbody>
                      </table>
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