@extends('layouts.index')

@section('title', $offer->langField('title') )

@section('crumbs')
    <ul class="crumbs__list d-flex justify-content-start align-items-center gap-1">
        <li><a class="crumbs__reffers" href="{{ route('index') }}">{{ __('Main page')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><a class="crumbs__reffers" href="{{ route('offers') }}">{{ __('Offers')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><span>{{  $offer->langField('title') }}</span></li>
    </ul>
@endsection

@section('content')

<section class="full_offer">
    <a href="{{ route('offers') }}" class="link__to_offers">{{ __('Offers list') }}</a>

    <div class="full_offer_top">

        <div class="full_offer_head">


            @if(isset($offer->image_route) && !empty($offer->image_route))
                <img class="image" src="{{ asset('storage/'.$offer->image_route) }}" alt="{{ __('Offer picture') }}">
            @endif

        </div>
        <div class="full_offer_content">

            <div>

                <h3 class="offer_title">{{ $offer->langField('title')  }}</h3>

                <p class="offer_summary">{{ $offer->langField('about') }}</p>

                <p class="offer_description">@php echo html_entity_decode($offer->langField('description'));@endphp
                </p>
            </div>


        </div>


    </div>

    @isset($products)
        <h3>{{ __('Goods') }}</h3>

        <div class="full_offer_products">


            @forelse ($products as $product)
                {{-- @include('pages.elements.brand', ['brand' => $brand]) --}}
            @empty
                <p class="no__goods">{{ __('There are no goods') }}</p>
            @endforelse

            @if (!isset($products) || !empty($products))
                <div class="pagination">{{ $products->onEachSide(1)->links() }}</div>
            @endif

        </div>

    @endisset
</section>

@endsection
