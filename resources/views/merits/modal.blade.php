<!-- Coco Modal -->
<div class="modal fade" id="currModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('merits.redirect') }}" autocomplete="off">
                    @csrf

                    <h6 class="text-center heading-small text-muted mb-4">{{ __('Give Merit to A Student') }}</h6>


                    <div class="pl-lg-4">

                        <div>
                            <input name="id" id="input-id" class="form-control form-control-alternative" placeholder="{{ __('NRIC/MyKid') }}">
                        </div>
                        <p class="card-text">
                        <h6 class="text-center heading-small">{{ __('OR') }}</h6>
                        </p>
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Full Name') }}">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Beha Modal -->
<div class="modal fade" id="behaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('merits.redirect') }}" autocomplete="off">
                    @csrf

                    <h6 class="text-center heading-small text-muted mb-4">{{ __('Give Merit to A Student') }}</h6>


                    <div class="pl-lg-4">

                        <div>
                            <input name="id" id="input-id" class="form-control form-control-alternative" placeholder="{{ __('NRIC/MyKid') }}">
                        </div>
                        <p class="card-text">
                        <h6 class="text-center heading-small">{{ __('OR') }}</h6>
                        </p>
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <input type="text" name="name" id="beha-input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Full Name') }}">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="behaForm" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- autocomplete -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    var route = "{{ url('autocomplete-search') }}";
    $('#input-name').typeahead({
        source: function(query, process) {
            return $.get(route, {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });

    var route1 = "{{ url('beha-autocomplete-search') }}";
    $('#beha-input-name').typeahead({
        source: function(query, process) {
            return $.get(route1, {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });
</script>