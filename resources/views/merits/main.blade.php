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

                            <a href="{{ route('behaMerits.bulk') }}"><button class="btn btn-default mt-4">{{ __('Multiple Students') }}</button></a>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @include('merits.modal')
    @include('layouts.footers.auth')
</div>
@endsection




@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush

<!-- autocomplete -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    var route = "{{ url('autocomplete-search') }}";
    $('#input-name').typeahead({
        source: function(query, process) {
            return $.get(route, {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });

    var route1 = "{{ url('beha-autocomplete-search') }}";
    $('#beha-input-name').typeahead({
        source: function(query, process) {
            return $.get(route1, {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });
</script>

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