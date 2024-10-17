<div class="new_arrival__element element_{{ $i }}">

    <a  class="new_arrival__elem_on_main-page new_arrival_{{ $i }}" href="{{-- route('products', $product) --}}"  title="{{-- $product->langField('title') --}}">
        <div class="new_arrival__elem_on_main-page_top">


            {{-- @if(isset($offer->image_route) && !empty($offer->image_route))
                <img class="image" src="{{ asset('storage/'.$offer->image_route) }}" alt="{{ $offer->langField('title') }}">
            @endif --}}

            <span class="product__tag">New</span>
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
                        // console.log(`Product added bookmarks`);
                        document.getElementById('add_product_bookmarks').submit();"
                    @endif
                @endauth
                    class="send_to_bookmarks"></span>
                <span
                    onclick="event.preventDefault();
                        // console.log(`Product added basket`);
                        document.getElementById('add_product_basket').submit();"
                class="send_to_basket"></span>
            </div>

        </div>
        <div class="new_arrival__elem_on_main-page__content">

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
    @if ($i == 2)

        <a href="{{ route('catalog_top_new', 'new-arrivals') }}" class="get__all__new_arrivals" title="{{ __('Get all new arrivals') }}">{{ __('see more') }}</a>

    @endif

    <form id="add_product_bookmarks" action="{{ route('person.bookmarks_add') }}" method="POST" style="display: none">
        @csrf
    </form>
    <form id="add_product_basket" action="{{ route('basket_add') }}" method="POST" style="display: none">
        @csrf
    </form>

</div>


