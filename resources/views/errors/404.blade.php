@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
@section('link')
    <div class="link__message"><span>BeautyLife:  </span><a class="headbar__login" href="{{ route('index') }}"> {{ __('to the Main page') }}</a></div>
@endsection
