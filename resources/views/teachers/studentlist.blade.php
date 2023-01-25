@extends('layouts.teacherapp')

@section('content')
{{-- Header --}}
@include('layouts.headers.cards')
<!-- Header -->
<div class="header pb-5">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-7 col-7">
          <h6 class="h2 d-inline-block mb-4">View Student Profile</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4 mb-3">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Student List</li>
              {{-- <li class="breadcrumb-item active" aria-current="page">Interest Inventory</li> --}}
            </ol>
          </nav>
          <!-- <form class="navbar-search navbar-search-white form-inline mb-4" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="search" id="searchStd" onkeyup="myFunction()">
              </div>
            </div>
          </form> -->

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
          <h3 class="mb-0">List of Students</h3>
        </div>

        <form action="{{url('/studentlist/search')}}" method="post" role="search">
          @csrf
          <div class="row py-3 mx-3" style="position:absolute;right:0;top:0;">
            <div class="col md-6">
              <select class="form-control" name="class" id="class-dd" required>
                <option selected disabled hidden>Choose Class...</option>
                @foreach ($classes as $class)
                <option value="{{$class->id}}">{{$class->class_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col md-6">
              <div class="input-group">
                <input id="input-name" name="search" type="text" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <button type="submit" class="btn btn-outline-primary"> <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </form>


        <div class="table-responsive pt-3">
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
                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="{{route('editstudent',$student->id)}}">Personal Details</a>
                      <a class="dropdown-item" href="{{route('studentoverview',$student->id)}}">Student Overview</a>
                    </div>
                  </div>
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
          <div class="d-flex">
            <div class="mx-auto">
              {{ $students->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('layouts.footers.auth')
</div>
<!-- autocomplete -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
  var route = "{{ url('autocomplete-search') }}";
  $('#input-name').typeahead({
    source: function(query, process) {
      return $.get(route, {
        query: query
      }, function(data) {
        return process(data);
      });
    }
  });
</script>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush