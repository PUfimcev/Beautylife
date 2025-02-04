<li class="bookmark_product__element" data-name="{{ $product->name }}">

    <div  class="bookmark__element">
        <div class="product_top">

            <div class="product__tag">
                @if ($product->isNew())<span>New</span>@endif
                @if ($product->isTop())<span>Top</span>@endif
                @if ($product->isSale())<span>Sale</span>@endif
                <div class="product__evaluation"><span class="star"></span><span>5.0</span></div>
                <label for="bookmarks__product_remove-check-{{ $product->id }}" class="bookmarks__product_remove" data-name="{{ $product->name }}"></label>
                <input type="checkbox" class="bookmarksProductRemove" data-name="{{ $product->name }}" id="bookmarks__product_remove-check-{{ $product->id }}" value="{{ $product->id }}"
                @checked(old('bookmarksProductRemove_{{ $product->id }}'))
                >
            </div>

            @if($product->productImages->count() > 0)

                <img class="product__image" src="{{ asset('storage/'.$product->productImages[0]->route) }}" alt="{{ __('Image') }}" />

            @else
                <span class="no_picture">{{ __('No picture') }}</span>
            @endif
        </div>
        <div class="product__content">

            <a class="content_text" href="{{ route('product', [$product->getCategory()->first(), $product->getSubcategory()->first(), $product]) }}">{{ $product->langField('name') }}</a>
            <p class="content_about">{{ $product->productDescription->langField('about') }}</p>
        </div>
        <div class="right__part_bookmark">

            <div class="price">
                @if($product->amount > 0)

                    @if($product->reduced_price > 0)
                        <p class="discount-price">BYN {{ $product->reduced_price }}</p>
                    @endif

                    <p class="total-price"  @if($product->reduced_price > 0) style="text-decoration-line: line-through; opacity: 0.5" @endif>BYN {{ $product->price }}</p>
                @else

                    <p class="product_abcent">{{ __('Not available') }} </p>

                @endif
            </div>

            <div class="product-action" data-name="{{ $product->name }}">
                <span

                    @if ($product->amount > 0)
                        onclick="event.preventDefault(); document.getElementById('add_product_basket_{{ $product->langField('name') }}').submit();"
                    @else
                        onclick="event.preventDefault();"

                    @endif

                class="send_to_basket"></span>
            </div>
        </div>
    </div>
    <div class="request__to_remove_bookmark">
                {{-- <a href="{{ route('person.bookmarks') }}" class="dismiss_request" data-name="{{ $product->name }}">{{ __('return') }}</a> --}}

        <span class="dismiss_request" data-name="{{ $product->name }}">{{ __('return') }}</span>

        <span class="remove_bookmark-btn"
                onclick="event.preventDefault(); document.getElementById('remove_product_bookmarks_{{ $product->langField('name') }}').submit();">
                {{ __('delete') }}
        </span>
    </div>

    <form id="remove_product_bookmarks_{{ $product->langField('name') }}" action="{{ route('person.bookmarks_remove', $product) }}" method="POST" style="display: none">
        @csrf
    </form>

    <form id="add_product_basket_{{ $product->langField('name') }}" action="{{ route('basket_add', $product) }}" method="POST" style="display: none">
        @csrf
    </form>

</li>
