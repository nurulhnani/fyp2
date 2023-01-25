@extends('layouts.teacherapp')

@section('content')
@include('layouts.headers.cards')
<!-- Header -->
<div class="header pb-5">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-black d-inline-block mb-0">Health Assessment</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Health Assessment</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">

      {{-- <div class="tab-content" id="pills-tabContent"> --}}

        <!-- Personality Tab content -->
        {{-- <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"> --}}

          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Student List</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
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
                        @if(in_array($student->id,$studentids))
                        <span class="badge badge-dot mr-4">
                            <i class="bg-success"></i>
                            <span class="status">completed</span>
                        </span>
                        
                        @else
                        <span class="badge badge-dot mr-4">
                            <i class="bg-warning"></i>
                            <span class="status">pending</span>
                        </span>
                        @endif
                    </td>

                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          @if(in_array($student->id,$studentids))
                              <a class="dropdown-item" href="{{route('health.edit',$student->id)}}">View/Edit Current Record</a>
                          @else
                              <a class="dropdown-item" href="/health/create/{{$student->id}}">Add Health Record</a>
                          @endif

                          {{-- <a class="dropdown-item" href="{{route('students.edit',$student->id)}}">Edit Student Profile</a>
                          <a class="dropdown-item" href="#archiveModal{{$student->id}}" data-toggle="modal">Archive Student Profile</a> --}}
                        </div>
                        {{-- @include('students.studentaction') --}}
                      </div>

                        {{-- @if(in_array($student->id,$studentids))
                            <a class="btn btn-sm btn-success" href="{{route('health.edit',$student->id)}}">Current Record</a>
                        @else
                            <a class="btn btn-sm btn-primary" href="/health/create/{{$student->id}}">Add</a>
                        @endif --}}
                    </td>
                  </tr>
                  <tr>
                    @endforeach

                </tbody>
              </table>
            </div>
            <!-- Card footer -->
            <div class="card-footer py-4">
                <div class="text-center">{{$students->links()}}</div>            
            </div>
          </div>
        {{-- </div> --}}

      {{-- </div> --}}

    </div>
  </div>
  @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush