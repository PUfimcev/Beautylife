@extends('layouts.index')

@section('title', __('Shopping bag'))

@section('content')
    <div class="container">

        <div id="basket">

            <h2 class="basket__title">{{ __('Shopping bag') }}</h2>
            <div class="no_basket d-flex flex-column justify-content-center align-items-center">
                <h2>{{ __('Your shopping bag\'s empty') }}</h2>
                <p>{{ __('Go back to') }} <a class="no_basket-allusion" href="{{ route('catalog') }}">{{ __('Catalog') }}</a> {{ __('and take your pick') }}</p>
            </div>
        </div>


    </div>

@endsection
