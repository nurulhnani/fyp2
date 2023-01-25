@extends('layouts.adminapp')

@section('content')
@include('layouts.headers.cards')

<!-- Header -->
<div class="header pb-3">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-7 col-7">
                    <h6 class="h2 text-black d-inline-block mb-0">Manage Assessment</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fas fa-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">Student List</i></a></li> --}}
                            <li class="breadcrumb-item active" aria-current="page">Manage Assessment</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <p class="card-text mb-2">This section is to manage Interest Inventory Evaluation which is evaluated by the school teachers. You are allowed to add, edit, and delete the questions on the evaluation.</p>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <h3>List of Questions</h3>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="#AddNewQuestion" data-toggle="modal" class="btn btn-sm btn-neutral">Add New Question</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="myTable">
                            <thead class="thead-light">
                              <tr>
                                <th scope="col">Questions</th>
                                <th scope="col">Category</th>
                                <th scope="col" style="width: 10%"></th>
                              </tr>
                            </thead>
                            <tbody class="list">
                              @foreach ($questions as $question)
                                  <tr>
                                    <th scope="row">{{ $question->questions }}</th>
                                    <td id="category">{{ $question->category }}</td>
                                    <td style="width: 10%">
                                      <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                          <a class="dropdown-item" href="#editQuestion{{$question->id}}" data-toggle="modal">Edit Question</a>
                                          <a class="dropdown-item" href="#deleteQuestion{{$question->id}}" data-toggle="modal">Delete Question</a>
                                        </div>
                                        @include('assessment.assessmentaction')
                                      </div>

                                      {{-- <div class="col-lg-6 col-5 text-right mb-0">
                                        <a href="#editQuestion{{$question->id}}" data-toggle="modal"><button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button></a>
                                        <a href="#deleteQuestion{{$question->id}}" data-toggle="modal"><button class="btn btn-sm btn-primary"><i class="fa fa-trash"></i></button></a>
                                        @include('assessment.assessmentaction')
                                      </div> --}}
                                    </td>
                                  </tr>
                              @endforeach
                              <style>
                                .nopadding {
                                    padding: 0 !important;
                                    margin: 0 !important;
                                }
                                #myTable {
                                    border-collapse: collapse;
                                    /* Collapse borders */
                                    width: 100%;
                                    /* Full-width */
                                    border: 1px solid #ddd;
                                    /* Add a grey border */
                                    font-size: 18px;
                                    /* Increase font-size */
                                }

                                #myTable th,
                                #myTable td {
                                    text-align: left;
                                    /* Left-align text */
                                    padding: 12px;
                                    /* Add padding */
                                }

                                #myTable tr {
                                    /* Add a bottom border to all table rows */
                                    border-bottom: 1px solid #ddd;
                                }

                                #myTable tr.header,
                                #myTable tr:hover {
                                    /* Add a grey background color to the table header and on hover */
                                    background-color: #f1f1f1;
                                }
                            </style>
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                          <ul class="pagination justify-content-end mb-0">
                            {{$questions->links()}}
                          </ul>
                        </nav>
                      </div>

                </div>
                
                
            </div>
        </div>

<!--Add New Class Modal -->
<div class="modal fade" id="AddNewQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title font-weight-bold" id="exampleModalLabel">Add New Question</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('addquestion')}}" method="POST" id="AddNewQuestion">
        @csrf
        {{-- @method('PUT') --}}
        <div class="modal-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="form-control-label" for="input-name">{{ __('Question') }}</label>
                        <input type="text" name="question" id="question" class="form-control form-control-alternative" placeholder="{{ __('Question') }}" value="" autofocus>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="category" class="form-control-label" >Category</label>
                        <select class="form-control form-control-alternative" name="category" id="category">
                            <option value="" selected>Select Category</option>
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
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>
        
    </div>
    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush