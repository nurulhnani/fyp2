<!--Edit Modal -->
<div class="modal fade" id="edit{{$merits->id}}" tabindex="-1" role="dialog" aria-labelledby="editQuestion" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="{{route('meritPoints.update', $merits->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Edit Merit Point</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-left">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label class="form-control-label" for="input-name">{{ __('Achievement') }}</label>
                <input type="text" name="achievement" id="question" class="form-control form-control-alternative" value="{{$merits->achievement}}" autofocus>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label class="form-control-label" for="input-name">{{ __('Merit Points') }}</label>
                <input type="number" min="0" max="30" name="merit_points" id="question" class="form-control form-control-alternative" value="{{$merits->merit_points}}" autofocus>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--Delete Modal -->
<div class="modal fade" id="delete{{$merits->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title" id="myModalLabel">Delete Merit Point</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="POST" action="{{route('meritPoints.destroy', $merits->id)}}">
            @csrf
            @method('delete')
          <div class="modal-body">
              <h4 class="text-center">Are you sure to delete this merit points?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Add Modal -->