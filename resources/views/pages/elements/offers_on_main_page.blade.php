<div  class="offer__elem_on_main-page offer_{{ $i }}">
    <div class="offer__elem_on_main-page_top">


        @if(isset($offer->image_route) && !empty($offer->image_route))
            <img class="image" src="{{ asset('storage/'.$offer->image_route) }}" alt="{{ $offer->langField('title') }}">
        @endif

    </div>
    <div class="offer__elem_on_main-page__content">

        <div class="text">
            <a href="{{ route('offers', $offer) }}" title="{{ $offer->langField('title') }}"><h3 class="offer_title">{{ $offer->langField('title') }}</h3><span class="get__full__offer-btn-arrow"></span></a>
            <p  class="offer__about">{{ $offer->langField('about') }}</p>
        </div>
    </div>
</div>

