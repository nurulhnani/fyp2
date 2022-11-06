@extends('layouts.teacherapp')

@section('content')
@include('layouts.headers.cards')

<!-- Header -->
<div class="header pb-5">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-black d-inline-block mb-0">Evaluation Page</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('evaluationList') }}">Student List</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Student</li>
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
                            <h3 class="mb-0">Personality Evaluation</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="personalityAssessment" method="post" action="">
                        @csrf
                        <?php $index = 1; ?>
                        @foreach ($questions as $question)
                        <div class="form-group">
                            <label class="form-control-label" for="exampleFormControlTextarea1"><?php echo $index ?>. {{ $question->question }}</label>
                            @if($question->type=='o')
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            @else
                            <ul class='likert'>
                                <li>
                                    <input type="radio" name="likert" value="strong_agree">
                                    <label class="statement">Strongly agree</label>
                                </li>
                                <li>
                                    <input type="radio" name="likert" value="agree">
                                    <label class="statement">Agree</label>
                                </li>
                                <li>
                                    <input type="radio" name="likert" value="neutral">
                                    <label class="statement">Neutral</label>
                                </li>
                                <li>
                                    <input type="radio" name="likert" value="disagree">
                                    <label class="statement">Disagree</label>
                                </li>
                                <li>
                                    <input type="radio" name="likert" value="strong_disagree">
                                    <label class="statement">Strongly disagree</label>
                                </li>
                            </ul>
                            @endif
                        </div>
                        <?php $index++; ?>
                        @endforeach
                        <div class="float-right" style="margin-top: 10px">
                            <a href="" class="btn btn-primary">Submit</a>
                        </div>
                    </form>
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
    /* html,
    body {
        padding: 0;
        margin: 0;
    }

    .wrap {
        font: 12px Arial, san-serif;
    } */

    /* h1.likert-header {
        padding-left: 4.25%;
        margin: 20px 0 0;
    }*/

    form .statement {
        /* display: block; */
        font-size: 14px;
        /* font-weight: bold; */
        /* padding: 30px 0 0 4.25%; */
        /* margin-bottom: 10px; */
    }

    form .likert {
        list-style: none;
        width: 100%;
        margin: 0;
        padding: 30px 0 30px;
        display: block;
        border-bottom: 2px solid #efefef;
    }

    form .likert:last-of-type {
        border-bottom: 0;
    }

    form .likert:before {
        content: '';
        position: relative;
        top: 11px;
        left: 9.5%;
        display: block;
        background-color: #efefef;
        height: 4px;
        width: 78%;
    }

    form .likert li {
        display: inline-block;
        width: 19%;
        text-align: center;
        vertical-align: top;
    }

    form .likert li input[type=radio] {
        display: block;
        position: relative;
        top: 0;
        left: 50%;
        margin-left: -6px;

    }

    form .likert li label {
        width: 100%;
    }

    /* form .buttons {
        margin: 30px 0;
        padding: 0 4.25%;
        text-align: right
    }

    form .buttons button {
        padding: 5px 10px;
        background-color: #67ab49;
        border: 0;
        border-radius: 3px;
    }

    form .buttons .clear {
        background-color: #e9e9e9;
    }

    form .buttons .submit {
        background-color: #67ab49;
    }

    form .buttons .clear:hover {
        background-color: #ccc;
    }

    form .buttons .submit:hover {
        background-color: #14892c;
    } */
</style>