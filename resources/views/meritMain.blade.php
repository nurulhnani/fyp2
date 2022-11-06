@extends('layouts.teacherapp')
@section('content')
@include('layouts.headers.cards')

<!-- BreadCrumb Header -->
<div class="header pb-5">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-black d-inline-block mb-0">Merit Page</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{route('teacher.home')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Merit and Demerit</li>
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
        <div class="col-sm-6">
            <div class="card h-100 text-center shadow">
                <img class="card-img-top" src="../assets/img/theme/cocomerit.jpg" alt="Card image cap">
                <div class="card-body shadow">
                    <h2 class="mb-0">Curriculum Merit</h5>
                        <div class="text-center">
                            <button type="submit" data-toggle="modal" data-target="#currModal" class="btn btn-primary mt-4"><span class="btn-inner--icon"><i class="ni ni-single-02"></i></span> {{ __('Single Student') }}</button>

                            <a href="{{ route('merits.bulk') }}"><button class="btn btn-default mt-4">{{ __('Multiple Students') }}</button></a>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card h-100 text-center shadow">
                <img class="card-img-top" src="../assets/img/theme/behavemerit.png" alt="Card image cap">
                <div class="card-body shadow">
                    <h2 class="mb-0">Behavioural Merit</h5>
                        <div class="text-center">
                            <button type="submit" data-toggle="modal" data-target="#behaModal" class="btn btn-primary mt-4"><span class="btn-inner--icon"><i class="ni ni-single-02"></i></span> {{ __('Single Student') }}</button>

                            <button type="submit" class="btn btn-default mt-4">{{ __('Multiple Students') }}</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection

<!-- Coco Modal -->
<div class="modal fade" id="currModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('merits.redirect') }}" autocomplete="off">
                    @csrf

                    <h6 class="text-center heading-small text-muted mb-4">{{ __('Give Merit to A Student') }}</h6>


                    <div class="pl-lg-4">

                        <div>
                            <input name="id" id="input-id" class="form-control form-control-alternative" placeholder="{{ __('NRIC/MyKid') }}">
                        </div>
                        <p class="card-text">
                        <h6 class="text-center heading-small">{{ __('OR') }}</h6>
                        </p>
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Full Name') }}">

                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Beha Modal -->
<div class="modal fade" id="behaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('merits.redirect') }}" autocomplete="off">
                    @csrf

                    <h6 class="text-center heading-small text-muted mb-4">{{ __('Give Merit to A Student') }}</h6>


                    <div class="pl-lg-4">

                        <div>
                            <input name="id" id="input-id" class="form-control form-control-alternative" placeholder="{{ __('NRIC/MyKid') }}">
                        </div>
                        <p class="card-text">
                        <h6 class="text-center heading-small">{{ __('OR') }}</h6>
                        </p>
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Full Name') }}">

                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="behaForm" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>


@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush

<style>
    .card-img-top {
        width: 100%;
        height: 10vw;
        object-fit: cover;
    }

    .card:hover {
        box-shadow: 5px 6px 6px 2px #e9ecef;
        transform: scale(1.05);
    }
</style>