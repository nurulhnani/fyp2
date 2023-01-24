<!-- Edit Merit Modal -->
<div class="modal fade" id="edit-modal{{$merit->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent">
                        <div class="text-muted text-center mt-2 mb-3">Merit Details</div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-4">
                        <form method="post" action="{{ route('behaMerits.update', $merit->id) }}" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Name</label>
                                    <input type="text" class="form-control" id="inputEmail4" value="{{ $student->name }}" readonly="true">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">NRIC/MyKid</label>
                                    <input type="text" class="form-control" id="inputPassword4" name="student_mykid" value="{{ $student->mykid }}" readonly="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="required-field" for="inputAddress">Merit Event</label>
                                <input name="merit_name" type="text" class="form-control" id="inputAddress" value="{{ $merit->merit_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Description</label>
                                <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="5">{{ $merit->desc }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label class="required-field" for="inputCity">Level</label>
                                    <?php $level = $merit['level']; ?>
                                    <select id="inputState" class="form-control" name="level" required>
                                        <option value="Low" <?php if ($level == "Low") echo 'selected="selected"'; ?>>Low</option>
                                        <option value="Medium" <?php if ($level == "Medium") echo 'selected="selected"'; ?>>Medium</option>
                                        <option value="High" <?php if ($level == "High") echo 'selected="selected"'; ?>>High</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="required-field" for="inputZip">Date</label>
                                    <input name="date" type="date" class="form-control" id="inputZip" value="<?php echo strftime('%Y-%m-%d', strtotime($merit['date'])); ?>" required>
                                </div>

                            </div>
                            <div class="modal-footer nopadding">
                                <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary ml-auto">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Merit Modal -->
<div class="modal fade" id="delete-modal{{$merit->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent">
                        <div class="text-muted text-center mt-2 mb-2">Alert</div>
                    </div>
                    <form method="post" action="{{ route('behaMerits.destroy', $merit->id) }}" autocomplete="off">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body text-center mx-auto">
                            <p>Confirmation to delete <b>{{$merit->merit_name}}</b>? </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary ml-auto">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- Edit Demerit Modal -->
<div class="modal fade" id="edit-demerit-modal{{$merit->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent">
                        <div class="text-muted text-center mt-2 mb-3">Demerit Details</div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-4">
                        <form method="post" action="{{ route('behaMerits.update', $merit->id) }}" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Name</label>
                                    <input type="text" class="form-control" id="inputEmail4" value="{{ $student->name }}" readonly="true">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">NRIC/MyKid</label>
                                    <input type="text" class="form-control" id="inputPassword4" name="student_mykid" value="{{ $student->mykid }}" readonly="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="required-field" for="inputAddress">Demerit Event</label>
                                <input name="merit_name" type="text" class="form-control" id="inputAddress" value="{{ $merit->merit_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Description</label>
                                <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="5">{{ $merit->desc }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label class="required-field" for="inputCity">Level</label>
                                    <?php $level = $merit['level']; ?>
                                    <select id="inputState" class="form-control" name="level" required>
                                        <option value="Low" <?php if ($level == "Low") echo 'selected="selected"'; ?>>Low</option>
                                        <option value="Medium" <?php if ($level == "Medium") echo 'selected="selected"'; ?>>Medium</option>
                                        <option value="High" <?php if ($level == "High") echo 'selected="selected"'; ?>>High</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="required-field" for="inputZip">Date</label>
                                    <input name="date" type="date" class="form-control" id="inputZip" value="<?php echo strftime('%Y-%m-%d', strtotime($merit['date'])); ?>" required>
                                </div>

                            </div>
                            <div class="modal-footer nopadding">
                                <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="demerit" class="btn btn-primary ml-auto">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>