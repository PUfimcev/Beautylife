@extends('layouts.index')

@section('title', __('Bookmarks'))

@section('content')
    <div class="container">

        <div id="bookmarks">

            <div class="no_bookmarks d-flex flex-column justify-content-center align-items-center">
                <h2>{{ __('Your bookmarks\'re absent') }}</h2>
                <p>{{ __('Go back to') }} <a class="no_bookmarks-allusion" href="{{ route('catalog') }}">{{ __('Catalog') }}</a> {{ __('and take your pick') }}</p>
            </div>

        </div>


    </div>

@endsection
