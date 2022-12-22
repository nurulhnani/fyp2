 {{-- Delete Modal --}}
 <div class="modal fade" id="deleteFields{{$customfield->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title" id="myModalLabel">Delete Field</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="POST" action="{{ route('deleteField',$customfield->id) }}">
            @csrf
            @method('delete')
          <div class="modal-body">
              <h4 class="text-center">Are you sure to delete {{$customfield->name}}?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>

{{-- Edit Modal --}}
<div class="modal fade" id="editFields{{$customfield->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title" id="myModalLabel">Edit Field</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="POST" action="{{ route('editField',$customfield->id) }}">
            @csrf
            @method('put')
          <div class="modal-body text-left">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="form-control-label" for="input-name">{{ __('User') }}</label>
                        <select class="form-control form-control-alternative" name="user" id="user" required> 
                                <option value="{{$customfield->user}}" selected>{{$customfield->user}}</option>
                                <option value="Student">Student</option>
                                <option value="Teacher">Teacher</option>
                        </select>
                    </div>
                </div>
              </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" class="form-control form-control-alternative" placeholder="{{ __('Name') }}" value="{{$customfield->name}}" required>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="category" class="form-control-label" >Category</label>
                        <select class="form-control form-control-alternative" name="type" id="type" onchange="EnableDisableTextBox(this)" required> 
                            <option value="{{$customfield->type}}" selected>{{$customfield->type}}</option>
                            <option value="Text">Text</option>
                            <option value="Date">Date</option>
                            <option value="File">File</option>
                            <option value="Number">Number</option>
                            <option value="Dropdown">Dropdown</option>
                        </select>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                    <div>
                        <label for="description" class="form-control-label" >Description</label>
                        <?php 
                            if($customfield->dropdownNote == null){
                                $val = "-";
                            }else{
                                $val = $customfield->dropdownNote;
                            }
                        ?>
                        <input type="text" name="description" id="description" placeholder="Ex: blue,orange,yellow" value="{{$val}}" class="form-control form-control-alternative" disabled/>
                    </div>
                </div>
              </div>

              <script type="text/javascript">
                function EnableDisableTextBox(type) {
                    var selectedValue = type.options[type.selectedIndex].value;
                    var txtOther = document.getElementById("description");
                    txtOther.disabled = selectedValue == "Dropdown" ? false : true;
                    if (!txtOther.disabled) {
                        txtOther.disabled = false;
                        txtOther.value = "-";
                    }
                }
              </script>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Confirm</button>
          </div>
        </form>
      </div>
    </div>
  </div>