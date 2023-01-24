@extends('layouts.teacherapp')

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
              <button type="submit" data-toggle="modal" data-target="#add-modal" class="btn btn-sm btn-success">Add merit</button>
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
              @include('merits/behaMerits.modal')
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
              <button type="submit" data-toggle="modal" data-target="#add-demerit-modal" class="btn btn-sm btn-warning">Add demerit</button>
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
                <th scope="col">DEMERIT</th>
                <th scope="col" class="sort" data-sort="completion">DATE</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach ($demerits as $merit)
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
                      <a href="#edit-demerit-modal{{$merit->id}}" data-toggle="modal" class="dropdown-item">Edit</a>
                      <a href="#delete-modal{{$merit->id}}" data-toggle="modal" class="dropdown-item">Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
              @include('merits/behaMerits.modal')
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="float-right mt-3">
        <a class="btn btn-secondary" href="{{ route('merits.main') }}">Finish Review</a>
      </div>
    </div>
  </div>
  @include('layouts.footers.auth')
</div>
@endsection

<!-- Add Merit Modal -->
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <div class="text-muted text-center mt-2 mb-3">Merit Details</div>
          </div>
          <div class="card-body px-lg-5 py-lg-4">
            <form method="post" action="{{ route('behaMerits.store') }}" autocomplete="off">
              @csrf
              <input type="hidden" name="type" value="b">

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Name</label>
                  <input type="text" class="form-control" id="inputEmail4" value="{{ $student->name }}" readonly="true">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">NRIC/MyKid</label>
                  <input type="text" class="form-control" id="inputPassword4" name="student_mykid" value="{{ $student->mykid }}" readonly="true">
                </div>
              </div>
              <div class="form-group">
                <label class="required-field" for="inputAddress">Merit Event</label>
                <input name="merit_name" type="text" class="form-control" id="inputAddress" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="inputAddress2">Description</label>
                <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="5"></textarea>
              </div>
              <div class="form-row">
                <div class="form-group col-md-8">
                  <label class="required-field" for="inputCity">Level</label>
                  <select id="inputState" class="form-control" name="level" required>
                    <option value="" selected disabled hidden>Choose...</option>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="required-field" for="inputZip">Date</label>
                  <input name="date" type="date" class="form-control" id="inputZip" required>
                </div>

              </div>
              <div class="modal-footer nopadding">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary ml-auto">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Demerit Modal -->
<div class="modal fade" id="add-demerit-modal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <div class="text-muted text-center mt-2 mb-3">Demerit Details</div>
          </div>
          <div class="card-body px-lg-5 py-lg-4">
            <form method="post" action="{{ route('behaMerits.store') }}" autocomplete="off">
              @csrf
              <input type="hidden" name="type" value="b">

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Name</label>
                  <input type="text" class="form-control" id="inputEmail4" value="{{ $student->name }}" readonly="true">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">NRIC/MyKid</label>
                  <input type="text" class="form-control" id="inputPassword4" name="student_mykid" value="{{ $student->mykid }}" readonly="true">
                </div>
              </div>
              <div class="form-group">
                <label class="required-field" for="inputAddress">Demerit Event</label>
                <input name="merit_name" type="text" class="form-control" id="inputAddress" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="inputAddress2">Description</label>
                <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="5"></textarea>
              </div>
              <div class="form-row">
                <div class="form-group col-md-8">
                  <label class="required-field" for="inputCity">Level</label>
                  <select id="inputState" class="form-control" name="level" required>
                    <option value="" selected disabled hidden>Choose...</option>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="required-field" for="inputZip">Date</label>
                  <input name="date" type="date" class="form-control" id="inputZip" required>
                </div>

              </div>
              <div class="modal-footer nopadding">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                <button name="demerit" type="submit" class="btn btn-primary ml-auto">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush

<style>
  .nopadding {
    padding: 0 !important;
    margin: 0 !important;
  }

  .required-field::after {
    content: "*";
    color: red;
    margin-left: 2px
  }
</style>