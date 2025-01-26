<div class="product__element element_{{ $i }}">
    <a  class="product_{{ $i }}" href="{{ route('product', [$product->getCategory()->first(), $product->getSubcategory()->first(), $product]) }}">
        <div class="product_top">

            <div class="product__tag">
                @if ($product->isNew())<span>New</span>@endif
                @if ($product->isTop())<span>Top</span>@endif
                @if ($product->isSale())<span>Sale</span>@endif
            </div>



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
                    @if (Auth::user()->isAdmin()) onclick="event.preventDefault();"
                    @else
                        onclick="event.preventDefault();

                        document.getElementById('add_product_bookmarks').submit();"
                    @endif
                @endauth
                    class="send_to_bookmarks"></span>
                <span

                    @if ($product->amount > 0)
                        onclick="event.preventDefault(); document.getElementById('add_product_basket').submit();"
                    @else
                        onclick="event.preventDefault();"

                    @endif

                class="send_to_basket"></span>
            </div>

        </div>
        <div class="product__content">

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

    <form id="add_product_bookmarks" action="{{ route('person.bookmarks_add', $product) }}" method="POST" style="display: none">
        @csrf
    </form>
    <form id="add_product_basket" action="{{ route('basket_add', $product) }}" method="POST" style="display: none">
        @csrf
    </form>

</div>




