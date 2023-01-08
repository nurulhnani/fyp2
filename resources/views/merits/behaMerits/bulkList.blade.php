@extends('layouts.teacherapp')

@section('content')
@include('layouts.headers.cards')

<!-- Header -->
<div class="header pb-5">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-black d-inline-block mb-0">Merit Page</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('merits.main') }}">Merit and Demerit</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Behavioural Merit in Bulk</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Behavioural Merit in Bulk') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="pl-lg-4">

                            <form method="post" action="{{ route('behaBulkmerits.store') }}" autocomplete="off">
                                @csrf
                                <input type="hidden" name="type" value="b">
                                <div class="form-group">
                                    <label for="inputAddress">Activity</label>
                                    <input name="merit_name" type="text" class="form-control" id="inputAddress" placeholder="">
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-1">
                                        <div class="custom-control custom-radio mb-3">
                                            <input name="meritCheck" value="merit" class="custom-control-input" id="customRadio1" type="radio">
                                            <label class="custom-control-label" for="customRadio1">Merit</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="custom-control custom-radio mb-3">
                                            <input name="meritCheck" value="demerit" class="custom-control-input" id="customRadio2" type="radio">
                                            <label class="custom-control-label" for="customRadio2">Demerit</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress2">Description</label>
                                    <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="5"></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputCity">Level</label>
                                        <select id="inputState" class="form-control" name="level">
                                        <option value="" selected disabled hidden>Choose...</option>
                                            <option value="Low">Low</option>
                                            <option value="Medium">Medium</option>
                                            <option value="High">High</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputZip">Date</label>
                                        <input name="date" type="date" class="form-control" id="inputZip">
                                    </div>

                                </div>

                                <!-- Light table -->
                                <label for="inputState">Student List</label>
                                <div class="table-responsive">
                                    <table id="myTable" class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">NAME</th>
                                                <th scope="col" class="sort" data-sort="budget">MYKID</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @if(isset($studentListArr))
                                            <?php $index = 1; ?>
                                            @foreach ($studentListArr as $studentArr)
                                            @foreach ($studentArr as $student)
                                            <tr>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="name mb-0 text-sm">{{ $student['name']}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="budget">
                                                    {{ $student['mykid'] }}
                                                </td>

                                                <td class="text-right">
                                                    <div class="custom-control custom-checkbox nopadding">
                                                        <input type="checkbox" class="custom-control-input" name="checklist[]" value="{{ $student['mykid'] }}" id="customCheck<?php echo $index ?>" checked>
                                                        <label class="custom-control-label" for="customCheck<?php echo $index ?>"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php $index++; ?>
                                                @endforeach
                                                @endforeach

                                                @else
                                                <?php $index2 = 1; ?>
                                                @foreach ($studentLists as $studentList)
                                            <tr>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="name mb-0 text-sm">{{ $studentList['name']}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="budget">
                                                    {{ $studentList['mykid'] }}
                                                </td>

                                                <td class="text-right">
                                                    <div class="custom-control custom-checkbox nopadding">
                                                        <input type="checkbox" class="custom-control-input" name="checklist[]" value="{{ $studentList['mykid'] }}" id="customCheck<?php echo $index2 ?>" checked>
                                                        <label class="custom-control-label" for="customCheck<?php echo $index2 ?>"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php $index2++; ?>
                                                @endforeach
                                                @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right py-4">
                                    <a class="btn btn-secondary" href="{{ route('behaMerits.bulk') }}">Cancel</a>
                                    <button type="submit" class="btn btn-primary ml-auto">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection
<style>
    #myTable {
        border-collapse: collapse;
        /* Collapse borders */
        width: 100%;
        /* Full-width */
        border: 1px solid #ddd;
        /* Add a grey border */
        font-size: 18px;
        /* Increase font-size */
    }

    #myTable th,
    #myTable td {
        text-align: left;
        /* Left-align text */
        padding: 12px;
        /* Add padding */
    }

    #myTable tr {
        /* Add a bottom border to all table rows */
        border-bottom: 1px solid #ddd;
    }

    #myTable tr.header,
    #myTable tr:hover {
        /* Add a grey background color to the table header and on hover */
        background-color: #f1f1f1;
    }
</style>