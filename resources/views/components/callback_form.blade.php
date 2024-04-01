@extends('components.component-layout.index')

@section('title', __('Callback form'))

@section('content')

<div class="container">
    <div class="card_profile row justify-content-center">
        <div class="register-headbar d-flex justify-content-between align-items-center">
            <a class="headbar-brand__logo" href="{{ route('index') }}">BLife</a>
            <a class="navbar__cancel-icon" @if ($prevUrl !== null)  href="{{ $prevUrl }}" @else style="display: none;" @endif><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
            </svg></a>
        </div>
        <div class="card__mine">

            <h2 class="card-header">{{ __('Callback form') }}</h2>
            <p class="callback__userdata_request">{{ __('Please, send us your name and phone number and we\'ll call you back.') }}</p>
            <div class="card-body">
                <form method="POST" action="{{ route('callbacks.store') }}">
                    @csrf
                    <div class="register_name mb-1">
                        <label for="name" class="col-form-label text-md-end">{{ __('Name') }}</label>
                        <div class="register__name_input">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="{{ __('Name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="register_phone-number mb-1">
                        <label for="phone" class="col-form-label text-md-end">{{ __('Phone number') }}</label>
                        <div class="register__phone-number_input">
                            <input id="phone" type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}"  autocomplete="phone" placeholder="+375 29 *** ** **">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="register__button">
                            <button type="submit" class="btn btn-primary">
                                {{ __('SUBMIT') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
