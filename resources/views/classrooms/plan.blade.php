@extends('layouts.teacherapp2')

@section('content')
@include('layouts.headers.cards')


<!-- Header -->
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
                            <li class="breadcrumb-item" aria-current="page">Classroom Plan</li>
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
                            <h3 class="mb-0">Create Classroom Plan</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <div class="col container1">
                                <div class="cloneBoard">
                                    <span class="mozgat f-szurke f75x30">
                                        <!-- student name -->
                                        <p>Student</p>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="col container2" id="dndBoard">
                                <div id="ch_dndBoard1" class="bal-oszlop tapad bal"></div>
                            </div>
                        </div>
                    </div>
                    <div class="float-right pt-3">
                        <a class="btn btn-secondary" href="{{ route('classrooms.index') }}">Discard</a>
                        <a class="btn btn-primary" href=""><i class="fa fa-save"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection

<style>
    .cloneBoard {
        height: 50%;
    }

    .container1 .cloneBoard ul {
        margin: 0px;
        padding: 0px;
        height: 100%;
        width: 100%;
    }

    .cloneBoard ul li {
        height: 100px;
    }

    .removeBoard {
        height: 150px;
    }

    .container2 {
        height: 500px;
        width: 600px;
    }

    .removeBoard {
        background-color: pink;
    }

    .mozgat {
        cursor: move;
        margin-bottom: 7px;
        position: absolute;
        z-index: 1;
    }

    .f75x30 {
        background-image: url("/assets/img/class/chair.png");
        background-repeat: no-repeat;
        background-size: 100px 100px;
        width: 100px;
        height: 100px;
        line-height: 90px;
    }

    .f75x45 {
        width: 150px;
        height: 90px;
        line-height: 90px;
        border-radius: 2px;
    }

    .f75x30 p,
    .f75x45 p {
        font-family: sans-serif;
        font-size: 18px;
        color: Gainsboro;
        text-align: center;
        text-shadow: 0px 1px 1px rgba(0, 0, 0, .4);
    }

    .jobb {
        float: right;
    }

    .bal {
        float: left;
    }

    .item {
        cursor: move;
        border: 1px solid #333;
        border-collapse: collapse;
    }

    #ch_dndBoard1 {
        background-image: url("/assets/img/class/floor2.jpg");
        position: relative;
        border: 1px solid #4A5157;
        border-collapse: collapse;
    }

    #ch_dndBoard1 {
        width: 900px;
        height: 500px;
    }

    .snaptarget-hover {
        background-color: #616A72;
    }
</style>