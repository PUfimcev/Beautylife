@extends('layouts.index')

@section('title', __('about company'))
    
@section('crumbs')
    <ul class="crumbs__list d-flex justify-content-start align-items-center gap-1">
        <li><a class="crumbs__reffers" href="{{ route('index') }}">{{ __('Main page')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><span>{{ __('About company')}}</span></li>
    </ul>
@endsection

@section('content')
    <div class="container">

        <h1>About</h1>

    </div>
@endsection