@extends('layouts.adminapp')

@section('content')
@include('layouts.headers.cards')

<!-- Header -->
<div class="header pb-3">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-7 col-7">
                    <h6 class="h2 text-black d-inline-block mb-0">Manage Merit Points</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Merit Points</li>
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
                    <p class="card-text mb-2">This section is to allocate curriculum merit points for students. You can add, edit or delete any records.</p>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <h3>List of Merit Points</h3>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="#add" data-toggle="modal" class="btn btn-sm btn-neutral">Add New Merit</a>
                        </div>
                    </div>
                    <h5>Curriculum Merit: Position</h5>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="myTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Level</th>
                                    <th scope="col" style="width:40%">Achievement</th>
                                    <th scope="col">Merit Points</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $index = 1 ?>
                                @foreach ($meritsArr as $merits)
                                @if($merits->category == 'Position')
                                <tr>
                                    <th scope="row"><?php echo $index ?>.</th>
                                    <td>{{ $merits->level }}</td>
                                    <td>{{ $merits->achievement }}</td>
                                    <td id="category">{{ $merits->merit_points }}</td>
                                    <td style="width: 10%">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="#edit{{$merits->id}}" data-toggle="modal">Edit Achievement</a>
                                                <a class="dropdown-item" href="#delete{{$merits->id}}" data-toggle="modal">Delete Achievement</a>
                                            </div>
                                            @include('meritPoints.modal')
                                        </div>
                                    </td>
                                </tr>
                                <?php $index++ ?>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <h5>Curriculum Merit: Activity/Competition</h5>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="myTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Level</th>
                                    <th scope="col" style="width:40%">Achievement</th>
                                    <th scope="col">Merit Points</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $index = 1 ?>
                                @foreach ($meritsArr as $merits)
                                @if($merits->category == 'Competition' && ($merits->level == 'School' || $merits->level == 'State' || $merits->level == 'International'))
                                <tr>
                                    <th class="grayColumn" scope="row"><?php echo $index ?>.</th>
                                    <td class="grayColumn">{{ $merits->level }}</td>
                                    <td class="grayColumn">{{ $merits->achievement }}</td>
                                    <td class="grayColumn" id="category">{{ $merits->merit_points }}</td>
                                    <td class="grayColumn" style="width: 10%">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="#edit{{$merits->id}}" data-toggle="modal">Edit Achievement</a>
                                                <a class="dropdown-item" href="#delete{{$merits->id}}" data-toggle="modal">Delete Achievement</a>
                                            </div>
                                            @include('meritPoints.modal')
                                        </div>
                                    </td>
                                </tr>
                                <?php $index++ ?>
                                @endif
                                @if($merits->category == 'Competition' && ($merits->level == 'District' || $merits->level == 'National'))
                                <tr>
                                    <th scope="row"><?php echo $index ?>.</th>
                                    <td>{{ $merits->level }}</td>
                                    <td>{{ $merits->achievement }}</td>
                                    <td id="category">{{ $merits->merit_points }}</td>
                                    <td style="width: 10%">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="#edit{{$merits->id}}" data-toggle="modal">Edit Achievement</a>
                                                <a class="dropdown-item" href="#delete{{$merits->id}}" data-toggle="modal">Delete Achievement</a>
                                            </div>
                                            @include('meritPoints.modal')
                                        </div>
                                    </td>
                                </tr>
                                <?php $index++ ?>
                                @endif
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

<!--Add New Merit Point Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title font-weight-bold" id="exampleModalLabel">Add New Merit Point</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('meritPoints.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="category" class="form-control-label">Category</label>
                                <select class="form-control form-control-alternative" name="category" id="category">
                                    <option value="" selected disabled hidden>Select Category</option>
                                    <option value="Position">Position</option>
                                    <option value="Competition">Activity/Competition</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-control-label" for="input-name">{{ __('Achievement') }}</label>
                                <input type="text" name="achievement" id="question" class="form-control form-control-alternative" placeholder="{{ __('Achievement Name') }}" autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="category" class="form-control-label">Level</label>
                                <select class="form-control form-control-alternative" name="level" id="category">
                                    <option value="" selected disabled hidden>Select Level</option>
                                    <option value="School">School</option>
                                    <option value="District">District</option>
                                    <option value="State">State</option>
                                    <option value="National">National</option>
                                    <option value="International">International</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-control-label" for="input-name">{{ __('Merit Points') }}</label>
                                <input type="number" min="0" max="30" name="merit_points" class="form-control form-control-alternative" placeholder="{{ __('Merit Points') }}" autofocus>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush

<style>
    .grayColumn {
        background-color: #F8F6F6;
    }

    .nopadding {
        padding: 0 !important;
        margin: 0 !important;
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