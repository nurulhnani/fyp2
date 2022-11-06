@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

<!-- Header -->
<div class="header pb-5">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-black d-inline-block mb-0">Merit Page</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{route('merits.main')}}">Merit and Demerit</a></li>
              <li class="breadcrumb-item active" aria-current="page">Behavioral</li>
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
              <h3 class="mb-0">Merit Records</h3>
            </div>
            <div class="col-4 text-right">
              <button type="submit" data-toggle="modal" data-target="#add-modal" class="btn btn-sm btn-primary">Add merit</button>
            </div>
          </div>
        </div>
        <!-- Table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name">ACTIVITY</th>
                <th scope="col" class="sort" data-sort="budget">CATEGORY</th>
                <th scope="col">MERIT</th>
                <th scope="col" class="sort" data-sort="completion">DATE</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach ($merits as $merit)
              @if($merit->merit_point>0)
              <tr>
                <th scope="row">
                  {{ $merit->merit_name }}
                </th>
                <td class="budget">
                  {{ $merit->level }}
                </td>
                <td>
                  {{ $merit->merit_point }}
                </td>
                <td>
                  {{ $merit->date }}
                </td>
                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a href="#edit-modal{{$merit->id}}" data-toggle="modal" class="dropdown-item">Edit</a>
                      <a href="#delete-modal{{$merit->id}}" data-toggle="modal" class="dropdown-item">Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
              @endif
              @include('behaMerits.modal')
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="card mt-3">
        <!-- Card header -->
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Demerit Records</h3>
            </div>
            <div class="col-4 text-right">
              <button type="submit" data-toggle="modal" data-target="#add-demerit-modal" class="btn btn-sm btn-danger">Add demerit</button>
            </div>
          </div>
        </div>
        <!-- Table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name">ACTIVITY</th>
                <th scope="col" class="sort" data-sort="budget">CATEGORY</th>
                <th scope="col">MERIT</th>
                <th scope="col" class="sort" data-sort="completion">DATE</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach ($merits as $merit)
              @if($merit->merit_point<=0) <tr>
                <th scope="row">
                  {{ $merit->merit_name }}
                </th>
                <td class="budget">
                  {{ $merit->level }}
                </td>
                <td>
                  {{ $merit->merit_point }}
                </td>
                <td>
                  {{ $merit->date }}
                </td>
                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a href="#edit-demerit-modal{{$merit->id}}" data-toggle="modal" class="dropdown-item">Edit</a>
                      <a href="#delete-modal{{$merit->id}}" data-toggle="modal" class="dropdown-item">Delete</a>
                    </div>
                  </div>
                </td>
                </tr>
                @endif
                @include('behaMerits.modal')
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

<style>
  .nopadding {
    padding: 0 !important;
    margin: 0 !important;
  }
</style>