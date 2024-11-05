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

            <div class="select_goods_wrap" method="GET" action="">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <select name="select__goods" class="select__goods_top_new_all">
                    <option  value="all-goods">{{ __('All goods') }}</option>
                    <option  value="bestsellers">{{ __('Bestsellers') }}</option>
                    <option  value="new-arrivals">{{ __('New arrival') }}</option>
                    <option  value="sale-price">{{ __('Sale price') }}</option>
                </select>
                <span class="select-arrow"></span>
            </div>

        </div>
    </div>

    <section class="filer__mobile">

        <div class="full_category-top-mobile">

            <h2 class="category__name">{{ Str::upper($category->langField('name')) }}</h2>

        </div>

        <div class="category__filter-top-mobile">
            <div>{{ __('Filter by') }} <span class="dropdown__arrow"></span></div>
            <div>{{ __('Sort by') }} <span class="dropdown__arrow"></span></div>
         </div>

        <form class="category__filter-mobile" method="GET" action="">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                <ul class="select_goods_wrap">
                    <li>
                        <input type="radio" class="select__goods" name="selectGoods" id="select__goods-all-goods" value="all-goods"

                        {{ request()->input('selectGoods') == 'all-goods' ? 'checked' : '' }}
                        >
                        <label class="select__goods-type" for="select__goods-all-goods">{{  __('All goods') }}</label>
                    </li>
                    <li>
                        <input type="radio" class="select__goods" name="selectGoods" id="select__goods-bestsellers" value="bestsellers"

                        {{ request()->input('selectGoods' ) == 'bestsellers' ? 'checked' : '' }}
                        >
                        <label class="select__goods-type" for="select__goods-bestsellers">{{  __('Bestsellers') }}</label>
                    </li>
                    <li>
                        <input type="radio" class="select__goods" name="selectGoods" id="select__goods-new-arrivals" value="new-arrivals"

                        {{ request()->input('selectGoods') == 'new-arrivals' ? 'checked' : '' }}
                        >
                        <label class="select__goods-type" for="select__goods-new-arrivals">{{ __('New arrival') }}</label>
                    </li>
                    <li>
                        <input type="radio" class="select__goods" name="selectGoods" id="select__goods-sale-price" value="sale-price"

                        {{ request()->input('selectGoods') == 'sale-price' ? 'checked' : '' }}
                        >
                        <label class="select__goods-type" for="select__goods-sale-price">{{  __('Sale price') }}</label>
                    </li>
                </ul>

                <div class="filter__products-mobile">

                    <div class="category">
                        <div class="category__title" onclick="getMenue(this)"><span>{{ $category->langField('name') }}</span><span>+</span></span><span>-</span></div>

                        <ul class="subcategory__names">

                            @foreach ($category->subcategories as $subcategory)
                                <li>
                                    <input type="checkbox" class="subcategory-check" name="subcategory{{ $loop->iteration }}" id="subcategory-mobile-{{ $loop->iteration }}"

                                    value="{{ $subcategory->name_en }}"

                                    {{ request()->has('subcategory'. $loop->iteration ) ? 'checked' : '' }}
                                    >
                                    <label class="subcategory__name" for="subcategory-mobile-{{ $loop->iteration }}">{{ $subcategory->langField('name') }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="brand-mobile">
                        <div class="brand__title" onclick="getMenue(this)"><span>{{ __('Brand') }}</span><span>+</span></span><span>-</span></div>

                        <ul class="brands__names">

                            @foreach ($brands as $brand)
                                <li>
                                    <input type="checkbox" class="brand-check" name="brand{{ $loop->iteration }}" id="brand-mobile-{{ $loop->iteration }}"

                                    value="{{ $brand->brand_name }}"

                                    {{ request()->has('brand'. $loop->iteration ) ? 'checked' : '' }}
                                    >
                                    <label class="brand__name" for="brand-mobile-{{ $loop->iteration }}">{{ $brand->brand_name }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="price-mobile">
                        <div class="price__title" onclick="getMenue(this)"><span>{{ __('Price') }}</span><span>+</span></span><span>-</span></div>

                        <div class="price__option">Something</div>
                    </div>

                    <div class="skintype-mobile">
                        <div class="skintype__title" onclick="getMenue(this)"><span>{{ __('Skin type') }}</span><span>+</span></span><span>-</span></div>

                        <ul class="skin__types">

                            @foreach ($skintypes as $skintype)
                            <li>
                                <input type="checkbox" class="skintype-check" name="skintype-{{ $loop->iteration }}" id="skintype-mobile-{{ $loop->iteration }}"

                                value="{{ $skintype->name_en }}"

                                {{-- @checked(old('skintype-{{ $loop->iteration }}', $skintype->name_en)) --}}
                                >
                                <label class="skintype__name" for="skintype-mobile-{{ $loop->iteration }}">{{ $skintype->langField('name') }}</label>
                            </li>
                        @endforeach
                        </ul>
                    </div>

                    <div class="age-mobile">
                        <div class="age__title" onclick="getMenue(this)"><span>{{ __('Age') }}</span><span>+</span></span><span>-</span></div>

                        <ul class="age__types">
                        </ul>
                    </div>

                    <div class="forwhom-mobile">
                        <div class="forwhom__title" onclick="getMenue(this)"><span>{{ __('For whom') }}</span><span>+</span></span><span>-</span></div>

                        <ul class="objects__types">
                        </ul>
                    </div>
                </div>



                <div class="reset__apply_btns">
                    <a class="reset__btn" href="{{ route('catalog', $category) }}">{{ __('Clear all') }}</a>

                    <button class="apply__btn" type="submit">{{ __('Apply') }}</button>

                </div>

            </form>


    </section>



    <div class="full_category-body">

        <aside class="category__subcategory">

            <div class="category__filter-top"><span>{{ Str::upper(__('Filter by')) }}:</span></div>


            <div class="category__filter" method="GET" action="">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                <div class="filter-items">
                    <div class="title" onclick="getMenue(this)"><span>{{ $category->langField('name') }}</span><span>+</span></span><span>-</span></div>

                    <ul class="subcategory__names subcategory">

                        @foreach ($category->subcategories as $subcategory)
                            <li>
                                <input type="checkbox" class="subcategory-check" name="subcategory-{{ $loop->iteration }}" id="subcategory_item-{{ $loop->iteration }}"

                                value="{{ $subcategory->name_en }}"
                                data-id="subcategory_item-{{ $loop->iteration }}"
                                >
                                <label class="subcategory__name" for="subcategory_item-{{ $loop->iteration }}">{{ $subcategory->langField('name') }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-items">
                    <div class="title" onclick="getMenue(this)"><span>{{ __('Brand') }}</span><span>+</span></span><span>-</span></div>

                    <ul class="subcategory__names brand">

                        @foreach ($brands as $brand)

                        <li>
                            <input type="checkbox" class="brand-check" name="brand-{{ $loop->iteration }}" id="brand_item-{{ $loop->iteration }}" value="{{ $brand->brand_name }}"
                            data-id="brand_item-{{ $loop->iteration }}">
                            <label class="brand__name" for="brand_item-{{ $loop->iteration }}">{{ $brand->brand_name }}</label>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-items">
                    <div class="title" onclick="getMenue(this)"><span>{{ __('Price') }}</span><span>+</span></span><span>-</span></div>

                    <div class="subcategory__names">Something</div>
                </div>

                <div class="filter-items">
                    <div class="title" onclick="getMenue(this)"><span>{{ __('Skin type') }}</span><span>+</span></span><span>-</span></div>

                    <ul class="subcategory__names skintype">
                        @foreach ($skintypes as $skintype)
                            <li>
                                <input type="checkbox" class="skintype-check" name="skintype-{{ $loop->iteration }}" id="skintype_item-{{ $loop->iteration }}"

                                value="{{ $skintype->name_en }}"
                                data-id="skintype_item-{{ $loop->iteration }}"
                                {{-- @checked(old('skintype-{{ $loop->iteration }}', $skintype->name_en)) --}}
                                >
                                <label class="skintype__name" for="skintype_item-{{ $loop->iteration }}">{{ $skintype->langField('name') }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-items">
                    <div class="title" onclick="getMenue(this)"><span>{{ __('Age') }}</span><span>+</span></span><span>-</span></div>

                    <ul class="subcategory__names">
                    </ul>
                </div>

                <div class="filter-items">
                    <div class="title" onclick="getMenue(this)"><span>{{ __('For whom') }}</span><span>+</span></span><span>-</span></div>

                    <ul class="subcategory__names">
                    </ul>
                </div>
            </div>

            <div class="reset__btn"><a href="{{ route('catalog', $category) }}">{{ __('Clear all') }}</a>
            </div>

        </aside>

        <div class="goods_top_new_all-result">

            <div class="goods_top_new_all-quantity"><span>{{ __('Items') }}: {{ $count }}</span></div>

            <div class="product__elements">
                @forelse ($products as $product)

                    @include('pages.elements.product', ['product' => $product, 'i' => $loop->iteration])
                @empty
                    <p class="no__goods">{{ __('There are no goods') }}</p>
                @endforelse
            </div>
        </div>
    </div>


    <div class="view-all__btn"><a href="{{ route('catalog_top_new', 'all-goods') }}">{{ __('View all') }}</a></div>

    <div class="pagination">1 2 3</div>

    {{-- @if (!isset($products) || !empty($products))
        <div class="pagination">{{ $products->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}</div>
    @endif --}}

    <div class="full_category-bottom">
        <h2 class="bestsellers__title">{{ Str::upper(__('You might also like')) }}</h2>

        @isset($bestsellers)
            <a href="{{ route('catalog_top_new', 'bestsellers') }}" class="get__all__bestsellers-mobile" title="{{ __('Get all bestsellers') }}">{{ __('see more') }}</a>
        @endisset

        <div class="bestsellers__elements">
            @forelse ($bestsellers as $bestseller)
                @include('pages.elements.bestsellers_on_main_page', ['bestseller' => $bestseller, 'i' => $loop->iteration])
            @empty
                <p class="no__bestsellers">{{ __('There are no bestsellers') }}</p>
            @endforelse
        </div>


    </div>

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
