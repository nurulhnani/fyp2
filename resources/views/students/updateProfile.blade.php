@extends('layouts.studentapp')

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

<div class="container-fluid mt--2">
    <form action="{{ route('storeRequest') }}" method="POST" enctype='multipart/form-data'>
        @csrf
        @method('POST')
        <div class="row py-4">
            <div class="col-xl-4 order-xl-1 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image py-7">
                                @if($student->image_path != null)
                                <a href="#">
                                    <img id="output_image" src="{{$student->image_path}}" class="rounded-circle">
                                </a>
                                @else
                                <img id="output_image" src="{{asset('assets/img/theme/default.png')}}" class="rounded-circle">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0 pt-md-1 text-center">
                        <div class="text-center mt-5">
                            <h5><span class="font-weight-light">Change profile picture</span></h5>
                        </div>
                        <div class="text-center">
                            <input accept="/*" type="file" style="height: 1%" onchange="preview_image(event)" class="form-control form-control-alternative bg-secondary" id="imageT" name="imageT" value="{{$student->image_path}}">
                            <script type='text/javascript'>
                                function preview_image(event) {
                                    var reader = new FileReader();
                                    reader.onload = function() {
                                        var output = document.getElementById('output_image');
                                        output.src = reader.result;
                                    }
                                    reader.readAsDataURL(event.target.files[0]);
                                }
                            </script>
                        </div>
                    </div>

                    <div class="card-body pt-0 pt-md-1 text-center">
                        <h4 class="text-black d-inline-block mb-0">{{$student->name}}</h4>
                        @if(isset($student->class->class_name))
                        <div class="text-center mt-2">
                            <h5>{{$student->class->class_name}}<span class="font-weight-light"></span></h5>
                        </div>
                        @else
                        <div class="text-center mt-2">
                            <h5>Class Not Yet Assigned<span class="font-weight-light"></span></h5>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-8 order-xl-2">
                <div class="card bg-secondary shadow">

                    <div class="card-body">
                        <div class="alert alert-default alert-dismissible fade show" role="alert">
                            <span class="alert-text"><strong>Info:</strong> All profile changes will be submitted to System Admin. The changes will be reflected in your profile upon the approval.</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <h6 class="heading-small text-muted mb-4">{{ __('Personal details') }}</h6>

                        <div class="pl-lg-0">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="{{ __('Name') }}" value="{{$student->name}}" required disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="address">{{ __('Address') }}</label>
                                        <input type="text" name="address" id="address" class="form-control form-control-alternative" placeholder="{{ __('Address') }}" value="{{$student->address}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if(isset($student->class->class_name))
                                <div class="col-sm-6"><span></span>
                                    <label class="form-control-label" for="class">{{ __('Class') }}</label>
                                    <input type="text" name="class" id="class" class="form-control form-control-alternative" placeholder="{{ __('Class') }}" value="{{$student->class->class_name}}" disabled>
                                </div>
                                @else
                                <div class="col-sm-6"><span></span>
                                    <label class="form-control-label" for="class">{{ __('Class') }}</label>
                                    <input type="text" name="class" id="class" class="form-control form-control-alternative" placeholder="{{ __('Class') }}" value="Not Yet Assigned" disabled>
                                </div>
                                @endif
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="mykid">{{ __('Mykid') }}</label>
                                        <input type="text" name="mykid" id="mykid" class="form-control form-control-alternative" placeholder="{{ __('Mykid') }}" value="{{$student->mykid}}" required disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6"><span></span>
                                    <label class="form-control-label" for="citizenship">{{ __('Citizenship') }}</label>
                                    <input type="text" name="citizenship" id="citizenship" class="form-control form-control-alternative" placeholder="{{ __('Citizenship') }}" value="{{$student->citizenship}}" disabled>
                                </div>
                                <div class="col-sm-6"><span></span>
                                    <label class="form-control-label" for="gender">{{ __('Gender') }}</label>
                                    <input type="text" name="gender" id="gender" class="form-control form-control-alternative" placeholder="{{ __('Gender') }}" value="{{$student->gender}}" disabled>
                                </div>
                            </div>

                            <hr class="my-4" />

                            <h6 class="heading-small text-muted mb-4">{{ __('Guardian 1 details') }}</h6>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="G1_name">{{ __('Guardian 1 Name') }}</label>
                                        <input type="text" name="G1_name" id="G1_name" class="form-control form-control-alternative" placeholder="" value="{{$student->G1_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm"><span></span>
                                    <label class="form-control-label" for="G1_relation">{{ __('Relation') }}</label>
                                    <input type="text" name="G1_relation" id="G1_relation" class="form-control form-control-alternative" placeholder="" value="{{$student->G1_relation}}">
                                </div>
                                <div class="col-sm"><span></span>
                                    <label class="form-control-label" for="G1_phonenum">{{ __('Phone number') }}</label>
                                    <input type="text" name="G1_phonenum" id="G1_phonenum" class="form-control form-control-alternative" placeholder="{{ __('G1_phonenum') }}" value="{{$student->G1_phonenum}}">
                                </div>
                                <div class="col-sm"><span></span>
                                    <label class="form-control-label" for="G1_income">{{ __('Income') }}</label>
                                    <input type="text" name="G1_income" id="G1_income" class="form-control form-control-alternative" placeholder="{{ __('G1_income') }}" value="{{$student->G1_income}}">
                                </div>
                            </div>

                            <hr class="my-4" />

                            <h6 class="heading-small text-muted mb-4">{{ __('Guardian 2 details') }}</h6>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="G2_name">{{ __('Guardian 2 Name') }}</label>
                                        <input type="text" name="G2_name" id="G2_name" class="form-control form-control-alternative" placeholder="" value="{{$student->G2_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm"><span></span>
                                    <div class="form-group">
                                        <label class="form-control-label" for="G2_relation">{{ __('Relation') }}</label>
                                        <input type="text" name="G2_relation" id="G2_relation" class="form-control form-control-alternative" placeholder="" value="{{$student->G2_relation}}">
                                    </div>
                                </div>
                                <div class="col-sm"><span></span>
                                    <div class="form-group">
                                        <label class="form-control-label" for="G2_phonenum">{{ __('Phone number') }}</label>
                                        <input type="text" name="G2_phonenum" id="G2_phonenum" class="form-control form-control-alternative" placeholder="{{ __('G2_phonenum') }}" value="{{$student->G2_phonenum}}">
                                    </div>
                                </div>
                                <div class="col-sm"><span></span>
                                    <div class="form-group">
                                        <label class="form-control-label" for="G2_income">{{ __('Income') }}</label>
                                        <input type="text" name="G2_income" id="G2_income" class="form-control form-control-alternative" placeholder="{{$student->G2_income}}" value="{{$student->G2_income}}">
                                    </div>
                                </div>
                            </div>

                            <?php
                            // $additional=implode(",",$request->input('customfield'));
                            $additionalInfo = $student->additional_Info;
                            $explode_info = explode(',', $student->additional_Info);
                            $student = "student";
                            $customfields = App\Models\AutoFields::where('user', $student)->get();
                            ?>
                            @if((App\Models\AutoFields::where('user',$student))->count()>0)
                            <hr class="my-4" />

                            <h6 class="heading-small text-muted mb-4">{{ __('Additional details') }}</h6>
                            <?php $i = 0; ?>
                            @foreach($customfields as $customfield)
                            @if($customfield->type == "dropdown")
                            <div class="row">
                                <div class="col-sm"><span></span>
                                    <div class="form-group">

                                        @if($additionalInfo != null)
                                        <?php $addinfo = $explode_info[$i]; ?>
                                        @else
                                        <?php $addinfo = "No input"; ?>
                                        @endif

                                        <?php
                                        $dropdownNote = $customfield->dropdownNote;
                                        $explode_notes = explode(',', $dropdownNote);
                                        ?>

                                        <label class="form-control-label" for="{{ $customfield->name }}">{{ $customfield->name }}</label>
                                        <select class="form-control form-control-alternative" name="customfield[]">
                                            <option selected disabled>{{$addinfo}}</option>
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

                                        @if($additionalInfo != null)
                                        <?php $addinfo = $explode_info[$i]; ?>
                                        @else
                                        <?php $addinfo = "No input"; ?>
                                        @endif

                                        <label class="form-control-label" for="{{ $customfield->name }}">{{ $customfield->name }}</label>
                                        <input type="{{ $customfield->type }}" name="customfield[]" id="{{ $customfield->name }}" class="form-control form-control-alternative" placeholder="" value="{{$addinfo}}">
                                    </div>
                                </div>
                            </div>
                            @endif
                            <?php $i++ ?>
                            @endforeach
                            @endif
                        </div>
                        <div class="float-right mt-4">
                            <a class="btn btn-secondary" href="{{ route('viewstudentprofile') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">{{ __('Submit Changes') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </form>
</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush