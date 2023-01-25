{{-- Delete Class Subject --}}
<div class="modal fade" id="deleteClassSubject{{$teacherclass->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title" id="myModalLabel">Remove Class</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="POST" action="{{route('subjects.destroy',$teacherclass->id)}}">
            @csrf
          @method('delete')
          <div class="modal-body">
            <?php 
              $subjclass = App\Models\Classlist::where('id',$teacherclass->classlist_id)->first()->class_name;
              $subject = App\Models\Subject::where('id',$teacherclass->subject_id)->first()->subject_name;
              // $subteacher = App\Models\Teacher::where('id',$teacherclass->teacher_id)->first()->name;
              // $teacher = App\Models\Teacher::all();
            ?>
              <h4 class="text-center">Confirm to remove class {{$subjclass}} from {{$subject}}?</h4>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Confirm</button>
          </div>
        </form>
      </div>
    </div>
  </div>