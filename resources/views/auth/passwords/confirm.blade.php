@extends('auth.layouts.app')

@section('title', __('Confirm Password'))

@section('content')
<div class="container">
    <div class="card_profile d-flex flex-column justify-content-center align-items-center">
        <div class="card-headbar d-flex justify-content-between align-items-center">
            <a class="headbar-brand__logo" href="{{ route('index') }}">BLife</a>
        </div>
        <div class="card__mine">
            <h2 class="card-header">{{ __('Confirm Password') }}</h2>
            <div class="card-body">
                {{ __('Please confirm your password before continuing.') }}
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div class="confirm__password mb-3">
                        <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                        <div class="password_input d-flex flex-column justify-content-between align-items-center">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                            <div class="password-control"></div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="confirm__button">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Confirm Password') }}
                            </button>
                            @if (Route::has('password.request'))
                                <a class="confirm__password_request btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
