{{-- Confirmation Decline Modal --}}
<div class="modal fade" id="declineReq{{$req->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title" id="myModalLabel">Decline Request</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="POST" action="{{route('storeApproval',$req->id)}}">
            @csrf
            @method('post')
          <div class="modal-body">
              <h4 class="text-center">Are you sure to decline this update request?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button name="decline" type="submit" class="btn btn-primary">Decline</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Confirmation Approve Modal --}}
<div class="modal fade" id="approveReq{{$req->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title" id="myModalLabel">Approval Request</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="POST" action="{{route('storeApproval',$req->id)}}">
            @csrf
            @method('post')
          <div class="modal-body">
              <h4 class="text-center">Are you sure to approve this update request?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button name="approve" type="submit" class="btn btn-success">Approve</button>
          </div>
        </form>
      </div>
    </div>
  </div>

