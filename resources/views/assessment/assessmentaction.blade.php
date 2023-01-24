<!--Edit Modal -->
<div class="modal fade" id="editQuestion{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="editQuestion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="{{route('editassessment',$question->id)}}" method="POST">
            @csrf
            @method('PUT')
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Edit Question</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-left">
        {{-- <form action="{{ route('editassessment',$question->id) }}" method="POST"> --}}
        {{-- @csrf --}}
        {{-- @method('PUT') --}}

          <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-control-label" for="input-name">{{ __('Question') }}</label>
                    <input type="text" name="question" id="question" class="form-control form-control-alternative" placeholder="{{ __('Question') }}" value="{{$question->questions}}" autofocus>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="category" class="form-control-label" >Category</label>
                    <select class="form-control form-control-alternative" name="category" id="category">
                        <option value="{{$question->category}}" selected>{{$question->category}}</option>
                        <option value="Realistic">Realistic</option>
                        <option value="Investigative">Investigative</option>
                        <option value="Artistic">Artistic</option>
                        <option value="Social">Social</option>
                        <option value="Enterprising">Enterprising</option>
                        <option value="Conventional">Conventional</option>
                    </select>
                </div>
            </div>
          </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteQuestion{{$question->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title" id="myModalLabel">Delete Question</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="POST" action="{{route('deletequestion',$question->id)}}">
            @csrf
            @method('delete')
          <div class="modal-body">
              <h4 class="text-center">Are you sure to delete this question?</h4>
              <h4 class="text-center" style="font-style:italic; color:brown">{{$question->questions}}</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Confirm</button>
          </div>
        </form>
      </div>
    </div>
  </div>

