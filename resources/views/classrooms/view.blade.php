@extends('layouts.teacherapp')
@section('content')
@include('layouts.headers.cards')

<!-- BreadCrumb Header -->
<div class="header pb-5">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-black d-inline-block mb-0">Classroom Page</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('classrooms.index') }}">Classroom</i></a></li>
                            <li class="breadcrumb-item" aria-current="page">{{ $class->class_name }}</li>

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
                            <h3 class="mb-0">Classroom Management</h3>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="row">

                        <div class="col">

                            <div class="form-row">
                                <div class="form-group col">
                                    <input type="text" class="form-control text-center" id="inputEmail4" placeholder="{{ $class->class_name }} ( Homeroom Teacher: {{ $class->teachers->name }} ) " readonly="true">
                                </div>
                            </div>

                            <div class="card card-profile shadow">
                                <div class="card-profile-image py-7" style="width:500px; height:300px">
                                    <!-- <img id="planimg" src="" width="500" ; height="300"> -->
                                </div>
                            </div>

                            <div class="text-center pt-3">
                                <input accept="/*" type="file" onchange="preview_image(event)" class="form-control form-control-alternative bg-secondary" id="imageT" name="imageT" value="">
                            </div>

                            <div class="float-right mt-3">
                                <a class="btn btn-secondary" href="{{ route('classrooms.plan') }}">Create New Class Plan</a>
                                <a class="btn btn-primary" href="{{ route('classrooms.index') }}">Finish</a>
                            </div>
                        </div>

                    </div>
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

<script type='text/javascript'>
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('planimg');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>