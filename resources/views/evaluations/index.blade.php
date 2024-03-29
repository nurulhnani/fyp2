@extends('layouts.teacherapp')

@section('content')
@include('layouts.headers.cards')
<!-- Header -->
<div class="header pb-5">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-12 col-7">
          <h6 class="h2 text-black d-inline-block mb-0">Evaluation Page</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Student List</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row pb-4 px-3">
        <!--- Navigation -->
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Personality Assessment</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Interest Inventory Assessment</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">

      <div class="tab-content" id="pills-tabContent">

        <!-- Personality Tab content -->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Personality Assessment</h3>
            </div>

            <form action="{{url('/studentlist-evaluation/search')}}" method="post" role="search">
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

            <!-- Light table -->
            <div class="table-responsive pt-3">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">NAME</th>
                    <th scope="col" class="sort" data-sort="budget">CLASS</th>
                    <th scope="col" class="sort" data-sort="status">STATUS</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">

                  @foreach ($students as $student)
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $student->name }}</span>
                        </div>
                      </div>
                    </th>
                    @if(isset($student->class->class_name))
                    <td class="budget">
                      {{ $student->class->class_name }}
                    </td>
                    @else
                    <td class="budget">
                      Not Yet Assigned
                    </td>
                    @endif
                    <td>
                      <span class="badge badge-dot mr-4">
                        @if(!in_array($student->mykid,$student_person_ids))
                        <i class="bg-warning"></i>
                        <span class="status">pending</span>
                        @else
                        <i class="bg-success"></i>
                        <span class="status">completed</span>
                        @endif
                      </span>
                    </td>

                    <!-- <td class="text-center">
                      <a href="{{ route('personalityResultHist', $student) }}" class="btn btn-secondary btn-sm"><i class="fa fa-history" aria-hidden="true"></i>
                      </a>
                      <a href="{{ route('personalityResultCurr', $student) }}" class="btn btn-primary btn-sm">Current Result</a>
                    </td> -->

                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <!-- <a class="dropdown-item" href="{{ route('personalityEval', ['question' => 's', 'student' => $student]) }}">Scale</a> -->
                          <a class="dropdown-item" href="{{ route('personalityEval', ['question' => 'o', 'student' => $student]) }}">Open Ended</a>
                          <a class="dropdown-item" href="{{ route('personalityEval', ['question' => 'mcq', 'student' => $student]) }}">Multiple Choices</a>
                          <div class="dropdown-divider"></div>
                          <a href="{{ route('personalityResultCurr', $student) }}" class="dropdown-item">Current Result</a>
                          <a href="{{ route('personalityResultHist', $student) }}" class="dropdown-item">History</a>

                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    @endforeach

                </tbody>
              </table>
              <div class="d-flex">
                <div class="mx-auto">
                  {{ $students->links() }}
                </div>
              </div>
            </div>
            <!-- Card footer -->
            <div class="card-footer py-4">
            </div>
          </div>
        </div>

        <!-- Interest Tab content -->
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Interest Inventory</h3>
            </div>

            <form action="{{url('/studentlist-evaluation/search')}}" method="post" role="search">
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
                    <input id="input-name-2" name="search" type="text" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <button type="submit" class="btn btn-outline-primary"> <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </form>

            <!-- Light table -->
            <div class="table-responsive pt-3">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">NAME</th>
                    <th scope="col" class="sort" data-sort="budget">CLASS</th>
                    <th scope="col" class="sort" data-sort="status">STATUS</th>
                    <th scope="col"></th>
                    {{-- <th scope="col"></th> --}}
                  </tr>
                </thead>
                <tbody class="list">

                  @foreach ($students as $student)
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $student->name }}</span>
                        </div>
                      </div>
                    </th>
                    @if(isset($student->class->class_name))
                    <td class="budget">
                      {{ $student->class->class_name }}
                    </td>
                    @else
                    <td class="budget">
                      Not Yet Assigned
                    </td>
                    @endif
                    <td>
                      @if(!in_array($student->id,$student_ids))
                      <span class="badge badge-dot mr-4">
                        <i class="bg-warning"></i>
                        <span class="status">pending</span>
                      </span>

                      @else
                      <span class="badge badge-dot mr-4">
                        <i class="bg-success"></i>
                        <span class="status">completed</span>
                      </span>
                      @endif
                    </td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a href="/studentlist-evaluation/interestresult/{{$student->id}}" class="dropdown-item">Current Result</a>
                          <a href="{{route('interestInventory',$student->id)}}" class="dropdown-item">Perform Evaluation</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    @endforeach
                </tbody>
              </table>
              <div class="d-flex">
                <div class="mx-auto">
                  {{ $students->links() }}
                </div>
              </div>
            </div>
            <!-- Card footer -->
            <div class="card-footer py-4">
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

  var route = "{{ url('autocomplete-search') }}";
  $('#input-name-2').typeahead({
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