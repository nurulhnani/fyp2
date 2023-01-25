@extends('layouts.adminapp')

@section('content')
    @include('layouts.headers.cards')
    
    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="header pb-3">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-7 col-7">
                        <h6 class="h2 text-black d-inline-block mb-0">Custom Field Configuration</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fas fa-home"></i></a></li>
                                {{-- <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">Student List</i></a></li> --}}
                                <li class="breadcrumb-item active" aria-current="page">Custom Field Configuration</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
    
        {{-- <h2 class="mt-4">Custom Field Configuration</h2> --}}

        {{-- <div> --}}
            <div class="justify-content-md-center">
                <div class="card">
                    <div class="card-body">
                    {{-- <h3 class="card-title">Upload Student List</h3> --}}
                    <p class="card-text">You can add any custom fields you need to idenitfy your students and teachers profile and manage them from this page.</p>
                    <hr class="my-3" />
                    <form method="POST" action="{{route('addmore')}}" name="add_type" id="add_type">
                        @csrf

                        <div class="row pt-3 py-3">
                            <div class="col-sm-6">
                                <div class="h5 text-muted text-uppercase">
                                    <i class="ni business_briefcase-24"></i>{{ __('Choose type of user') }}
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="{{route('showfields')}}" class="btn btn-sm btn-neutral">View Added Custom Fields</a>
                            </div>
                        </div>

                        {{-- <div class="h5 text-muted text-uppercase py-4">
                            <i class="ni business_briefcase-24"></i>{{ __('Choose type of user') }}
                        </div> --}}

                        <div class="row">
                            <div class="col-sm-12">
                                <div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="user" class="custom-control-input" value="student"> 
                                        <label class="custom-control-label" for="customRadioInline1">Student</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="user" class="custom-control-input" value="teacher">
                                        <label class="custom-control-label" for="customRadioInline2">Teacher</label>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-sm-6 text-right">
                                <a href="{{route('showfields')}}" class="btn btn-sm btn-neutral">View Added Custom Fields</a>
                            </div> --}}
                        </div>

                        <div class="row pt-5">
                            <div class="col-sm-12">
                                <div class="h5 text-muted text-uppercase">
                                    <i class="ni business_briefcase-24"></i>{{ __('Enter custom field details') }}
                                </div>
                            </div>
                            {{-- <div class="col-sm-6 text-right">
                                <a href="{{route('showfields')}}" class="btn btn-sm btn-neutral">View Added Custom Fields</a>
                            </div> --}}
                        </div>
                        
                        <div class="table-responsive text-center">
                            <table class="table align-items-center table-flush" id="dynamic_field">
                                <tr>
                                    <td><input type="text" name="name[]" placeholder="Enter Field Name" class="form-control form-control-alternative" required></td>
                                    <td>
                                        {{-- <div class="form-group"> --}}
                                            <select class="form-control form-control-alternative" name="type[]" id="type" onchange="onChange()" required> 
                                                <option selected disabled>Select Answer Field Type</option>
                                                    <option value="text">Text</option>
                                                    <option value="date">Date</option>
                                                    <option value="file">File</option>
                                                    <option value="number">Number</option>
                                                    <option value="dropdown">Dropdown</option>
                                            </select>
                                        {{-- </div> --}}
                                    </td>   
                                    <td><button type="button" name="add" id="add" id="add" class="btn btn-default" onclick="addOnclick()">Add More</button></td>
                                </tr>
                                <tr class="autoUpdate" style="display: none">
                                    <td><p>Please add option of answers.</p></td>
                                    <td>
                                        <input type="text" name="note[]" id="autoUpdate" placeholder="Ex: blue,orange,yellow" class="form-control form-control-alternative"/>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                            <div class="py-3">
                                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Save">
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        {{-- </div> --}}

        <script type="text/javascript">
            var i=1;
            function addOnclick(){
                i++;
                //add action to button Add to append more input field
                $('#dynamic_field').append(''+
                '<tr id="row'+i+'" class="dynamic-added">' +
                '<td><input type="text" name="name[]" placeholder="Enter Field Name" class="form-control form-control-alternative" /></td>' +
                '<td><select class="typenew form-control form-control-alternative" name="type[]" id="type'+i+'" onchange="onChange()"><option selected disabled>Select Answer Field Type</option><option value="Text">Text</option><option value="Date">Date</option><option value="File">File</option><option value="Dropdown">Dropdown</option></select></td>' +
                '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>'+
                '</tr>'+
                '<tr id="row'+i+'" class="autoUpdatenew" style="display: none">'+
                '<td><p>Please add option of answer.</p></td>' +
                '<td><input type="text" name="note[]" placeholder="Ex: blue,orange,yellow" class="form-control form-control-alternative"/></td>'+
                '<td></td>'+
                '</tr>');

                ///Action on button remove fields
                $(document).on('click','.btn_remove',function(){
                    var button_id = $(this).attr("id");
                    $('#row'+button_id+'').remove();
                });

                $(document).on('change','.typenew',function(){
                    // var button_id = $(this).attr("id");
                    $typenew = $('#type'+i).val();
                    if($typenew == 'dropdown'){
                        $(".autoUpdatenew").fadeIn('slow');
                    }else{
                        $(".autoUpdatenew").fadeOut('slow');
                    }                 
                }); 
            };

            function onChange(){
                $type = $("#type").val();
                if($type == 'dropdown'){
                    // var button_id = $(this).attr("id");
                    $(".autoUpdate").fadeIn('slow');
                }else{
                        $(".autoUpdate").fadeOut('slow');
                }   
            }   
            
        </script>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush