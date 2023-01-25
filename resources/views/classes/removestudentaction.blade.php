{{-- Remove student Modal --}}
<div class="modal fade" id="removeStudent{{$student->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title" id="myModalLabel">Remove Student</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="POST" action="{{route('removeStudent',$student->id)}}">
            @csrf
            @method('PUT')
          <div class="modal-body">
              <h4 class="text-wrap text-center">Are you sure to remove {{$student->name}} from this class?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Delete</button>
          </div>
        </form>
      </div>
    </div>
</div>