@extends('auth.layouts.app')

@section('title', __('Verify Your Email Address'))

@section('content')
<div class="container">
    <div class="card_profile d-flex flex-column justify-content-center align-items-center">
        <div class="card-headbar d-flex justify-content-between align-items-center">
            <a class="headbar-brand__logo" href="{{ route('index') }}">BLife</a>
        </div>
        <div class="card__mine">
            <h2 class="card-header">{{ __('Verify Your Email Address') }}</h2>
            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <form class="verify__button d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
