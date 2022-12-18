@extends('layouts.adminapp')

@section('content')
    @include('layouts.headers.cards')
    {{-- Header --}}
    <div class="header bg-secondary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-4">Manage Subject</h6>
              </div>
              <div class="col-lg-6 col-5 text-right mb-4">
                <a href="#AddNewSubject" data-toggle="modal" class="btn btn-sm btn-neutral">Add New Subject</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="container-fluid mt--7">
      <div class="row">
        @foreach($subjects as $subj)
        <div class="col-xl-3 col-lg-6 mb-3">
            <div class="card card-stats mb-4 mb-xl-0 form-control-alternative text-center">
                <div class="card-body">
                    <div class="row py-2">
                      <div class="col">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            {{-- <i class="fas fa-chart-bar"></i> --}}
                            <?php 
                              $name = $subj->subject_name;
                              $words=explode(" ",$name);
                              $inits='';
                              //loop through array extracting initial letters
                              foreach($words as $word){
                                $inits.=strtoupper(substr($word,0,1));
                              }
                              // return $inits;	
                              // dd($inits);
                            ?>
                            {{$inits}}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span class="h3 font-weight-bold mb-0">{{$subj->subject_name}}</span>
                            <h5 class="card-title text-uppercase mb-0">{{$subj->grade}}</h5>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-primary text-sm">
                        <a href="{{route('subjects.edit',$subj->id)}}" class="text-primary">View Details</a>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
      </div>
        @include('layouts.footers.auth')
    </div>

    <!-- Add New Subject Modal -->
<div class="modal fade" id="AddNewSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Add New Subject</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{route('subjects.store')}}">
        @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="subject_name" class="form-control-label">Subject Name</label>
              <input class="form-control form-control-alternative" type="text" name="subject_name" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label class="form-control-label">Grade</label>
            <select class="form-control form-control-alternative" id="grade" name="grade">
                <option selected>Select Grade</option>
                <option value="Grade 1">Grade 1</option>
                <option value="Grade 2">Grade 2</option>
                <option value="Grade 3">Grade 3</option>
                <option value="Grade 4">Grade 4</option>
                <option value="Grade 5">Grade 5</option>
                <option value="Grade 6">Grade 6</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush