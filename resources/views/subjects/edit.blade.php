@extends('layouts.adminapp')

@section('content')
    @include('layouts.headers.cards')
    {{-- Header --}}
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-4">{{$subject->subject_name}}</h6>
              </div>
              {{-- <div class="col-lg-6 col-5 text-right mb-4">
                <a href="#AddNewSubject" data-toggle="modal" class="btn btn-sm btn-neutral">Add New Subject</a>
              </div> --}}
            </div>
          </div>
        </div>
      </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Subject List</h3>
                      </div>
                    <form action="{{route('subjects.update',$subject->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        @forelse ($subject->subject_details as $eachsubject)
                            <li class="text-black">
                                <input type="text" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400" name="class_name" value="{{$eachsubject['class_name']}}">
                            </li>
                            <li class="text-black">
                                <input type="text" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400" name="subject_teacher" value="{{$eachsubject['subject_teacher']}}">
                            </li>
                            <a href="#deleteClassSubject{{$eachsubject['id']}}" data-toggle="modal"><button class="btn btn-sm btn-primary">Delete</button></a>
                            {{-- @include('subjects.actionsubject') --}}
                        @empty
                            <p>No class found</p>
                        @endforelse 
                        <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                            Submit
                        </button>
                        <div class="col-lg-6 col-5 text-right mb-0">
                            {{-- <a href="#editSubject{{ $subject->id }}" data-toggle="modal"><button class="btn btn-sm btn-primary">Edit</button></a> --}}
                        </div>   
                    </form>         
                </div>
            </div> 

        </div>

{{-- Delete Class Subject --}}
<div class="modal fade" id="deleteClassSubject{{$subject->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Delete Class</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="POST" action="{{route('subjects.destroy',$subject->id)}}">
            @csrf
          @method('delete')
          <div class="modal-body">
              <h4 class="text-center">Are you sure you want to delete {{$subject->class_name}} from {{$subject->subject_name}}?</h4>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i>Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- Add New Subject Modal -->
<div class="modal fade" id="AddNewSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">ADD NEW SUBJECT</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{route('subjects.store')}}">
          @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label for="subject_name" class="col-form-label" style="padding-left: 10pt">Subject Name</label>
                <div class="col-sm-8" style="padding-left: 18pt">
                  <input type="text" class="form-control" id="subject_name" name="subject_name" style="width: 240pt">
                </div>
              </div>
              {{-- <div class="form-group row">
                <label class="col-form-label" style="padding-left: 10pt; padding-right: 8pt">Subject Teacher</label>
                <select class="custom-select" style="height: 25pt; font-size:8pt; width:240pt" id="subject_teacher" name="subject_teacher" >
                  <option selected>Search by Teacher Name</option>
                  @foreach($teacher as $teacher)
                    <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                  @endforeach
              </select>
              </div>
              <div class="form" style=" padding-bottom: 1pt">
                    <label class="col-12 col-form-label font-weight-bold" style="padding-left: 1pt; padding-right: 8pt; color:#6C6565; font-size:10pt">Assign Class to Subject</label>
              </div>
              <div class="form-group row">
                <label class="col-form-label" style="padding-left: 10pt; padding-right: 8pt">Class Name</label>
                <select class="custom-select" style="height: 25pt; font-size:8pt; width:160pt" id="class_name" name="class_name" >
                  <option selected>Search by Class Name</option>
                  @foreach($class as $class)
                    <option value="{{$class->id}}">{{$class->class_name}}</option>
                  @endforeach
                </select>
              </div> --}}
              {{-- <div class="form-group row" style="height:50pt;margin-bottom: 2pt">
                <div class="row d-flex bd-highlight" style="padding-left: 15pt">
                <div class="p-2 flex-fill bd-highlight">
                            <select class="custom-select" style="height: 25pt; font-size:8pt; width:160pt" id="class_name" name="class_name" >
                                <option selected>Search by Class Name</option>
                                @foreach($class as $class)
                                  <option value="{{$class->id}}">{{$class->class_name}}</option>
                                @endforeach
                            </select>
                </div>
                <style>
                    .vl {
                    border-left: 1px solid #E9E4E4;
                    height: 50px;
                    padding-left: 0pt;
                    padding-right: 0pt;
                    }
                </style>
                <div class="vl"></div>
                <div class="p-2 flex-fill bd-highlight">
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" style="height: 25pt; font-size:8pt; width:164pt; background-color:#E9E4E4">
                    <p style="font-size:8pt; margin-bottom:1pt">Please make sure the file is in the correct format</p>
                    <p style="font-size:8pt" >(Excel file only)</p>
                </div>
            </div>
              </div> --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save changes</button>
        </div>
      </form>
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