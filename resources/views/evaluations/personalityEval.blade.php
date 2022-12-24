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
                            <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">Student List</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Personality Assessment</li>
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
                            <h3 class="mb-0">Personality Assessment</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="personalityAssessment" method="post" action="{{ route('personality.store') }}">
                        @csrf
                        <?php $index = 1; ?>
                        <input type="hidden" id="student_mykid" name="student_mykid" value="{{ $student->mykid }}">
                        @foreach ($questions as $question)
                        <div class="form-group" id="questions-lists">

                            <!--Open Ended Questions-->
                            @if($question->type=='o')
                            <?php $hint = json_decode($question->ans_choices, true); ?>
                            <div class="float-right">
                                <button type="button" class="btn btn-sm btn-secondary mb-2" data-container="body" data-toggle="popover" data-color="secondary" data-placement="top" data-content="{{ $hint }}" data-html="true">
                                    Hint
                                </button>
                            </div>
                            <label class="form-control-label" for="exampleFormControlTextarea1"><?php echo $index ?>. {{ $question->question }}</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="text[{{ $question->category }}]" rows="3"></textarea>

                            <!--Multiple Choice Questions-->
                            @elseif($question->type=='mcq')
                            <input type="hidden" name="mcq" value="mcq">
                            <label class="form-control-label mb-3" for="exampleFormControlTextarea1"><?php echo $index ?>. {{ $question->question }}</label>

                            <?php $categories = json_decode($question->ans_choices, true); ?>
                            <?php $indexAns = 1; ?>

                            <div class="multicols">
                                @foreach($categories as $cat => $val)
                                @foreach($val as $v)
                                <div class="custom-control custom-checkbox mb-3">
                                    <li> <input type="checkbox" class="custom-control-input" name="checklist[{{ $question->category }}][<?php echo $indexAns ?>]" value="{{ $cat }}" id="customCheck<?php echo $index ?><?php echo $indexAns ?>">
                                        <label class="custom-control-label" for="customCheck<?php echo $index ?><?php echo $indexAns ?>">{{ $v }}</label>
                                    </li>
                                </div>
                                <?php $indexAns++; ?>
                                @endforeach
                                @endforeach
                            </div>
                            <!--Scale Questions-->
                            @elseif($question->type=='s')
                            <input type="hidden" name="scale" value="scale">
                            <input type="hidden" name="category<?php echo $index ?>" value="{{ $question->category }}">
                            <ul>
                                <li><label class="form-control-label" for="exampleFormControlTextarea1">{{ $question->question }}</label></li>
                            </ul>
                            <ul class='likert'>
                                <li>
                                    <input type="radio" name="likert<?php echo $index ?>" value="1">
                                    <label class="statement">Strongly disagree</label>
                                </li>
                                <li>
                                    <input type="radio" name="likert<?php echo $index ?>" value="2">
                                    <label class="statement">Disagree a little</label>
                                </li>
                                <li>
                                    <input type="radio" name="likert<?php echo $index ?>" value="3">
                                    <label class="statement">Neither agree nor disagree</label>
                                </li>
                                <li>
                                    <input type="radio" name="likert<?php echo $index ?>" value="4">
                                    <label class="statement">Agree a little</label>
                                </li>
                                <li>
                                    <input type="radio" name="likert<?php echo $index ?>" value="5">
                                    <label class="statement">Strongly agree</label>
                                </li>
                            </ul>
                            @endif
                        </div>
                        <?php $index++; ?>
                        @endforeach

                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                {!! $questions->links() !!}
                            </ul>
                        </nav>

                        <div class="float-right" style="margin-top: 10px">
                            <a class="btn btn-secondary" href="{{ route('evaluations.index') }}">Discard</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
    form .statement {
        display: block;
        font-size: 14px;
        margin-bottom: 10px;
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

    /*Checkboxes*/

    .multicols {
        -webkit-column-count: 3;
        /* Chrome, Safari, Opera */
        column-count: 3;
    }
</style>