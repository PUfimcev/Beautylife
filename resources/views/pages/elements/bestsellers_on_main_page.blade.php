<div class="bestseller__element element_{{ $i }}">

    @if ($i == 3)

        <a href="{{ route('catalog_top_new', 'bestsellers') }}" class="get__all__bestsellers" title="{{ __('Get all bestsellers') }}">{{ __('see more') }}</a>

    @endif

    <a  class="bestseller__elem_on_main-page bestseller_{{ $i }}" href="{{-- route('products', $product) --}}"  title="{{-- $product->langField('title') --}}">
        <div class="bestseller__elem_on_main-page_top">


            {{-- @if(isset($offer->image_route) && !empty($offer->image_route))
                <img class="image" src="{{ asset('storage/'.$offer->image_route) }}" alt="{{ $offer->langField('title') }}">
            @endif --}}

            <span class="product__tag">Top</span>

            <div class="product__evaluation"><span class="star"></span><span>5.0{{-- $review->evaluation --}}</span></div>

            <img class="image" src="{{-- asset('storage/'.$product->image_route) --}}" alt="{{-- $product->langField('title') --}}">

            <div class="product-action">
                <span

                @guest

                    onclick="event.preventDefault();
                    window.location.href = '{{ route('login') }}';"
                @endguest
                @auth
                    @if (Auth::user()->isAdmin()) onclick="event.preventDefault();"
                    @else
                        onclick="event.preventDefault();

                        document.getElementById('add_product_bookmarks').submit();"
                    @endif
                @endauth
                    class="send_to_bookmarks"></span>
                <span
                    onclick="event.preventDefault();

                        document.getElementById('add_product_basket').submit();"
                class="send_to_basket"></span>
            </div>

        </div>
        <div class="bestseller__elem_on_main-page__content">

            <p class="text">Uriage Local application paste for oily and problematic skin Hyseac pate sos soin local</p>
            <div class="price">
                @isset($product->discount)
                    <p class="discount-price">$ 17.00</p>
                @endisset

                <p class="total-price"  @isset($product->discount) style="text-decoration-line: line-through; opacity: 0.5" @endisset>$ 25.00</p>

                <p class="text-line"></p>
            </div>
        </div>
    </a>

    <form id="add_product_bookmarks" action="{{ route('person.bookmarks_add') }}" method="POST" style="display: none">
        @csrf
    </form>
    <form id="add_product_basket" action="{{ route('basket_add') }}" method="POST" style="display: none">
        @csrf
    </form>

</div>




