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
            <h6 class="h2 text-white d-inline-block mb-4">Add New Student</h6> 
          </div>
          <div class="col-lg-6 col-5 text-right">
            <a href="{{route('addStudentInBulk')}}" class="btn btn-sm btn-neutral">Add Students in Bulk</a>
            {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
          </div>
        </div>
      </div>
    </div>
   </div>


    {{-- <div class="header bg-primary pb-6"> --}}
      <div class="container-fluid mt--9">
        <form method="POST" action="{{route('students.store')}}"  enctype="multipart/form-data">
            @csrf
        <div class="header-body">
            <div class="row py-3">
                <h6 class="h2 text-white d-inline-block mb-0">Add New Student</h6>
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
                            <input accept="/*" type="file" style="background-color:#FFF2FF" onchange="preview_image(event)" class="form-control  form-control-alternative bg-secondary" id="image" name="image" required>                 
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
                                          <input type="text" name="address" id="address" class="form-control form-control-alternative" placeholder="{{ __('Address') }}" value="" required autofocus>
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label class="form-control-label" for="mykid">{{ __('Mykid') }}</label>
                                        <input type="text" name="mykid" id="mykid" class="form-control form-control-alternative" placeholder="{{ __('Email') }}" value="" required>
                                    </div>
                                </div>
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="citizenship">{{ __('Citizenship') }}</label>
                                      <input type="text" name="citizenship" id="citizenship" class="form-control form-control-alternative" placeholder="{{ __('Citizenship') }}" value="" required>
                                  </div>
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="gender">{{ __('Gender') }}</label>
                                      <input type="text" name="gender" id="gender" class="form-control form-control-alternative" placeholder="{{ __('Gender') }}" value="" required>
                                  </div>
                              </div>

                              <hr class="my-4" />

                              <h6 class="heading-small text-muted mb-4">{{ __('Guardian 1 details') }}</h6>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                          <label class="form-control-label" for="G1_name">{{ __('Guardian 1 Name') }}</label>
                                          <input type="text" name="G1_name" id="G1_name" class="form-control form-control-alternative" placeholder="" required autofocus>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="G1_relation">{{ __('Relation') }}</label>
                                      <input type="text" name="G1_relation" id="G1_relation" class="form-control form-control-alternative" placeholder="" value="" required>
                                  </div>
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="G1_phonenum">{{ __('Phone number') }}</label>
                                      <input type="text" name="G1_phonenum" id="G1_phonenum" class="form-control form-control-alternative" placeholder="" value="" required>
                                  </div>
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="G1_income">{{ __('Income') }}</label>
                                      <input type="text" name="G1_income" id="G1_income" class="form-control form-control-alternative" placeholder="" value="" required>
                                  </div>
                              </div>

                              <hr class="my-4" />

                              <h6 class="heading-small text-muted mb-4">{{ __('Guardian 2 details') }}</h6>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <label class="form-control-label" for="G2_name">{{ __('Guardian 2 Name') }}</label>
                                          <input type="text" name="G2_name" id="G2_name" class="form-control form-control-alternative" placeholder="" required autofocus>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="G2_relation">{{ __('Relation') }}</label>
                                      <input type="text" name="G2_relation" id="G2_relation" class="form-control form-control-alternative" placeholder="" value="" required>
                                  </div>
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="G2_phonenum">{{ __('Phone number') }}</label>
                                      <input type="text" name="G2_phonenum" id="G2_phonenum" class="form-control form-control-alternative" placeholder="" value="" required>
                                  </div>
                                  <div class="col-sm"><span></span>
                                      <label class="form-control-label" for="G2_income">{{ __('Income') }}</label>
                                      <input type="text" name="G2_income" id="G2_income" class="form-control form-control-alternative" placeholder="" value="" required>
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
                                                        <select class="form-control form-control-alternative" name="customfield[]" required>
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
                                                        class="form-control form-control-alternative" placeholder="" value="" required>
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
        </div>

    {{-- </div> --}}
    
    @include('layouts.footers.auth')
  </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush