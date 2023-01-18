<!-- Filter Modal -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="GET">
                    <div class="form-row">
                        <label style="font-size:14px" for="inputCity">Class</label>
                        <select id="inputState" class="form-control custom-select" name="class">
                            <option value="" selected disabled hidden>Choose...</option>
                            @foreach ($classes as $class)
                            <option value="<?php echo $class->id ?>">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row pt-3">
                        <label style="font-size:14px" for="inputState">Year</label>
                        <select id="inputState" class="form-control custom-select" name="year">
                            <option value="" selected disabled hidden>Choose...</option>
                            @foreach ($years as $index => $year)
                            <option value="<?php echo $year ?>">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <button type="submit" class="btn btn-sm btn-secondary float-right mt-3">School Overview</button> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>

        </div>
    </div>
</div>