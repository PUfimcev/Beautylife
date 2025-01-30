<div class="bestseller__element element_{{ $g }}">

    @if ($g == 3 && $count >= 3)

        <a href="{{ route('catalog_top_new', 'bestsellers') }}" class="get__all__bestsellers" title="{{ __('Get all bestsellers') }}">{{ __('see more') }}</a>

    @endif

    <a  class="bestseller__elem_on_main-page bestseller_{{ $g }}" href="{{ route('product', [$product->getCategory()->first(), $product->getSubcategory()->first(), $product])}}"  title="{{ $product->langField('name') }}">
        <div class="bestseller__elem_on_main-page_top">

            <span class="product__tag">
                @if ($product->isTop())<span>Top</span>@endif
                @if ($product->isSale())<span>Sale</span>@endif
            </span>

            <div class="product__evaluation"><span class="star"></span><span>5.0</span></div>

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
                    @if (Auth::user()->isAdmin() || $product->isProductInBookmark()) onclick="event.preventDefault();"
                    @else
                        onclick="event.preventDefault();

                        document.getElementById('add_product_bookmarks_{{ $g }}').submit();"
                    @endif
                @endauth
                    class="send_to_bookmarks  @auth
                        @if ($product->isProductInBookmark())
                            active
                        @endif
                    @endauth"></span>
                <span
                    @if ($product->amount > 0)
                        onclick="event.preventDefault(); document.getElementById('add_product_basket_{{ $g }}').submit();"
                    @else
                        onclick="event.preventDefault();"

                @endif
                class="send_to_basket"></span>
            </div>

        </div>
        <div class="bestseller__elem_on_main-page__content">

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

    <form id="add_product_bookmarks_{{ $g }}" action="{{ route('person.bookmarks_add', $product) }}" method="POST" style="display: none">
        @csrf
    </form>
    <form id="add_product_basket_{{ $g }}" action="{{ route('basket_add', $product) }}" method="POST" style="display: none">
        @csrf
    </form>

</div>




