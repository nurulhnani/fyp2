@extends('layouts.teacherapp')

@section('content')
@include('layouts.headers.cards')

<!-- Header -->
<div class="header pb-5">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-12 col-7">
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
                        <form method="post" action="{{ route('beha-checklist-import') }}" autocomplete="off">
                            @csrf

                            <div class="h5 text-muted text-uppercase mb-4">
                                <i class="ni business_briefcase-24"></i>{{ __('Tick following students to receive merit') }}
                            </div>


                            <div class="pl-lg-4">
                                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

                                <!-- Light table -->
                                <div class="table-responsive" style="height: 300px;">
                                    <table id="myTable" class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">NAME</th>
                                                <th scope="col" class="sort" data-sort="budget">CLASS</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            <?php $index = 1; ?>
                                            @foreach ($students as $student)
                                            <tr>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="name mb-0 text-sm">{{ $student->name }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                @if(isset($student->class->class_name))
                                                    <td class="budget">
                                                    {{ $student->class->class_name }}
                                                    </td>
                                                @else
                                                    <td class="budget">
                                                    Not Yet Assigned
                                                    </td>
                                                @endif

                                                <td class="text-right">
                                                    <div class="custom-control custom-checkbox nopadding">
                                                        <input type="checkbox" class="custom-control-input" name="checklist[]" value="{{ $student->mykid }}" id="customCheck<?php echo $index ?>">
                                                        <label class="custom-control-label" for="customCheck<?php echo $index ?>"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php $index++; ?>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right py-4">
                                    <button type="submit" class="btn btn-primary ml-auto">Submit</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <div class="h5 text-muted text-uppercase mb-4 text-center">
                            <i class="ni business_briefcase-24"></i>{{ __('OR') }}
                        </div>
                        <div class="h5 text-muted text-uppercase mb-4">
                            <i class="ni business_briefcase-24"></i>{{ __('Upload list of students to receive merit in format .xlsx') }}
                        </div>

                        <div class="dropzone dropzone-single" data-toggle="dropzone" data-dropzone-url="http://">
                            <div class="fallback">
                                <form method="post" action="{{ route('beha-file-import') }}" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="custom-file">
                                        <div class="mb-3">
                                            <input class="form-control" type="file" name="file" id="file">
                                            <h5 class="card-text">Please make sure the file is in the correct format (EXCEL file only). <a href="{{asset("assets/download/meritlist.xlsx")}}" class="underline-on-hover"> Click here to download the Excel template</a></h5>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-left py-4">
                                <a class="btn btn-secondary" href="{{ route('merits.main') }}">Cancel</a>
                            </div>
                            <div class="col text-right py-4">
                                <button type="submit" class="btn btn-primary ml-auto">Submit</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection
<style>
    .nopadding {
        padding: 0 !important;
        margin: 0 !important;
    }

    #myInput {
        background-image: url('/css/searchicon.png');
        /* Add a search icon to input */
        background-position: 10px 12px;
        /* Position the search icon */
        background-repeat: no-repeat;
        /* Do not repeat the icon image */
        width: 100%;
        /* Full-width */
        font-size: 14px;
        /* Increase font-size */
        padding: 12px 20px 12px 40px;
        /* Add some padding */
        border: 1px solid #ddd;
        /* Add a grey border */
        margin-bottom: 12px;
        /* Add some space below the input */
    }

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
<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>