@extends('layouts.adminapp')

@section('content')
    @include('layouts.headers.cards')
    {{-- Header --}}
    <div class="header">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-black d-inline-block mb-0">Manage Teacher</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Manage Teacher</li>
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
              <a href="{{route('teachers.create')}}" class="btn btn-sm btn-neutral">Add New Teacher</a>
              <a href="{{route('archivedTeacherList')}}" class="btn btn-sm btn-neutral">Archived teacher list</a>
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
                      <h3 class="mb-0">Teacher List</h3>
                    </div>
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush" id="myTable">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">NRIC</th>
                          <th scope="col">Teacher Name</th>
                          <th scope="col">Email</th>
                          <th scope="col" style="width: 10%"></th>
                        </tr>
                      </thead>
                      <tbody class="list">
                        @foreach ($teachers as $teacher)
                          @if($teacher->status == 'active')
                            <tr>
                              <th scope="row">{{ $teacher->nric }}</th>
                              <td id="name">{{ $teacher->name }}</td>
                              <td id="class">{{ $teacher->email }}</td>
                              <td style="width: 10%">
                                <div class="dropdown">
                                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="{{route('teachers.edit',$teacher->id)}}">Edit Teacher Profile</a>
                                    <a class="dropdown-item" href="#archiveModal{{$teacher->id}}" data-toggle="modal">Archive Teacher Profile</a>
                                  </div>
                                  @include('teachers.teacheraction')
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
                          {{-- @empty
                          <p>No teacher found</p> --}}
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer py-4">
                    <nav aria-label="...">
                      <ul class="pagination justify-content-end mb-0">
                        {{$teachers->links()}}
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