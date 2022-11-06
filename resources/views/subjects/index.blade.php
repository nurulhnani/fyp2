@extends('layouts.adminapp')

@section('content')
    @include('layouts.headers.cards')
    {{-- Header --}}
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-4">Manage Subject</h6>
              </div>
              <div class="col-lg-6 col-5 text-right mb-4">
                <a href="#AddNewSubject" data-toggle="modal" class="btn btn-sm btn-neutral">Add New Subject</a>
                {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
              </div>
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
                    @foreach($subjects as $subj)
                    <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="myTable">
                        <thead class="thead-light">
                            <tr>
                              <th colspan="3"><strong>{{ $subj->subject_name }}<strong>
                                <a href="{{route('subjects.edit',$subj->id)}}"><button class="btn btn-sm btn-primary">Show details</button></a>
                                {{-- @include('admin.actionsubject') --}}
                              </th>
                            </tr>
                          </thead>
                        {{-- <thead class="thead-light">
                          <tr>
                            <th scope="col">Class name</th>
                            <th scope="col">Subject Teacher</th>
                            <th scope="col">
                              <a href="{{route('subjects.show',$subj->id)}}"><button class="btn btn-sm btn-primary">Show details</button></a>
                            </th>
                          </tr>
                        </thead> --}}
                        {{-- <tbody class="list">
                            @foreach ($subjectlist as $subject)
                                @if($subject->class_name != null)
                                <tr>
                                    <td>{{ $subject->class_name }}</td>
                                    <td>{{ $subject->name }}</td> 
                                    <td>
                                      <ul class="nav nav-pills justify-content-end">
                                        <div class="col-lg-6 col-5 text-right mb-0">
                                            <a href="#editSubject{{ $subject->id }}" data-toggle="modal"><button class="btn btn-sm btn-primary">Edit</button></a>
                                            <a href="#deleteClassSubject{{$subject->id}}" data-toggle="modal"><button class="btn btn-sm btn-primary">Delete</button></a>
                                            @include('subjects.actionsubject')
                                        </div>
                                        <li class="nav-item mr-2 mr-md-0">
                                            <a href="{{route('students.edit',$student->id)}}"><button class="btn btn-sm btn-primary">View</button></a>
                                        </li>
                                        <li class="nav-item mr-2 mr-md-0">
                                            <a href="#archiveModal{{$student->id}}" data-toggle="modal"><button class="btn btn-sm btn-primary">Archive</button></a>
                                              @include('students.studentaction')
                                        </li>
                                        <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='' data-prefix="$" data-suffix="k">
                                            <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                                <span class="d-none d-md-block">Week</span>
                                                <span class="d-md-none">W</span>
                                            </a>
                                        </li>
                                      </ul>
                                    </td>
                                    <td style="width: 5%"><a href="#editSubject{{ $subject->id }}" data-toggle="modal"><button class="btn btn-sm btn-primary" >Edit</button></a></td>
                                    @include('subjects.actionsubject')
                                </tr>
                                @endif
                            @endforeach
                        </tbody> --}}
                      </table>
                      @endforeach
                    </div>              
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