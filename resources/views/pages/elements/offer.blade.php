<a class="offer" href="{{ route('offers', $offer) }}" title="{{ $offer->langField('title') }}">
    <div class="offer_head">


        @if(isset($offer->image_route) && !empty($offer->image_route))
            <img class="image" src="{{ asset('storage/'.$offer->image_route) }}" alt="{{ __('Offer picture') }}">
        @endif

    </div>
    <div class="offer_content">

        <h3 class="offer_title">{{ $offer->langField('title') }}</h3>

        <p class="offer_summary">{{ $offer->langField('about') }}</p>

    </div>
</a>
