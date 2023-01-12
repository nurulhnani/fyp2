@extends('layouts.teacherapp')
@section('content')
@include('layouts.headers.cards')

<!-- BreadCrumb Header -->
<div class="header pb-5">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-12 col-12">
                    <h6 class="h2 text-black d-inline-block mb-0">Evaluation Page</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">Student List</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Personality Result</li>
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
                            <h3 class="mb-0">Personality Result</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Student Name</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="staticEmail" value="{{ $student->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Evaluator Name</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="staticEmail" value="{{ $teacher->name }}">
                            </div>
                        </div>
                    </form>
                    <h4 class="py-3">Below are the result for the assessment: </h4>
                    <table id="customers">
                        <tr>
                            @foreach ($input as $k => $v)
                            <th scope="col" class="text-center">{{ $k }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($input as $k => $v)
                            <td class="text-center">{{ $v }}</td>
                            @endforeach
                        </tr>
                    </table>
                    <div class="float-right pt-5" style="margin-top: 10px">
                        <a class="btn btn-secondary" href="{{ route('personalityResultCurr', $student) }}">Student Accumulative Result</a>
                        <a class="btn btn-primary" href="{{ route('evaluations.index') }}">Finish Review</a>
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

<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #808080;
        color: white;
    }
</style>