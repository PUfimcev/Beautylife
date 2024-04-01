@extends('layouts.index')

@section('title', __('Order history'))

@section('content')
    <div class="container">

        <div id="order__history">

            <h2 class="order__history__title">{{ __('Order history') }}</h2>
            @forelse ($wares as $ware)

            <h3>{{ $ware->name  }}</h3>

            @empty
                <div class="no_order__history d-flex flex-column justify-content-center align-items-center">
                    <h2>{{ __('Your order history\'s empty') }}</h2>

                    <p>{{ __('Go back to') }} <a class="no_order__history-allusion" href="{{ route('catalog') }}">{{ __('Catalog') }}</a> {{ __('and take your pick') }}</p>
                </div>
            @endforelse


        </div>


    </div>

@endsection
