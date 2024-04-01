@extends('auth.layouts.app')

@section('title', __('Reset Password'))

@section('content')
<div class="container">
    <div class="card_profile d-flex flex-column justify-content-center align-items-center">
        <div class="card-headbar d-flex justify-content-between align-items-center">
            <a class="headbar-brand__logo" href="{{ route('index') }}">BLife</a>
            <a class="navbar__cancel-icon" href="{{ route ('index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
            </svg></a>
        </div>
        <div class="card__mine">
            <H2 class="card-header">{{ __('Reset Password') }}</H2>
            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="login__email mb-1">
                        <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <div class="login__email_input">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus placeholder="{{ __('Email Address') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="login__password mb-1">
                        <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                        <div class="password_input d-flex flex-column justify-content-between align-items-center">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="{{ __('Password') }}">
                            <div class="password-control"></div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="confirm__password mb-3">
                        <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                        <div class="password_input d-flex flex-column justify-content-between align-items-center">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                            <div class="password-control"></div>
                        </div>
                    </div>
                    @if(config('services.recaptcha.key'))
                        <div class="g-recaptcha mb-1" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                        @error('g-recaptcha-response')
                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                        @enderror
                    @endif
                    <div class="row my-3 mb-0">
                        <div class="login__button">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
