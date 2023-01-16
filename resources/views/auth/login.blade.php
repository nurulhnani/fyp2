<style>
    .bg-mescore{
        background-color: #F0D9FF;
    }
</style>
@extends('layouts.app', ['class' => 'bg-mescore'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--9 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-3">
                        <div class="text-muted text-center mt-2 mb-3"><h3>{{ __('Log in with') }}</h3></div>
                        {{-- <h4 class="text-muted text-center">Sign in with</h4> --}}
                        {{-- <div class="text-muted text-center mt-2 mb-3"><small>{{ __('Sign in with') }}</small></div>
                        <div class="btn-wrapper text-center">
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="{{ asset('argon') }}/img/icons/common/github.svg"></span>
                                <span class="btn-inner--text">{{ __('Github') }}</span>
                            </a>
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="{{ asset('argon') }}/img/icons/common/google.svg"></span>
                                <span class="btn-inner--text">{{ __('Google') }}</span>
                            </a>
                        </div> --}}
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        {{-- <div class="text-center text-muted mb-4">
                            <small>
                                    Create new account OR Sign in with these credentials:
                                    <br>
                                    Username <strong>admin@argon.com</strong> Password: <strong>secret</strong>
                            </small>
                        </div> --}}
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                {{-- {{ $errors->has('email') ? ' has-danger' : '' }}  --}}
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    {{-- {{ $errors->has('email') ? ' is-invalid' : '' }} --}}
                                    <input class="form-control" placeholder="{{ __('NRIC/Mykid') }}" type="text" name="email" value="" required autofocus>
                                </div>
                                {{-- @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif --}}
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" value="" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheckLogin">
                                    <span class="text-muted">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Login') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col text-center">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-primary">
                                <small>{{ __('Forgot password?') }}</small>
                            </a>
                        @endif
                    </div>
                    {{-- <div class="col-6 text-right">
                        <a href="{{ route('register') }}" class="text-primary">
                            <small>{{ __('Create new account') }}</small>
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
