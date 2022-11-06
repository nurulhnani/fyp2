@extends('layouts.adminapp')

@section('content')
    @include('layouts.headers.cards')

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Header --}}
    <div class="header bg-gradient-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-4">Edit Teacher Profile</h6>
              </div>
              {{-- <div class="col-lg-6 col-5 text-right mb-4">
                <a href="{{route('students.create')}}" class="btn btn-sm btn-neutral">Add New Student</a>
              </div> --}}
            </div>
          </div>
        </div>
      </div>

    <div class="container-fluid mt--7"> 
        <form action="{{ route('teachers.update',$teacher->id) }}" method="POST" enctype='multipart/form-data'>
            @csrf
            @method('PUT')          
                    <div class="row py-4">
                        <div class="col-xl-4 order-xl-1 mb-5 mb-xl-0">
                            <div class="card card-profile shadow">
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 order-lg-2">
                                        <div class="card-profile-image py-7">
                                            <a href="#">
                                                <img id="output_image" src="{{asset('assets/img/userImage/'.$teacher->image_path)}}" class="rounded-circle">
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-0 pt-md-1 text-center">
                                    <div class="text-center mt-5">
                                        <h5><span class="font-weight-light">Change profile picture</span></h5>
                                    </div>
                                    <div class="text-center">
                                        <input accept="/*" type="file" style="height: 1%" onchange="preview_image(event)" class="form-control form-control-alternative bg-secondary" id="imageT" name="imageT" value="{{$teacher->image_path}}">                 
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
                                
                               
                                <div class="card-body pt-0 pt-md-1 text-center">
                                    <h4 class="text-black d-inline-block mb-0">{{$teacher->name}}</h4>
                                    <div class="text-center mt-2">
                                        <h5>{{ $teacher->class }}<span class="font-weight-light"></span></h5>
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
                                                        <input type="text" name="name" id="name" class="form-control form-control-alternative" placeholder="{{ __('Name') }}" value="{{$teacher->name}}" required autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="address">{{ __('Address') }}</label>
                                                        <input type="text" name="address" id="address" class="form-control form-control-alternative" placeholder="{{ __('Address') }}" value="{{$teacher->address}}" required autofocus>
                                                    </div>
                                                </div>
                                            </div>
            
                                            <div class="row">
                                                <div class="col-sm-6"><span></span>
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="class">{{ __('NRIC') }}</label>
                                                        <input type="text" name="nric" id="nric" class="form-control form-control-alternative" placeholder="" value="{{$teacher->nric}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"><span></span>
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="email">{{ __('Email') }}</label>
                                                        <input type="email" name="email" id="email" class="form-control form-control-alternative" placeholder="" value="{{$teacher->email}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6"><span></span>
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="gender">{{ __('Gender') }}</label>
                                                        <input type="text" name="gender" id="gender" class="form-control form-control-alternative" placeholder="" value="{{$teacher->gender}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"><span></span>
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="position">{{ __('Position') }}</label>
                                                        <input type="text" name="position" id="position" class="form-control form-control-alternative" placeholder="" value="{{$teacher->position}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6"><span></span>
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="phone_number">{{ __('Phone Number') }}</label>
                                                        <input type="text" name="phone_number" id="phone_number" class="form-control form-control-alternative" placeholder="" value="{{$teacher->phone_number}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"><span></span>
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="class_name">{{ __('Class Name') }}</label>
                                                        <input type="text" name="class_name" id="class_name" class="form-control form-control-alternative" placeholder="" value="{{$teacher->class_name}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="subject_taught">{{ __('Subject Taught') }}</label>
                                                        <input type="text" name="subject_taught" id="subject_taught" class="form-control form-control-alternative" placeholder="" value="{{$teacher->subject_taught}}" required >
                                                    </div>
                                                </div>
                                            </div>           
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </form>
                                    
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush