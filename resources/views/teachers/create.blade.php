@extends('layouts.adminapp')

@section('content')
{{-- Header --}}
@include('layouts.headers.cards')
<!-- Header -->
@if ($errors->any())
<div class="alert alert-danger mt-2">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="header pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-7 col-7">
            <h6 class="h2 text-black d-inline-block mb-0">Add New Teacher</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}">Manage Teacher</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add New Teacher</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-5 col-5 text-right">
            <a href="{{route('addTeacherInBulk')}}" class="btn btn-sm btn-neutral">Add Teachers in Bulk</a>
          </div>
        </div>
       
      </div>
    </div>
</div>

    {{-- <div class="header bg-primary pb-6"> --}}
<div class="container-fluid mt--9">
  <form method="POST" action="{{route('teachers.store')}}"  enctype="multipart/form-data">
    @csrf
<div class="header-body pt-5">
    
  <div class="row py-4">
    <div class="col-xl-4 order-xl-1 mb-5 mb-xl-0">
      
        <div class="card card-profile shadow">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image py-7">
                        <a href="#">
                            <img id="output_image" src="{{asset('assets/img/theme/default.png')}}" class="rounded-circle">
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card-body pt-0 pt-md-1 text-center">
                <div class="text-center mt-5">
                    <h5><span class="font-weight-light">Choose profile picture</span></h5>
                </div>
                <div class="text-center">
                    <input accept="/*" type="file" onchange="preview_image(event)" class="form-control form-control-alternative" id="image" name="image">                 
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
                                <input type="text" name="name" id="name" class="form-control form-control-alternative" placeholder="Name" value="" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="address">{{ __('Address') }}</label>
                                <input type="text" name="address" id="address" class="form-control form-control-alternative" placeholder="Address" value="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6"><span></span>
                            <div class="form-group">
                                <label class="form-control-label" for="class">{{ __('NRIC') }}</label>
                                <input type="text" name="nric" id="nric" class="form-control form-control-alternative" placeholder="NRIC" value="" required>
                            </div>
                        </div>
                        <div class="col-sm-6"><span></span>
                            <div class="form-group">
                                <label class="form-control-label" for="email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="email" class="form-control form-control-alternative" placeholder="Email" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><span></span>
                            <div class="form-group">
                                <label class="form-control-label" for="gender">{{ __('Gender') }}</label>
                                <select type="text" name="gender" id="gender" class="form-control form-control-alternative"> 
                                    <option selected>Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                {{-- <input type="text" name="gender" id="gender" class="form-control form-control-alternative" placeholder="" value="" required> --}}
                            </div>
                        </div> 
                        <div class="col-sm-6"><span></span>
                            <div class="form-group">
                                <label class="form-control-label" for="position">{{ __('Position') }}</label>
                                <select type="text" name="position" id="position" class="form-control form-control-alternative"> 
                                    <option selected>Select position</option>
                                    <option value="Teacher">Teacher</option>
                                    <option value="Classroom teacher">Classroom teacher</option>
                                    <option value="Guidance counselor">Guidance counselor</option>
                                    <option value="Vice principal">Vice principal</option>
                                    <option value="Principal">Principal</option>
                                </select>
                                {{-- <input type="text" name="position" id="position" class="form-control form-control-alternative" placeholder="" value="" required> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><span></span>
                            <div class="form-group">
                                <label class="form-control-label" for="position">{{ __('Phone Number') }}</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control form-control-alternative" placeholder="Phone Number" value="">
                            </div>
                        </div>
                        {{-- <div class="col-sm-6"><span></span>
                            <div class="form-group">
                                <label class="form-control-label" for="subject_taught">{{ __('Subject Taught') }}</label>
                                <input type="text" name="subject_taught" id="subject_taught" class="form-control form-control-alternative" placeholder="" value="" required >
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="subject_taught">{{ __('Subject Taught') }}</label>
                                <input type="text" name="subject_taught" id="subject_taught" class="form-control form-control-alternative" placeholder="" value="" required >
                            </div>
                        </div>
                    </div> --}}

                    <?php
                        // $additionalInfo = $teacher->additional_Info;
                        // $explode_info = explode(',',$teacher->additional_Info);
                        $teacher = "teacher"; 
                        $customfields = App\Models\AutoFields::where('user',$teacher)->get();
                    ?>
                    @if((App\Models\AutoFields::where('user',$teacher))->count()>0)
                        <hr class="my-4" />

                        <h6 class="heading-small text-muted mb-4">{{ __('Additional details') }}</h6>
                        <?php $i = 0;?>               
                        @foreach($customfields as $customfield)

                        @if($customfield->type == "dropdown")
                                <div class="row">
                                    <div class="col-sm"><span></span>
                                        <div class="form-group">

                                            <?php 
                                                $dropdownNote = $customfield->dropdownNote;
                                                $explode_notes = explode(',',$dropdownNote);
                                            ?>

                                            <label class="form-control-label" for="{{ $customfield->name }}">{{ $customfield->name }}</label>
                                            <select class="form-control form-control-alternative" name="customfield[]">
                                                <option selected disabled>Select {{ $customfield->name }}</option>
                                                    @foreach($explode_notes as $explode_note)
                                                        <option value="{{$explode_note}}">{{$explode_note}}</option>
                                                    @endforeach
                                                    {{-- <option value="date">Date</option>
                                                    <option value="file">File</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-sm"><span></span>
                                        <div class="form-group">

                                            <label class="form-control-label" for="{{ $customfield->name }}">{{ $customfield->name }}</label>
                                            <input type="{{ $customfield->type }}" name="customfield[]" id="{{ $customfield->name }}" 
                                            class="form-control form-control-alternative" placeholder="" value="">
                                            
                                            {{-- <label class="form-control-label" for="{{ $customfield->name }}">{{ $customfield->name }}</label>
                                            <input type="{{ $customfield->type }}" name="customfield[]" id="{{ $customfield->name }}" 
                                            class="form-control form-control-alternative" placeholder="" value="{{$addinfo}}" required> --}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $i++ ?>
                        @endforeach
                        
                    @endif

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                    </div>
                </div>                       
          </div>
      </div>
  </div>


    </div>
    
    

  </div>

</form>

@include('layouts.footers.auth')
</div>

    {{-- </div> --}}
  {{-- </div> --}}
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush