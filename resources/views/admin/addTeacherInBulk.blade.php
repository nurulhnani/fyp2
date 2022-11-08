@extends('layouts.adminapp')

@section('content')
{{-- Header --}}
@include('layouts.headers.cards')
<!-- Header -->
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-4">Add Teacher In Bulk</h6> 
            </div>
        </div>
        </div>
    </div>
</div>

{{-- <div class="header bg-primary pb-6"> --}}
<div class="container-fluid mt--6">
    <div class="justify-content-md-center">
        <div class="card col-md-auto">
            {{-- <img class="card-img-top" style="width: 100%; height:10%" src="{{asset('assets/img/theme/students.png')}}" alt="Card image cap"> --}}
            <div class="card-body">
            <h3 class="card-title">Upload Teacher List</h3>
            <form method="post" action="{{ route('teacher-file-import') }}" enctype="multipart/form-data" autocomplete="off">
                {{-- <div class="form-group"> --}}
                    {{-- <label for="exampleFormControlFile1" class="col-sm-2 col-form-label" style="text-align: left">Upload</label> --}}
                    {{-- <div class="col"> --}}
                        {{-- <input type="file" class="form-control-file form-control-alternative" id="exampleFormControlFile1"> --}}
                    {{-- </div> --}}
                {{-- </div> --}}
                <div class="form-group dropzone dropzone-single" data-toggle="dropzone" data-dropzone-url="http://">
                  <div class="fallback">
                          @csrf
                          <div class="custom-file">
                                  <!-- <input type="file" class="custom-file-input" id="customFileLang" lang="en">
                                  <label class="custom-file-label" for="customFileLang">Select file</label> -->
                              <div class="mb-3">
                                  <input class="form-control" type="file" name="file" id="file">
                              </div>
                          </div>
                  </div>
              </div>
                <p class="card-text">Please make sure the file is in the correct format (EXCEL file only). <a href="#" class="text-right badge badge-primary"> Click here for example</a></p>
                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                </div>
            </form>
            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
        </div>
    </div>
</div>

{{-- </div> --}}
    
    @include('layouts.footers.auth')
  </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush