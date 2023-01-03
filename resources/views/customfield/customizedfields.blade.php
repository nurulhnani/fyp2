@extends('layouts.adminapp')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--2">
    
        <h2 class="mt-4">Custom Field Configuration</h2>

        <div class="py-3">
            <div class="justify-content-md-center">
                <div class="card">
                    <div class="card-body">
                    {{-- <h3 class="card-title">Upload Student List</h3> --}}
                    <p class="card-text">Below is the list of added custom fields. You are allowed to manage them respectively.</p>
                      <hr class="my-3" />
                      <h4 class="heading-small text-muted text-center text-white bg-gradient-primary ">{{ __('Student') }}</h4>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                              <thead class="bg-secondary">
                                <tr>
                                  <th scope="col" style="width: 30%">Field Name</th>
                                  <th scope="col" style="width: 30%">Type</th>
                                  <th scope="col" style="width: 30%">Description</th>
                                  <th style="width: 10%">
                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                                
                                @foreach ($customfields as $customfield)
                                  @if($customfield->user == "student")
                                <tr>
                                    <td style="width: 30%">{{$customfield->name}}</td>
                                    <td style="width: 30%">{{$customfield->type}}</td>
                                    <td style="width: 30%">
                                        @if ($customfield->dropdownNote == null)
                                            -
                                        @else
                                            {{$customfield->dropdownNote}}
                                        @endif
                                    </td>
                                    <td style="width: 10%">
                                        <div class="col-lg-6 col-5 text-right mb-0">
                                            <a href="#editFields{{$customfield->id}}" data-toggle="modal">
                                              <button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="#deleteFields{{$customfield->id}}" data-toggle="modal">
                                              <button class="btn btn-sm btn-primary"><i class="fa fa-trash"></i></button>
                                            </a>
                                            @include('customfield.customfieldaction')
                                          </div>
                                    </td>
                                </tr> 
                                  @endif    
                                @endforeach               
                              </tbody>
                            </table>
                          </div>


                        {{-- <hr class="my-3" /> --}}
                        <h4 class="heading-small text-muted text-center text-white bg-gradient-primary ">{{ __('Teacher') }}</h4>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                              <thead class="bg-secondary">
                                <tr>
                                  <th scope="col" style="width: 30%">Field Name</th>
                                  <th scope="col" style="width: 30%">Type</th>
                                  <th scope="col" style="width: 30%">Description</th>
                                  <th style="width: 10%">
                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                                
                                @foreach ($customfields as $customfield)
                                  @if($customfield->user == "teacher")
                                <tr>
                                    <td style="width: 30%">{{$customfield->name}}</td>
                                    <td style="width: 30%">{{$customfield->type}}</td>
                                    <td style="width: 30%">
                                        @if ($customfield->dropdownNote == null)
                                            -
                                        @else
                                            {{$customfield->dropdownNote}}
                                        @endif
                                    </td>
                                    <td style="width: 10%">
                                        <div class="col-lg-6 col-5 text-right mb-0">
                                            <a href="#editFields{{$customfield->id}}" data-toggle="modal">
                                              <button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="#deleteFields{{$customfield->id}}" data-toggle="modal">
                                              <button class="btn btn-sm btn-primary"><i class="fa fa-trash"></i></button>
                                            </a>
                                            @include('customfield.customfieldaction')
                                          </div>
                                    </td>
                                </tr> 
                                  @endif    
                                @endforeach               
                              </tbody>
                            </table>
                          </div>

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