@extends('layouts.teacherapp')
@section('content')
@include('layouts.headers.cards')

<!-- BreadCrumb Header -->
<div class="header pb-5">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-black d-inline-block mb-0">Classroom Page</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{route('teacher.home')}}"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item" aria-current="page">Classroom</li>

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
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Classroom Management</h3>
            </div>
          </div>
        </div>


        <div class="card-body">

          <form method="post" action="{{ route('classrooms.view') }}" autocomplete="off">
            @csrf

            <select class="form-control" name="select_class">
              <option selected disabled hidden>Please select class</option>
              @foreach ($classes as $class)
              <option value="{{ $class->id }}">{{ $class->class_name }}</option>
              @endforeach
            </select>

            <div class="float-right" style="margin-top: 10px">
              <button type="submit" class="btn btn-primary">Next</button>
            </div>
          </form>

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