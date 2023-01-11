@extends('layouts.adminapp')

@section('content')
    {{-- Header --}}
    @include('layouts.headers.cards')
    <!-- Header -->

    <div class="header pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-7 col-7">
                <h6 class="h2 text-black d-inline-block mb-0">Add New Student</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Manage Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Student</li>
                  </ol>
                </nav>
              </div>
              <div class="col-lg-5 col-5 text-right">
                <a href="{{route('addStudentInBulk')}}" class="btn btn-sm btn-neutral">Add Students in Bulk</a>
              </div>
            </div>
           
          </div>
        </div>
    </div>

   {{-- <div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-7 col-7">
            <h6 class="h2 text-white d-inline-block mb-4">Add New Student</h6> 
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{route('students.index')}}">Manage Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Student</li>
                </ol>
            </nav>
          </div>
          <div class="col-lg-5 col-5 text-right">
            <a href="{{route('addStudentInBulk')}}" class="btn btn-sm btn-neutral">Add Students in Bulk</a>
          </div>
        </div>
      </div>
    </div>
   </div> --}}


    {{-- <div class="header bg-primary pb-6"> --}}
      <div class="container-fluid mt--9">
        <form method="POST" action="{{route('students.store')}}"  enctype="multipart/form-data">
            @csrf
        <div class="header-body pt-5">
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
                            <input accept="/*" type="file" style="background-color:#FFF2FF" onchange="preview_image(event)" class="form-control  form-control-alternative bg-secondary" id="image" name="image">                 
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
                                          <input type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="{{ __('Name') }}" value="" required autofocus>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label class="form-control-label" for="address">{{ __('Address') }}</label>
                                          <input type="text" name="address" id="address" class="form-control form-control-alternative" placeholder="{{ __('Address') }}" value="">
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label class="form-control-label" for="mykid">{{ __('Mykid') }}</label>
                                        <input type="text" name="mykid" id="mykid" class="form-control form-control-alternative" placeholder="{{ __('Mykid') }}" value="" required>
                                    </div>
                                </div>
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="citizenship">{{ __('Citizenship') }}</label>
                                      <select type="text" name="citizenship" id="citizenship" class="form-control form-control-alternative"> 
                                            <option selected>Select citizenship</option>
                                            <option value="Malaysian">Malaysian</option>
                                            <option value="Non-malaysian">Non-malaysian</option>
                                        </select>
                                      {{-- <input type="text" name="citizenship" id="citizenship" class="form-control form-control-alternative" placeholder="{{ __('Citizenship') }}" value="" > --}}
                                  </div>
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="gender">{{ __('Gender') }}</label>
                                      <select type="text" name="gender" id="gender" class="form-control form-control-alternative"> 
                                        <option selected>Select gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                      {{-- <input type="text" name="gender" id="gender" class="form-control form-control-alternative" placeholder="{{ __('Gender') }}" value="" > --}}
                                  </div>
                              </div>

                              <hr class="my-4" />

                              <h6 class="heading-small text-muted mb-4">{{ __('Guardian 1 details') }}</h6>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                          <label class="form-control-label" for="G1_name">{{ __('Guardian 1 Name') }}</label>
                                          <input type="text" name="G1_name" id="G1_name" class="form-control form-control-alternative" placeholder="{{ __('Guardian 1 Name') }}" >
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="G1_relation">{{ __('Relation') }}</label>
                                      <select type="text" name="G1_relation" id="G1_relation" class="form-control form-control-alternative"> 
                                        <option selected>Select relationship</option>
                                        <option value="Father">Father</option>
                                        <option value="Stepfather">Stepfather</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Uncle">Uncle</option>
                                        <option value="Grandfather">Grandfather</option>
                                    </select>
                                      {{-- <input type="text" name="G1_relation" id="G1_relation" class="form-control form-control-alternative" placeholder="" value="" > --}}
                                  </div>
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="G1_phonenum">{{ __('Phone number') }}</label>
                                      <input type="text" name="G1_phonenum" id="G1_phonenum" class="form-control form-control-alternative" placeholder="{{ __('Phone number') }}" value="" >
                                  </div>
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="G1_income">{{ __('Income') }}</label>
                                      <input type="text" name="G1_income" id="G1_income" class="form-control form-control-alternative" placeholder="{{ __('Income') }}" value="" >
                                  </div>
                              </div>

                              <hr class="my-4" />

                              <h6 class="heading-small text-muted mb-4">{{ __('Guardian 2 details') }}</h6>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label class="form-control-label" for="G2_name">{{ __('Guardian 2 Name') }}</label>
                                          <input type="text" name="G2_name" id="G2_name" class="form-control form-control-alternative" placeholder="{{ __('Guardian 2 Name') }}" >
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="G2_relation">{{ __('Relation') }}</label>
                                      <select type="text" name="G2_relation" id="G2_relation" class="form-control form-control-alternative"> 
                                        <option selected>Select relationship</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Stepmother">Stepmother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Aunty">Aunty</option>
                                        <option value="Grandmother">Grandmother</option>
                                    </select>
                                      {{-- <input type="text" name="G2_relation" id="G2_relation" class="form-control form-control-alternative" placeholder="" value="" > --}}
                                  </div>
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="G2_phonenum">{{ __('Phone number') }}</label>
                                      <input type="text" name="G2_phonenum" id="G2_phonenum" class="form-control form-control-alternative" placeholder="{{ __('Phone number') }}" value="" >
                                  </div>
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="G2_income">{{ __('Income') }}</label>
                                      <input type="text" name="G2_income" id="G2_income" class="form-control form-control-alternative" placeholder="{{ __('Income') }}" value="" >
                                  </div>
                              </div>

                                <?php
                                    // $explode_info = json_decode($student->additional_Info, true);;
                                    $student = "student"; 
                                    $customfields = App\Models\AutoFields::where('user',$student)->get();
                                ?>
                                @if((App\Models\AutoFields::where('user',$student))->count()>0)
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
                                                        <select class="form-control form-control-alternative" name="customfield[]" >
                                                            <option selected disabled>{{ $customfield->name }}</option>
                                                            @foreach($explode_notes as $explode_note)
                                                                <option value="{{$explode_note}}">{{$explode_note}}</option>
                                                            @endforeach
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
                                                        class="form-control form-control-alternative" placeholder="" value="" >
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <?php $i++ ?>
                                    @endforeach
                                    
                                @endif

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

        @include('layouts.footers.auth')
        </div>

    {{-- </div> --}}
  {{-- </div> --}}
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush