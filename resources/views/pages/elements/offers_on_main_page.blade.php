<a href="{{ route('offers', $offer->slug) }}" class="offer__elem_on_main-page offer_{{ $i }}"  title="{{ __('Get full offer') }}">
    <div class="offer__elem_on_main-page_top">


        {{-- @if(isset($offer->offer_image_route) && !empty($offer->offer_image_route))
            <img class="image" src="{{ asset('storage/'.$offer->offer_image_route) }}" alt="{{ __('Image') }}">
        @endif --}}

    </div>
    <div class="offer__elem_on_main-page__content">

        <div class="text">
            <h3 class="offer_title">{{ $offer->langField('title') }}<span class="get__full__blog-btn-arrow"></span></h3>
            <p  class="offer__about">{{ __('') }}</p>
        </div>
    </div>
</a>
