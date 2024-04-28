@extends('layouts.index')

@section('title', __('No admin'))

@section('content')
    <div class="container noAdmin">
        <div class="noAdmin__content">
            <h3>{{ __('You don\'t have administrator\'s rights') }}!</h3>
            <p>{{ __('Please enter correct credentials') }}<a class="headbar__login login" href="{{ route('to_login') }}">{{ __('Login') }}.</a></p>
            <p>{{ __('or return')}}<a class="headbar__login login" href="{{ route('index') }}">{{ __('to the Main page') }}.</a></p>

        </div>
    </div>
@endsection
