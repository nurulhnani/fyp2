<!--Unarchive Modal -->
<div class="modal fade" id="unarchiveTeacher{{$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="archiveModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="/unarchiveTeacher/{{$teacher['id']}}" method="POST">
            @csrf
            @method('PUT')
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Unarchive Teacher Profile</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="text-center">Are you sure to unarchive {{$teacher->name}}'s profile?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
        </form>
      </div>
    </div>
  </div>