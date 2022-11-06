<!--View Subject Modal-->


  {{-- Edit Subject Modal --}}
  {{-- <div class="modal fade" id="editSubject{{$subject->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="exampleModalLabel">{{$subject->subject_name}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{route('subjects.update',$subject->id)}}">
          @method('patch')
          @csrf
        <div class="modal-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-form-label" style="padding-left: 10pt">Class Name</label>
                    <div class="col-sm-8" style="padding-left: 40pt">
                      <input type="text" class="form-control" id="class_name" name="class_name" value="{{$subject->class_name}}" disabled>
                    </div>
                  </div> --}}
                  {{-- <div class="form-group row">
                    <label class="col-form-label" style="padding-left: 10pt; padding-right: 8pt">Number of Student</label>
                        <div class="row">
                          <div class="col-8">
                            <input type="text" name="numOfStudent" id="numOfStudent" class="form-control" value="{{$class->numOfStudent}}">
                          </div>
                        </div>
                  </div> --}}
                  {{-- <div class="form-group row">
                    <label class="col-form-label" style="padding-left: 10pt; padding-right: 8pt">Teacher Name</label>
                    <select class="custom-select" style="height: 25pt; font-size:8pt; width:240pt" name="subject_teacher" id="subject_teacher">
                        <option selected>{{$subject->subject_teacher}}</option>
                        @foreach($teacher as $teacher)
                          <option value="{{$teacher->name}}">{{$teacher->name}}</option>
                        @endforeach
                    </select>
                  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div> --}}

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