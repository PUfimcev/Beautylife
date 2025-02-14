@use(App\Models\Product;)
@extends('layouts.index')

@section('title', $category->langField('name') )

@section('crumbs')
    <ul class="crumbs__list d-flex justify-content-start align-items-center gap-1">
        <li><a class="crumbs__reffers" href="{{ route('index') }}">{{ __('Main page')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><a class="crumbs__reffers" href="{{ route('catalog') }}">{{ __('Catalog')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><span>{{  $category->langField('name') }}</span></li>
    </ul>
@endsection

@section('content')

<section class="full_category">


    <div class="full_category-top">

        <h2 class="category__name">{{ Str::upper($category->langField('name')) }}</h2>

        <div class="selection_goods">
            <span >{{ __('Sort by') }}:</span>

            <div class="select_goods_wrap">

                <select form="category__filter-id" name="selectGoods" class="select__goods">
                    <option  @selected(old('selectGoods', 'all-goods') == request()->input("selectGoods")) value="all-goods">{{ __('All goods') }}</option>
                    <option  @selected(old('selectGoods', 'bestsellers') == request()->input("selectGoods"))  value="bestsellers">{{ __('Bestsellers') }}</option>
                    <option  @selected(old('selectGoods','new-arrivals') == request()->input("selectGoods"))  value="new-arrivals">{{ __('New arrivals') }}</option>
                    <option  @selected(old('selectGoods', 'sale-price') == request()->input("selectGoods"))  value="sale-price">{{ __('Sale price') }}</option>
                </select>
                <span class="select-arrow"></span>
            </div>

        </div>
    </div>

    <div id="category__filter-top-mobile">{{ __('Filters and sorting') }}</div>

    <div class="full_category-top-mobile">

        <h2 class="category__name">{{ Str::upper($category->langField('name')) }}</h2>

        <a class="return_to_catalog-btn" href="{{ route('catalog') }}">{{ __('Catalogs') }}</a>
    </div>

    <div class="full_category-body">

        <aside class="category__subcategory">

            <div class="category__filter-top"><span>{{ Str::upper(__('Filter by')) }}:</span></div>


            <form id="category__filter-id" class="category__filter" method="GET" action="{{ route('catalog', $category) }}">

                <div class="filter-items">
                    <div class="title {{ (request()->filled('subcategorySelect')) ? 'open' : '' }}" onclick="getMenue(this)"><span>{{ $category->langField('name') }}</span><span>+</span><span>-</span></div>

                    <ul class="subcategory__names subcategory {{ (request()->filled('subcategorySelect')) ? 'open' : '' }}">

                        @foreach ($category->subcategories as $subcategory)
                            <li>
                                <input type="checkbox" class="subcategory-select" name="subcategorySelect[]" id="subcategory_item-{{ $loop->iteration }}"

                                {{ in_array($subcategory->id, request()->input('subcategorySelect') ?? []) ? 'checked' : ''}}

                                value="{{ $subcategory->id }}"
                                data-id="subcategory_item-{{ $loop->iteration }}"
                                >
                                <label class="subcategory__name" for="subcategory_item-{{ $loop->iteration }}">{{ $subcategory->langField('name') }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-items">
                    <div class="title {{ (request()->filled('brandSelect')) ? 'open' : '' }}" onclick="getMenue(this)"><span>{{ __('Brand') }}</span><span>+</span><span>-</span></div>

                    <ul class="subcategory__names brand {{ (request()->filled('brandSelect')) ? 'open' : '' }}">

                        @foreach ($brands as $brand)

                        <li>
                            <input type="checkbox" class="subcategory-select" name="brandSelect[]" id="brand_item-{{ $loop->iteration }}"
                            {{ in_array($brand->id, request()->input('brandSelect') ?? []) ? 'checked' : ''}}
                            value="{{ $brand->id }}"
                            data-id="brand_item-{{ $loop->iteration }}">
                            <label class="brand__name" for="brand_item-{{ $loop->iteration }}">{{ $brand->brand_name }}</label>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-items price">
                    <div class="title {{ (isset(request()->priceFrom) || isset(request()->priceTo)) ? 'open' : '' }}" onclick="getMenue(this)"><span>{{ __('Price') }}</span><span>+</span><span>-</span></div>

                    <div class="subcategory__names price {{ (isset(request()->priceFrom) || isset(request()->priceTo)) ? 'open' : '' }}">

                        <div class="price__from__to_box">
                            <span for="price_from">BYN</span>
                            <div class="price_from-elem">
                                <input type="text" oninput="this.value = this.value.trim().replace(/\D/g, '').slice(0,7); (this.value.length > 0) ? this.setAttribute('name', 'priceFrom') : this.removeAttribute('name') " {{ request()->filled('priceFrom') ? 'name='.'priceFrom' : ''}} id="price_from" size="6" maxlength="6"  value="{{ request()->priceFrom }}" placeholder="{{ __('from') }}">
                            </div>
                            <div class="price_to-elem">
                                <input type="text" oninput="this.value = this.value.trim().replace(/\D/g, '').slice(0,7); (this.value.length > 0) ? this.setAttribute('name', 'priceTo') : this.removeAttribute('name') " {{ request()->filled('priceTo') ? 'name='.'priceTo' : ''}} id="price_to" size="6" maxlength="6" value="{{ request()->priceTo }}" placeholder="{{ __('to') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-items">
                    <div class="title {{ (request()->filled('skintypeSelect')) ? 'open' : '' }}" onclick="getMenue(this)"><span>{{ __('Skin type') }}</span><span>+</span></span><span>-</span></div>

                    <ul class="subcategory__names skintype {{ (request()->filled('skintypeSelect')) ? 'open' : '' }}">
                        @foreach ($skintypes as $skintype)
                            <li>
                                <input type="checkbox" class="subcategory-select" name="skintypeSelect[]" id="skintype_item-{{ $loop->iteration }}"
                                {{ in_array($skintype->id, request()->input('skintypeSelect') ?? []) ? 'checked' : ''}}
                                value="{{ $skintype->id }}"
                                data-id="skintype_item-{{ $loop->iteration }}"
                                >
                                <label class="skintype__name" for="skintype_item-{{ $loop->iteration }}">{{ $skintype->langField('name') }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-items">
                    <div class="title {{ (request()->filled('agerangeSelect')) ? 'open' : '' }}" onclick="getMenue(this)"><span>{{ __('Age') }}</span><span>+</span><span>-</span></div>
                    <ul class="subcategory__names agerange {{ (request()->filled('agerangeSelect')) ? 'open' : '' }}">
                        @foreach ($ageranges as $agerange)
                            <li>
                                <input type="checkbox" class="subcategory-select" name="agerangeSelect[]" id="agerange_item-{{ $loop->iteration }}"

                                value="{{ $agerange->id }}"
                                data-id="agerange_item-{{ $loop->iteration }}"
                                {{ in_array($agerange->id, request()->input('agerangeSelect') ?? []) ? 'checked' : ''}}
                                >
                                <label class="agerange__name" for="agerange_item-{{ $loop->iteration }}">{{ $agerange->langField('name') }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-items">
                    <div class="title {{ (request()->filled('consumerSelect')) ? 'open' : '' }}" onclick="getMenue(this)"><span>{{ __('For whom') }}</span><span>+</span><span>-</span></div>

                    <ul class="subcategory__names consumers {{ (request()->filled('consumerSelect')) ? 'open' : '' }}">
                        @foreach ($consumers as $consumer)
                        <li>
                            <input type="checkbox" class="subcategory-select" name="consumerSelect[]" id="consumer_item-{{ $loop->iteration }}"

                            value="{{ $consumer->id }}"
                            data-id="consumer_item-{{ $loop->iteration }}"
                            {{ in_array($consumer->id, request()->input('consumerSelect') ?? []) ? 'checked' : ''}}
                            >
                            <label class="consumer__name" for="consumer_item-{{ $loop->iteration }}">{{ $consumer->langField('name') }}</label>
                        </li>
                    @endforeach
                    </ul>
                </div>

                @csrf
            </form>

            <div class="reset__btn"><a href="{{ route('catalog', $category) }}">{{ __('Clear all') }}</a>
            </div>

        </aside>

        <div class="goods_top_new_all-result">

            <div class="goods_top_new_all-quantity"><span>{{ __('Items') }}: {{ $count }}</span></div>

            <div class="product__elements">
                @isset($products)
                    @forelse ($products as $product)
                        @include('pages.elements.product', ['product' => $product, 'category' => $category, 'i' => $loop->iteration])
                    @empty
                        <p class="no__goods">{{ __('There are no goods') }}</p>
                    @endforelse
                @endisset
            </div>
        </div>


    </div>

    <div class="view-all__btn"><a href="{{ route('catalog_top_new', 'all-goods') }}">{{ __('View all') }}</a></div>

    @isset($products)
        <div class="pagination">{{ $products->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}</div>

    @endisset

    <div class="full_category-bottom">
        <h2 class="bestsellers__title">{{ Str::upper(__('You might also like')) }}</h2>

        @isset($bestsellers)
            <a href="{{ route('catalog_top_new', 'bestsellers') }}" class="get__all__bestsellers-mobile" title="{{ __('Get all bestsellers') }}">{{ __('see more') }}</a>
        @endisset

        <div class="bestsellers__elements">

            @forelse ($bestsellers as $bestseller)

                @include('pages.elements.bestsellers_on_main_page', ['product' => $bestseller, 'g' => $loop->iteration, 'count' => $bestsellers->count()])
            @empty
                <p class="no__bestsellers">{{ __('There are no bestsellers') }}</p>
            @endforelse
        </div>


    </div>

</section>

<section class="filer__mobile">

    <form id="category__filter-mobile" method="GET" action="{{ route('catalog', $category) }}">

            <div class="category__filter-top">
                <span>{{ Str::upper(__('Filter by')) }}:</span>
                <a href="{{ route('catalog', $category) }}" class="navbar__cancel-icon category_mobile"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg></a>
            </div>

            <div class="filter__products-mobile">
                <div class="filter-items-mobile">

                    <div class="title" onclick="getMenue(this)"><span>{{ __('Sort by') }}</span><span>+</span><span>-</span></div>

                    <ul class="subcategory__names-mobile select_box">
                        <li>
                            <input type="radio" class="subcategory_select-mobile" name="selectGoods" id="select__goods-all-goods" value="all-goods" checked

                            {{ request()->input('selectGoods') == 'all-goods' ? 'checked' : '' }}
                            >
                            <label class="select__goods-type" for="select__goods-all-goods">{{  __('All goods') }}</label>
                        </li>
                        <li>
                            <input type="radio" class="subcategory_select-mobile" name="selectGoods" id="select__goods-bestsellers" value="bestsellers"

                            {{ request()->input('selectGoods' ) == 'bestsellers' ? 'checked' : '' }}
                            >
                            <label class="select__goods-type" for="select__goods-bestsellers">{{  __('Bestsellers') }}</label>
                        </li>
                        <li>
                            <input type="radio" class="subcategory_select-mobile" name="selectGoods" id="select__goods-new-arrivals" value="new-arrivals"

                            {{ request()->input('selectGoods') == 'new-arrivals' ? 'checked' : '' }}
                            >
                            <label class="select__goods-type" for="select__goods-new-arrivals">{{ __('New arrival') }}</label>
                        </li>
                        <li>
                            <input type="radio" class="subcategory_select-mobile" name="selectGoods" id="select__goods-sale-price" value="sale-price"

                            {{ request()->input('selectGoods') == 'sale-price' ? 'checked' : '' }}
                            >
                            <label class="select__goods-type" for="select__goods-sale-price">{{  __('Sale price') }}</label>
                        </li>
                    </ul>

                </div>

                <div class="filter-items-mobile">
                    <div class="title {{ (request()->filled('subcategorySelect')) ? 'open' : '' }}" onclick="getMenue(this)"><span>{{ $category->langField('name') }}</span><span>+</span><span>-</span></div>

                    <ul class="subcategory__names-mobile subcategory {{ (request()->filled('subcategorySelect')) ? 'open' : '' }}">

                        @foreach ($category->subcategories as $subcategory)
                            <li>
                                <input type="checkbox" class="subcategory-select-mobile" name="subcategorySelect[]" id="subcategory_item-mobile-{{ $loop->iteration }}"

                                {{ in_array($subcategory->id, request()->input('subcategorySelect') ?? []) ? 'checked' : ''}}

                                value="{{ $subcategory->id }}"
                                data-id="subcategory_item-{{ $loop->iteration }}"
                                >
                                <label class="subcategory__name" for="subcategory_item-mobile-{{ $loop->iteration }}">{{ $subcategory->langField('name') }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-items-mobile">
                    <div class="title {{ (request()->filled('brandSelect')) ? 'open' : '' }}" onclick="getMenue(this)"><span>{{ __('Brand') }}</span><span>+</span><span>-</span></div>

                    <ul class="subcategory__names-mobile brand {{ (request()->filled('brandSelect')) ? 'open' : '' }}">

                        @foreach ($brands as $brand)

                        <li>
                            <input type="checkbox" class="subcategory-select-mobile" name="brandSelect[]" id="brand_item-mobile-{{ $loop->iteration }}"
                            {{ in_array($brand->id, request()->input('brandSelect') ?? []) ? 'checked' : ''}}
                            value="{{ $brand->id }}"
                            data-id="brand_item-{{ $loop->iteration }}">
                            <label class="brand__name" for="brand_item-mobile-{{ $loop->iteration }}">{{ $brand->brand_name }}</label>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-items-mobile price">
                    <div class="title {{ (isset(request()->priceFrom) || isset(request()->priceTo)) ? 'open' : '' }}" onclick="getMenue(this)"><span>{{ __('Price') }}</span><span>+</span><span>-</span></div>

                    <div class="subcategory__names-mobile price {{ (isset(request()->priceFrom) || isset(request()->priceTo)) ? 'open' : '' }}">

                        <div class="price__from__to_box-mobile">
                            <span for="price_from">BYN</span>
                            <div class="price_from-elem">
                                <input type="text" oninput="this.value = this.value.trim().replace(/\D/g, '').slice(0,7); (this.value.length > 0) ? this.setAttribute('name', 'priceFrom') : this.removeAttribute('name') " {{ request()->filled('priceFrom') ? 'name='.'priceFrom' : ''}} id="price_from" size="6" maxlength="6"  value="{{ request()->priceFrom }}" placeholder="{{ __('from') }}">
                            </div>
                            <div class="price_to-elem">
                                <input type="text" oninput="this.value = this.value.trim().replace(/\D/g, '').slice(0,7); (this.value.length > 0) ? this.setAttribute('name', 'priceTo') : this.removeAttribute('name') " {{ request()->filled('priceTo') ? 'name='.'priceTo' : ''}} id="price_to" size="6" maxlength="6" value="{{ request()->priceTo }}" placeholder="{{ __('to') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-items-mobile">
                    <div class="title {{ (request()->filled('skintypeSelect')) ? 'open' : '' }}" onclick="getMenue(this)"><span>{{ __('Skin type') }}</span><span>+</span></span><span>-</span></div>

                    <ul class="subcategory__names-mobile skintype {{ (request()->filled('skintypeSelect')) ? 'open' : '' }}">
                        @foreach ($skintypes as $skintype)
                            <li>
                                <input type="checkbox" class="subcategory-select-mobile" name="skintypeSelect[]" id="skintype_item-mobile-{{ $loop->iteration }}"
                                {{ in_array($skintype->id, request()->input('skintypeSelect') ?? []) ? 'checked' : ''}}
                                value="{{ $skintype->id }}"
                                data-id="skintype_item-{{ $loop->iteration }}"
                                >
                                <label class="skintype__name" for="skintype_item-mobile-{{ $loop->iteration }}">{{ $skintype->langField('name') }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-items-mobile">
                    <div class="title {{ (request()->filled('agerangeSelect')) ? 'open' : '' }}" onclick="getMenue(this)"><span>{{ __('Age') }}</span><span>+</span><span>-</span></div>
                    <ul class="subcategory__names-mobile agerange {{ (request()->filled('agerangeSelect')) ? 'open' : '' }}">
                        @foreach ($ageranges as $agerange)
                            <li>
                                <input type="checkbox" class="subcategory-select-mobile" name="agerangeSelect[]" id="agerange_item-mobile-{{ $loop->iteration }}"

                                value="{{ $agerange->id }}"
                                data-id="agerange_item-{{ $loop->iteration }}"
                                {{ in_array($agerange->id, request()->input('agerangeSelect') ?? []) ? 'checked' : ''}}
                                >
                                <label class="agerange__name" for="agerange_item-mobile-{{ $loop->iteration }}">{{ $agerange->langField('name') }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-items-mobile">
                    <div class="title {{ (request()->filled('consumerSelect')) ? 'open' : '' }}" onclick="getMenue(this)"><span>{{ __('For whom') }}</span><span>+</span><span>-</span></div>

                    <ul class="subcategory__names-mobile consumers {{ (request()->filled('consumerSelect')) ? 'open' : '' }}">
                        @foreach ($consumers as $consumer)
                        <li>
                            <input type="checkbox" class="subcategory-select-mobile" name="consumerSelect[]" id="consumer_item-mobile-{{ $loop->iteration }}"

                            value="{{ $consumer->id }}"
                            data-id="consumer_item-{{ $loop->iteration }}"
                            {{ in_array($consumer->id, request()->input('consumerSelect') ?? []) ? 'checked' : ''}}
                            >
                            <label class="consumer__name" for="consumer_item-mobile-{{ $loop->iteration }}">{{ $consumer->langField('name') }}</label>
                        </li>
                    @endforeach
                    </ul>
                </div>

            @csrf

            <div class="btns-mobile">
                <div class="reset__btn-mobile">{{ __('Clear') }}</div>

                <button class="apply__btn" type="submit">{{ __('Apply') }}</button>

            </div>

    </form>


</section>

@push('scripts')

    <script>
        function getMenue(elem){
        if(!elem) return;

        elem.classList.toggle('open');
        elem.nextElementSibling.classList.toggle('open');

        }

    </script>
@endpush

@endsection
