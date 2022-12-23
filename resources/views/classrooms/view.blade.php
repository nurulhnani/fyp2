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
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-8">
                            <!-- <div class="card shadow"> -->
                            @if(isset($class->class_plan))
                            <img src="{{ asset('assets/img/class/'.$class->class_plan) }}" class="class-plan-img">
                            @else
                            <div class="card shadow text-center" style="width:100%; height: 100%;">
                                <h5><i>No class plan created yet for this class</i></h5>
                            </div>
                            @endif
                            <!-- </div> -->

                        </div>
                        <div class="col-xl-4">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

                            <div class="table-responsive">
                                <table id="myTable" class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">NAME</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($students as $student)
                                        <tr>
                                            <td scope="row">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{ $student->name }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <a href="{{route('editstudent',$student->id)}}"><button class="btn btn-sm btn-primary">View</button></a>
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="float-right mt-3">
                        <a class="btn btn-secondary" href="{{ route('classrooms.plan', $class) }}">Create New Class Plan</a>
                        <a class="btn btn-primary" href="{{ route('classrooms.index') }}">Finish</a>
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

    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('planimg');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<style>
    .class-plan-img {
        width: 100%;
        height: 100%;
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