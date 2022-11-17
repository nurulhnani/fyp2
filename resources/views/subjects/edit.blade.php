@extends('layouts.adminapp')

@section('content')
    @include('layouts.headers.cards')
    {{-- Header --}}
    <div class="header bg-gradient-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-4">Edit Subject</h6>
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
                        <h3 class="mb-0">{{$subject->subject_name}} Details</h3>
                      </div>

                      <div class="card-body">
                      <form method="POST" action="{{route('subjects.update',$subject->id)}}">
                        @csrf 
                        @method('PUT')
                                             
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="example-text-input" class="form-control-label">Subject Name</label>
                              <input class="form-control form-control-alternative" type="text" value="{{$subject->subject_name}}" id="subject_name" name="subject_name">
                          </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label">Grade</label>
                                <select class="form-control form-control-alternative" id="grade" name="grade" >
                                    <option selected>{{$subject->grade}}</option>
                                    <option value="Grade 1">Grade 1</option>
                                    <option value="Grade 2">Grade 2</option>
                                    <option value="Grade 3">Grade 3</option>
                                    <option value="Grade 4">Grade 4</option>
                                    <option value="Grade 5">Grade 5</option>
                                    <option value="Grade 6">Grade 6</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="table">
                          <table class="table align-items-center table-flush">
                            <thead>
                              <tr>
                                <th scope="col">Class Name</th>
                                <th scope="col" style="width: 70%">Teacher Name</th>
                                <th style="width: 5%">
                                  <div class="col-lg-6 col-5 text-right">
                                    <a href="#AddNewClassToSubject{{$subject->id}}" data-toggle="modal" class="btn btn-sm btn-neutral">Add Class</a>
                                  </div>
                                </th>
                              </tr>
                            </thead>
                            <tbody>           
                              <?php $teacherclasses = App\Models\Subject_details::where('subject_id',$subject->id)->get();?>
                                @foreach($teacherclasses as $teacherclass)
                                  {{-- @if($student->classlist_id == $class->id) --}}
                                    <tr>
                                      <?php $subjclass = App\Models\Classlist::where('id',$teacherclass->classlist_id)->first()->class_name;
                                            $subteacher = App\Models\Teacher::where('id',$teacherclass->teacher_id)->first()->name;
                                            $teacher = App\Models\Teacher::all();
                                      ?>
                                      <td>
                                          <input name='idlist[]' style="display: none" value="{{$teacherclass->id}}">
                                          <input class="form-control form-control-alternative" type="text" value="{{$subjclass}}" id="subject_class" name="subject_class" disabled>
                                      </td>
                                      <td style="width: 70%">
                                          <select class="form-control form-control-alternative" id="subjectteacher" name="subjectteacher[]"> 
                                            <option selected>{{$subteacher}}</option>
                                            @foreach($teacher as $teacher)
                                              <option value="{{$teacher->name}}">{{$teacher->name}}</option>
                                            @endforeach
                                          </select>
                                      </td>
                                      <td style="width: 5%">
                                        <div class="text-center">
                                          <a href="#deleteClassSubject{{$teacherclass->id}}" data-toggle="modal">
                                            <button class="btn btn-sm btn-primary"><i class="fa fa-trash"></i></button>
                                          </a>
                                          @include('subjects.actionsubject')
                                        </div>
                                      </td>
                                    </tr>
                                  {{-- @endif --}}
                                @endforeach          
                            </tbody>
                          </table>
                          </div>
                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                        </div>
                      </form>
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save changes</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  <!-- Add New Class to Subject Modal -->
<div class="modal fade" id="AddNewClassToSubject{{$subject->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Add new class</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{route('subjects.storeclass')}}">
        @csrf
      <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label class="form-control-label">Class Name</label>
                <input type="text" name="subjectid" value="{{$subject->id}}" style="display: none">
                <select class="form-control form-control-alternative" id="class_name" name="class_name" >
                    <option selected>Select Class</option>
                    <?php $classlists = App\Models\Classlist::all() ?>
                    @foreach($classlists as $classlist)
                      <option value="{{$classlist->id}}">{{$classlist->class_name}}</option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label class="form-control-label">Teacher Name</label>
                <select class="form-control form-control-alternative" id="teacher_name" name="teacher_name" >
                    <option selected>Select Teacher</option>
                    <?php $teachers = App\Models\Teacher::all() ?>
                    @foreach($teachers as $teacher)
                      <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>
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