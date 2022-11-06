@extends('layouts.adminapp')

@section('content')
{{-- Header --}}
@include('layouts.headers.cards')
<!-- Header -->
@if ($errors->any()) 
    @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach
@endif

<div class="header bg-gradient-primary pb-6">
<div class="container-fluid">
    <div class="header-body">
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
        <h6 class="h2 text-white d-inline-block mb-4">Add New Teacher</h6> 
        </div>
        <div class="col-lg-6 col-5 text-right">
        <a href="{{route('addTeacherInBulk')}}" class="btn btn-sm btn-neutral">Add Teachers In Bulk</a>
        {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
        </div>
    </div>
    </div>
</div>
</div>


    {{-- <div class="header bg-primary pb-6"> --}}
<div class="container-fluid mt--9">
  <form method="POST" action="{{route('teachers.store')}}"  enctype="multipart/form-data">
    @csrf
<div class="header-body">
    <div class="row py-3">
        <h6 class="h2 text-white d-inline-block mb-0">Add New Teacher</h6>
    </div>
  <div class="row py-4">
    <div class="col-xl-4 order-xl-1 mb-5 mb-xl-0">
      
        <div class="card card-profile shadow">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image py-7">
                        <a href="#">
                            <img id="output_image" src="{{asset('assets/img/userImage/default.png')}}" class="rounded-circle">
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card-body pt-0 pt-md-1 text-center">
                <div class="text-center mt-5">
                    <h5><span class="font-weight-light">Choose profile picture</span></h5>
                </div>
                <div class="text-center">
                    <input accept="/*" type="file" onchange="preview_image(event)" class="form-control form-control-alternative" id="image" name="image" required>                 
                    <script type='text/javascript'>
                        function preview_image(event) 
                        {
                        var reader = new FileReader();
                        reader.onload = function()
                        {
                          var output = document.getElementById('output_image');
                          output.src = reader.result;
                        }
                        reader.readAsDataURL(event.target.files[0]);
                        }
                        </script>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 order-xl-2">
      <div class="card bg-secondary shadow">
          <div class="card-body">
                  <h6 class="heading-small text-muted mb-4">{{ __('Personal details') }}</h6>
                  
                  {{-- @if (session('status'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{ session('status') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                  @endif --}}


                  <div class="pl-lg-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name" class="form-control form-control-alternative" placeholder="" value="" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="address">{{ __('Address') }}</label>
                                <input type="text" name="address" id="address" class="form-control form-control-alternative" placeholder="" value="" required autofocus>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6"><span></span>
                            <div class="form-group">
                                <label class="form-control-label" for="class">{{ __('NRIC') }}</label>
                                <input type="text" name="nric" id="nric" class="form-control form-control-alternative" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="col-sm-6"><span></span>
                            <div class="form-group">
                                <label class="form-control-label" for="email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="email" class="form-control form-control-alternative" placeholder="" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><span></span>
                            <div class="form-group">
                                <label class="form-control-label" for="gender">{{ __('Gender') }}</label>
                                <input type="text" name="gender" id="gender" class="form-control form-control-alternative" placeholder="" value="" required>
                            </div>
                        </div> 
                        <div class="col-sm-6"><span></span>
                            <div class="form-group">
                                <label class="form-control-label" for="position">{{ __('Position') }}</label>
                                <input type="text" name="position" id="position" class="form-control form-control-alternative" placeholder="" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><span></span>
                            <div class="form-group">
                                <label class="form-control-label" for="position">{{ __('Phone Number') }}</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control form-control-alternative" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="col-sm-6"><span></span>
                            <div class="form-group">
                                <label class="form-control-label" for="class_name">{{ __('Class Name') }}</label>
                                <input type="text" name="class_name" id="class_name" class="form-control form-control-alternative" placeholder="" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="subject_taught">{{ __('Subject Taught') }}</label>
                                <input type="text" name="subject_taught" id="subject_taught" class="form-control form-control-alternative" placeholder="" value="" required >
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                    </div>
                </div>                       
          </div>
      </div>
  </div>


    </div>
    
    

  </div>

</form>
</div>

    {{-- </div> --}}
    
    @include('layouts.footers.auth')
  </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush