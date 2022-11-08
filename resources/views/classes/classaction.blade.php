{{-- View Class Modal --}}
<div class="modal fade" id="viewClass{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="viewClass" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalCenterTitle">{{$class->class_name}}</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table">
            <thead>
              <tr>
                <th scope="col">Student Name</th>
                <th scope="col">Mykid</th>
                <th scope="col">Gender</th>
              </tr>
            </thead>
            <tbody>           
                @foreach($student as $student)
                  @if($student->classlist_id == $class->id)
                    <tr>
                      <th scope="row">{{$student->name}}</th>
                      <td>{{$student->mykid}}</td>
                      <td>{{$student->gender}}</td>
                    </tr>
                  @endif
                @endforeach          
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Delete Modal --}}
<div class="modal fade" id="delete{{$class->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel">Delete Class</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="{{route('classes.destroy',$class->id)}}">
          @csrf
        @method('delete')
        <div class="modal-body">
            <h4 class="text-center">Are you sure to delete {{$class->class_name}}?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>