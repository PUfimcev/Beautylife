@extends('layouts.index')

@section('title', __('Bookmarks'))

@section('content')
    <div class="container">

        <div id="bookmarks">

            <h2 class="bookmarks__title">{{ __('Bookmarks') }}</h2>
            @forelse ($wares as $ware)

            <h3>{{ $ware->name  }}</h3>

            @empty
                <div class="no_bookmarks d-flex flex-column justify-content-center align-items-center">
                    <h2>{{ __('Your bookmarks\'re absent') }}</h2>

                    <p>{{ __('Go back to') }} <a class="no_bookmarks-allusion" href="{{ route('catalog') }}">{{ __('Catalog') }}</a> {{ __('and take your pick') }}</p>
                </div>
            @endforelse


        </div>


    </div>

@endsection
