@extends('layouts.index')

@section('title', __('payments and delivery'))

@section('crumbs')
    <ul class="crumbs__list d-flex justify-content-start align-items-center gap-1">
        <li><a class="crumbs__reffers" href="{{ route('index') }}">{{ __('Main page')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><span>{{ __('Payments and delivery')}}</span></li>
    </ul>
@endsection

@section('content')

        <section class="conditions">

            <div class="payment_delivery">

                <h2>{{ __('Payments and delivery')}}</h2>

                <h3>{{ __('Payment') }}</h3>

                <p>{{ __('The order must be paid in cash or by credit card upon receipt at the point of issue or to the courier. A cash receipt is issued along with the order') }}.</p>

                <h3>{{ __('Pickup') }}</h3>

                <p>{{ __('You can pick up the goods yourself in our retail stores') }}:</p>
                <ul>
                    <li>{{ __('In the shopping center "Galleria Minsk", Minsk, Pobediteley 9, 2nd floor. 10:00 - 22:00 daily') }}.</li>
                    <li>{{ __('In the shopping center "Corona City", Minsk, st. Denisovskaya, 8, 1st floor. 10:00 - 21:00 daily') }}.</li>
                </ul>

                <h3>{{ __('Delivery by courier within the city') }}</h3>

                <p>{{ __('We provide prompt delivery throughout the city by courier from 12.00 to 18.00') }}.</p>

                <p>{{ __('Orders placed before 12:00 are delivered on the same day (or another day of your choice). If orders were placed after 12:00, delivery will be made the next day') }}.</p>

                <p>{{ __('Coordination and confirmation of the order is carried out 10:00 - 17:30 - Mon-Fri') }}.</p>


                <h3>{{ __('Cost of delivery') }}</h3>

                <p>{{ __('Pickup from our stores is free') }}.</p>
                <p>{{ __('Delivery by courier - 5$. When ordering from 50$. - for free') }}.</p>

            </div>
        </section>


@endsection
