<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <?php 
            $studentname =  auth()->user()->name; 
            $studentid = App\Models\Student::where('name',$studentname)->first()->id;
        ?>
        <a class="navbar-brand pt-0 pb-0" href="{{ route('studenthome',$studentid) }}">
            <img src="{{ asset('assets/img/userImage/mescore-dark.PNG')}}" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none ">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{asset('assets/img/userImage/'.auth()->user()->image_path)}}">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('student.home') }}">
                            <img src="{{ asset('assets/img/userImage/mescore-dark.PNG')}}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item bg-gradient-transparent">
                    <a href="#" class="nav-link">
                        <div class="profile-image">
                            @if(auth()->user()->image_path != null)
                            <img class="rounded-circle" style="width: 100%;height: 80%;" src="{{auth()->user()->image_path}}">
                            @else 
                            <img class="rounded-circle" style="width: 100%;height: 100%;" src="{{asset('assets/img/theme/default.png')}}">
                            @endif
                            {{-- <img class="rounded-circle" style="width: 100%;height: 80%;" src="{{asset('assets/img/userImage/'.auth()->user()->image_path)}}"> --}}
                        </div>
                        <div class="text-wrapper">
                            <p class="profile-name text-wrap" style="font-size: 10pt">{{auth()->user()->name}}</p>
                            <p class="designation" style="font-size: 10pt"><u>Student</u></p>
                        </div>
                    </a>
                </li>
                {{-- <li class="nav-item bg-gradient-primary">
                    <a href="#" class="nav-link">
                        <div class="profile-image">
                            <img class="rounded-circle" style="width: 100%;height: 80%;" src="{{asset('assets/img/userImage/'.auth()->user()->image_path)}}">
                        </div>
                        <div class="text-wrapper">
                            <p class="profile-name text-wrap" style="font-size: 10pt">{{auth()->user()->name}}</p>
                            <p class="designation" style="font-size: 10pt"><u>Student</u></p>
                        </div>
                    </a>
                </li> --}}
                <style>
                    .profile-image {
                        width: 30%;
                        height: 30%;
                        margin-right: 15px;
                        position: relative;
                    }
                    .dot-indicator {
                        width: 10px;
                        height: 10px;
                        border-radius: 100%;
                    }
                    .designation {
                        margin-bottom: 0;
                        font-weight: 400;
                        color: #000;
                    }
                    .profile-name {
                        margin-bottom: 5px;
                        font-weight: 500;
                        font-size: 15px;
                        color: #000;
                    }
                    .text-wrap {
                        white-space: normal !important;
                    }
                </style>
                <?php 
                    $studentname =  auth()->user()->name; 
                    $studentid = App\Models\Student::where('name',$studentname)->first()->id;
                ?>
                <li class="nav-item mt-3">
                    <a class="nav-link" href="{{route('studenthome',$studentid)}}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="ni ni-circle-08 text-blue"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Student Profile') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('viewstudentprofile')}}">
                                    {{ __('Student Details') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <?php 
                                    $studentname =  auth()->user()->name; 
                                    $studentid = App\Models\Student::where('name',$studentname)->first()->id;
                                ?>
                                <a class="nav-link" href="{{route('overview',$studentid)}}">
                                    {{ __('Student Overview') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('studentProfile-export',$studentid)}}">
                                    {{ __('Export Profile') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/foundation/colors.html">
                        <i class="ni ni-palette"></i> Foundation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/components/alerts.html">
                        <i class="ni ni-ui-04"></i> Components
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
