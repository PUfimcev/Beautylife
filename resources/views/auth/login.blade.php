@extends('auth.layouts.app')

@section('title', __('Login'))

@section('content')
<div class="container">
    <div class="card_profile d-flex flex-column justify-content-center align-items-center">
        <div class="card-headbar d-flex justify-content-between align-items-center">
            <a class="headbar-brand__logo" href="{{ route('index') }}">BLife</a>
            <a class="navbar__cancel-icon" @if ($prevUrl !== null)  href="{{ $prevUrl }}" @else style="display: none;" @endif><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
            </svg></a>
        </div>
        <div class="card__mine">

            <h2 class="card-header">{{ __('Login') }}</h2>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="login__email mb-1">
                        <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <div class="login__email_input">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="{{ __('Email Address') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="login__password mb-3">
                        <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                        <div class="password_input d-flex flex-column justify-content-between align-items-center">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="{{ __('Password') }}">
                            <div class="password-control"></div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="login__remember_me">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    @if(config('services.recaptcha.key'))
                        <div class="g-recaptcha mb-1" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                        @error('g-recaptcha-response')
                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                        @enderror
                    @endif

                    <div class="row mt-3 mb-0">
                        <div class="login__button">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <div >
                            @if (Route::has('password.request'))
                            <a class="login__password_request btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                        <div>
                            @if (Route::has('register'))
                                <a class="card__link-register" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
