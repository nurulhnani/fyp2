@extends('layouts.studentapp')

@section('content')
    {{-- Header --}}
    @include('layouts.headers.cards')

<div class="header">
    <div class="container-fluid">
        <div class="header-body">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
            <h6 class="h2 text-black d-inline-block mb-0">Export Profile</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{ route('studenthome',$student->id) }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Export Profile</li>
                </ol>
            </nav> 
            </div>
        </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    {{-- <div class="row align-items-center py-4">
        <div class="col-lg-12 col-12">
          <h6 class="h2 d-inline-block mb-4">Export Profile</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('studenthome',$student->id) }}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Export Profile</li>
            </ol>
          </nav> 
        </div>
      </div> --}}

      <div class="justify-content-md-center">
        <div class="card col-md-auto">
            {{-- <img class="card-img-top" style="width: 100%; height:10%" src="{{asset('assets/img/theme/students.png')}}" alt="Card image cap"> --}}
            <div class="card-body">
            <h3 class="card-title">My Profile</h3>
            <form method="post" action="{{ route('showPDF',$student->id) }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('GET')
                <div class="row mb-4 mt-5">
                    <div class="col-sm-3">
                        {{-- <h5 class="mt-3">Select Year of Studies</h5> --}}
                        <label class="form-control-label mt-2" for="year">{{ __('Select Year of Studies') }}</label>
                    </div>
                    <div class="col-sm-9">
                        <select type="text" name="year" id="year" class="form-control form-control-alternative" required> 
                            <option value="" selected>Select Year</option>
                            @foreach ($years as $year)
                                <option value="{{$year->year}}">{{$year->year}}</option>
                            @endforeach
                        </select>
                    </div> 
                    {{-- <div class="col-sm-5 text-right">
                        <button type="submit" class="btn btn-primary">{{ __('View Profile') }}</button>
                    </div>                  --}}
                </div>
                <div class="row mb-4 mt-5">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary">{{ __('View Profile') }}</button>
                    </div>
                </div>
                {{-- <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                </div> --}}
            </form>
            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
        </div>
    </div>



    @include('layouts.footers.auth')
</div>

{{-- </div> --}}
  {{-- </div> --}}
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush