@extends('layouts.teacherapp')

@section('content')
@include('layouts.headers.cards')
<!-- Header -->
<div class="header pb-5">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-black d-inline-block mb-0">Evaluation Page</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Student List</li>
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
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">List of Students</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name">NAME</th>
                <th scope="col" class="sort" data-sort="budget">CLASS</th>
                <th scope="col" class="sort" data-sort="status">STATUS</th>
                <th scope="col">PERSONALITY ASSESSMENT</th>
                <th scope="col" class="sort" data-sort="completion">INTEREST ASSESSMENT</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">

              @foreach ($students as $student)
              <tr>
                <th scope="row">
                  <div class="media align-items-center">
                    <!-- <a href="#" class="avatar rounded-circle mr-3">
                          <img alt="Image placeholder" src="../assets/img/theme/bootstrap.jpg">
                        </a> -->
                    <div class="media-body">
                      <span class="name mb-0 text-sm">{{ $student->name }}</span>
                    </div>
                  </div>
                </th>
                <td class="budget">
                  {{ $student->class->class_name }}
                </td>
                <td>
                  <span class="badge badge-dot mr-4">
                    <i class="bg-warning"></i>
                    <span class="status">pending</span>
                  </span>
                </td>
                <!-- <td>
                      <div class="avatar-group">
                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Ryan Tompson">
                          <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg">
                        </a>
                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                          <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg">
                        </a>
                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Alexander Smith">
                          <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg">
                        </a>
                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="Jessica Doe">
                          <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                        </a>
                      </div>
                    </td> -->
                <td>
                  <div class="d-flex align-items-center">
                    <span class="completion mr-2">60%</span>
                    <div>
                      <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                      </div>
                    </div>
                  </div>
                </td>

                <td>
                  <div class="d-flex align-items-center">
                    <span class="completion mr-2">30%</span>
                    <div>
                      <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                      </div>
                    </div>
                  </div>
                </td>

                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="{{route('evaluationQuestion')}}">Personality Assessment</a>
                      <a class="dropdown-item" href="{{route('interestInventory',$student->id)}}">Interest Inventory Assessment</a>
                      {{-- /interestInventory/{{$student['id']}} --}}
                    </div>
                  </div>
                </td>
              </tr>
              <tr>

                @endforeach

            </tbody>
          </table>
        </div>
        <!-- Card footer -->
        <div class="card-footer py-4">
          <nav aria-label="...">
            <ul class="pagination justify-content-end mb-0">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">
                  <i class="fas fa-angle-left"></i>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
              </li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">
                  <i class="fas fa-angle-right"></i>
                  <span class="sr-only">Next</span>
                </a>
              </li>
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