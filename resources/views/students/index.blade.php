@extends('layouts.adminapp')

@section('content')
    {{-- Header --}}
    @include('layouts.headers.cards')
    <!-- Header -->
    <div class="header">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-black d-inline-block mb-0">Manage Student</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Manage Student</li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <form class="navbar-search navbar-search-white form-inline" id="navbar-search-main">
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
              </form>

            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{route('students.create')}}" class="btn btn-sm btn-neutral">
                <span class="d-none d-md-block">Add New Student</span>
                <span class="d-md-none"><i class="fa fa-plus"></i></span>
              </a>
              <a href="{{route('archivedStudentList')}}" class="btn btn-sm btn-neutral">
                <span class="d-none d-md-block">Archived student list</span>
                <span class="d-md-none"><i class="fa fa-eye-slash"></i></span>
              </a>
            </div>
          </div>
        </div>
      </div>
  </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Student List</h3>
                    </div>
                    <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="myTable">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Mykid</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Class Name</th>
                            <th scope="col" style="width: 10%"></th>
                          </tr>
                        </thead>
                        <tbody class="list">
                          @foreach ($students as $student)
                            @if($student->status == 'active')
                              <tr>
                                <th scope="row">{{ $student->mykid }}</th>
                                <td id="name">{{ $student->name }}</td>
                                @if(isset($student->class->class_name))
                                  <td id="class_name">{{ $student->class->class_name }}</td>
                                @else 
                                  <td id="class_name">Not Yet Assigned</td>
                                @endif
                                <td style="width: 10%">
                                  <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                      <a class="dropdown-item" href="{{route('students.edit',$student->id)}}">Edit Student Profile</a>
                                      <a class="dropdown-item" href="#archiveModal{{$student->id}}" data-toggle="modal">Archive Student Profile</a>
                                    </div>
                                    @include('students.studentaction')
                                  </div>
                                </td>
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
                    <div class="card-footer py-4">
                      <nav aria-label="...">
                        <ul class="pagination justify-content-end mb-0">
                          {{$students->links()}}
                        </ul>
                      </nav>
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