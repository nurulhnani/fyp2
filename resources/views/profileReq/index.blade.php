@extends('layouts.adminapp')

@section('content')
@include('layouts.headers.cards')

<!-- Header -->
<div class="header pb-3">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-7 col-7">
                    <h6 class="h2 text-black d-inline-block mb-0">Manage Profile Requests</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Profile Requests</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <p class="card-text mb-2">This section is to manage Update Profile Requests by students. You are resposible to approve or decline the requests.</p>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <h3>List of Requests</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="myTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" style="width:40%">Category Updated</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $index = 1 ?>
                                @foreach ($requests as $req)
                                <tr>
                                    <th scope="row"><?php echo $index ?>.</th>
                                    <td id="category">{{ $req->created_at->toDateString() }}</td>
                                    <td>{{ $req->student->name }}</td>
                                    <td id="category"><?php
                                                        $arr = json_decode($req->changes);
                                                        foreach ($arr as $category => $value) {
                                                            echo $category;
                                                            echo "<br>";
                                                        }
                                                        ?>
                                        <div class="details" style="display:none">
                                            </br><strong>Changes were Made:</strong></br>
                                            <?php
                                            foreach ($arr as $category => $value) {
                                                echo implode($student_array[$req->student_mykid][$category]) . ' => ' . $value;
                                                echo "<br>";
                                            }
                                            ?>
                                        </div>
                                        <a id="more" href="#" onclick="$('.details').slideToggle(function(){$('#more').html($('.details').is(':visible')?'See Less Details':'See More Details');});">See More Details</a>
                                    </td>
                                    <td id="category">
                                        @if($req->status == 'Pending')
                                        <span class="badge badge-info">Pending</span>
                                        @elseif($req->status == 'Declined')
                                        <span class="badge badge-warning">Declined</span>
                                        @else
                                        <span class="badge badge-success">Approved</span>
                                        @endif
                                        </span>
                                    </td>
                                    <td style="width: 10%">
                                        @if($req->status == 'Pending')
                                        <div class="col-lg-6 col-5 text-right mb-0">
                                            <a href="#declineReq{{$req->id}}" data-toggle="modal"><button class="btn btn-sm btn-warning">Decline</button></a>
                                            <a href="#approveReq{{$req->id}}" data-toggle="modal"><button class="btn btn-sm btn-success">Approve</button></a>
                                            @include('profileReq.modal')
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                <?php $index++ ?>
                                @endforeach
                            </tbody>
                        </table>

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