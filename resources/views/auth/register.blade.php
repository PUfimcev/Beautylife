@extends('auth.layouts.app')

@section('title', __('Register'))

@section('content')
<div class="container">
    <div class="card_profile d-flex flex-column justify-content-center align-items-center">
        <div class="register-headbar d-flex justify-content-between align-items-center">
            <a class="headbar-brand__logo" href="{{ route('index') }}">BLife</a>
        </div>
        <div class="card__mine">

            <h2 class="card-header">{{ __('Register') }}</h2>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="register_name mb-1">
                        <label for="name" class="col-form-label text-md-end">{{ __('Name or nickname') }}</label>
                        <div class="register__name_input">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="{{ __('Name or nickname') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="register_email mb-1">
                        <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <div class="register__email_input">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ __('Email Address') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="register_password mb-1">
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
                    <div class="register_password mb-4">
                        <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                        <div class="password_input d-flex flex-column justify-content-between align-items-center">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                            <div class="password-control"></div>
                        </div>
                    </div>
                    @if(config('services.recaptcha.key'))
                        <div class="g-recaptcha mb-1" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                        @error('g-recaptcha-response')
                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                        @enderror
                    @endif
                    <div class="row mt-3 mb-0">
                        <div class="register__button">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                    @if (Route::has('login'))
                        <a class="register__link-to-login" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
