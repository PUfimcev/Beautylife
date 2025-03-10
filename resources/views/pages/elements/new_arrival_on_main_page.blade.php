<div class="new_arrival__element element_{{ $i }}">

    <a  class="new_arrival__elem_on_main-page new_arrival_{{ $i }}" href="{{ route('product', [$product->getCategory(), $product->getSubcategory(), $product]) }}"  title="{{ $product->langField('name') }}">

        <div class="new_arrival__elem_on_main-page_top" >

            <span class="product__tag">
                @if ($product->isNew())<span>New</span>@endif
                @if ($product->isSale())<span>Sale</span>@endif
            </span>

            @if($product->productImages->count() > 0)

                <img class="product__image" src="{{ asset('storage/'.$product->productImages[0]->route) }}" alt="{{ __('Image') }}" />

            @else
                <span class="no_picture">{{ __('No picture') }}</span>
            @endif

            <div class="product-action">
                <span

                @guest

                    onclick="event.preventDefault();
                    window.location.href = '{{ route('login') }}';"
                @endguest
                @auth
                    @if (Auth::user()->isAdmin() || $product->isProductInBookmark())
                        onclick="event.preventDefault();"

                    @else
                        onclick="event.preventDefault();

                        document.getElementById('add_product_bookmarks_{{ $i }}').submit();"
                    @endif
                @endauth
                    class="send_to_bookmarks @auth
                        @if ($product->isProductInBookmark())
                            active
                        @endif
                    @endauth"></span>
                <span
                    @if ($product->amount > 0 && !$product->isProductInBasket())
                        onclick="event.preventDefault(); document.getElementById('add_product_basket_{{ $i }}').submit();"
                    @else
                        onclick="event.preventDefault();"
                    @endif
                class="send_to_basket @if ($product->isProductInBasket()) active @endif"></span>
            </div>

        </div>
        <div class="new_arrival__elem_on_main-page__content">

            <p class="text">{{ $product->langField('name') }}</p>
            <div class="price">
                @if($product->amount > 0)

                    @if($product->reduced_price > 0)
                        <p class="discount-price">BYN {{ $product->reduced_price }}</p>
                    @endif

                    <p class="total-price"  @if($product->reduced_price > 0) style="text-decoration-line: line-through; opacity: 0.5" @endif>BYN {{ $product->price }}</p>

                    <p class="text-line"></p>
                    @else

                    <p class="product_abcent">{{ __('Not available') }} </p>

                @endif
            </div>
        </div>
    </a>
    @if ($i == 2 && $count >= 2)

        <a href="{{ route('catalog_top_new', 'new-arrivals') }}" class="get__all__new_arrivals" title="{{ __('Get all new arrivals') }}">{{ __('see more') }}</a>

    @endif

    <form id="add_product_bookmarks_{{ $i }}" action="{{ route('person.bookmarks_add', $product) }}" method="POST" style="display: none">
        @csrf
    </form>
    <form id="add_product_basket_{{ $i }}" action="{{ route('basket_add', $product) }}" method="POST" style="display: none">
        @csrf
    </form>

</div>


