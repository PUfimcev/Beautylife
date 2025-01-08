@extends('admin.layout.app')

@section('title', isset($product) ? __('Edit').' '.__('Product') :  __('Create').' '.__('Product'))

@section('content')

<div class="container">

    <div class="admin__products__section-create d-flex flex-column align-items-center justify-content-start">

        <h2>{{ isset($product) ? __('Edit') : __('Create') }} {{ __('Product') }}</h2>

        @if (isset($product))
            @if((url()->previous()) && (url()->previous() !== route('admin.products.edit', $product)))

                <a class="btn btn-light align-self-end  btn-return" href="{{ url()->previous() }}">{{ __('Back') }}</a>
            @else
                <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.products.index') }}">{{ __('Back') }}</a>
            @endif
        @else

            @if((url()->previous()) && (url()->previous() == route('admin.products.create')))

                <a class="btn btn-light align-self-end  btn-return" href="{{ url()->previous() }}">{{ __('Back') }}</a>
            @else
                <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.products.index') }}">{{ __('Back') }}</a>
            @endif
        @endif

        @isset($categories)
            <h3 class="product__create_categories-title">{{ __('Choose :name', ['name' => __('category')]) }}:</h3>

            <div class="product__create_categories-name">

                @foreach ($categories as $category)

                    <a href="{{ route('admin.products_create', $category) }}" title="{{ $category->langField('name') }}">{{ $category->langField('name') }}</a>

                @endforeach
            </div>

        @endisset

        @if( isset($subcategories)  || isset($product))

            <form method="POST"
                @if (isset($product))
                    action="{{ route('admin.products.update', $product) }}"
                @else
                    action="{{ route('admin.products.store') }}"

                @endif enctype="multipart/form-data" class="form_products">

                @csrf
                @isset($product)
                    @method('PUT')
                @endisset

                <input id="category-id" type="hidden" value="{{ old('category_id', isset($product) ? $product->getCategory($product->id)->id : $category->id) }}" name="category_id">

                <div class="product__create mb-1">
                    <label for="product_subcategory_type" class="col-form-label text-md-end">{{ __('Subcategory') }}:</label>

                    {{-- <button type="button" class="btn btn-light btn-secondary mb-1 select_reset-btn">{{ __('Reset') }}</button> --}}
                    <select id="product_subcategory_type" class="form-select @error('subcategory_id') is-invalid @enderror" size="1" name="subcategory_id" autofocus aria-label="{{ __('Subcategory type') }}">

                        @foreach ($subcategories = isset($product) ? $product->GetSubcategories() : $subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" @selected(isset($product) ? $product->property->subcategory_id == $subcategory->id : old('subcategory_id'))>{{ $subcategory->langField('name') }}</option>
                        @endforeach

                    </select>
                        @error('subcategory_id')
                            <span class="invalid-feedback select_error_msg" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="product__create mb-1">
                    <label for="product_brand_type" class="col-form-label text-md-end">{{ __('Brand') }}:</label>

                    <select id="product_brand_type" class="form-select @error('brand_id') is-invalid @enderror" size="1" name="brand_id" autofocus aria-label="{{ __('Brand type') }}">
                        <option @disabled(true) @selected(isset($product) ? false : true)>--------</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" @selected( isset($product) ?  $product->property->brand_id == $brand->id : old('brand_id')) >{{ $brand->brand_name }}</option>
                        @endforeach

                    </select>
                        @error('brand_id')
                            <span class="invalid-feedback select_error_msg" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="product__create mb-1">
                    <label for="product_skinType_type" class="col-form-label text-md-end">{{ __('Skin type') }}:</label>

                    <select id="product_skinType_type" class="form-select @error('skin_type_id') is-invalid @enderror" size="1" name="skin_type_id" autofocus aria-label="{{ __('Skin type') }}">

                        <option @disabled(true) @selected(isset($product) ? false : true)>--------</option>
                        @foreach ($skinTypes as $skinType)
                            <option value="{{ $skinType->id }}" @selected(isset($product) ? $product->property->skin_type_id == $skinType->id : old('skin_type_id')) >{{ $skinType->langField('name') }}</option>
                        @endforeach

                    </select>
                        @error('skin_type_id')
                            <span class="invalid-feedback select_error_msg" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="product__create mb-1">
                    <label for="product_agerange_type" class="col-form-label text-md-end">{{ __('Age range') }}:</label>

                    <select id="product_agerange_type" class="form-select @error('agerange_id') is-invalid @enderror" size="1" name="agerange_id" autofocus aria-label="{{ __('Age range') }}">

                        <option @disabled(true) @selected(isset($product) ? false : true)>--------</option>
                        @foreach ($agerange as $agerangeType)
                            <option value="{{ $agerangeType->id }}" @selected(isset($product) ? $product->property->agerange_id == $agerangeType->id : old('agerange_id')) >{{ $agerangeType->langField('name') }}</option>
                        @endforeach

                    </select>
                        @error('agerange_id')
                            <span class="invalid-feedback select_error_msg" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="product__create mb-1">
                    <label for="product_consumers_type" class="col-form-label text-md-end">{{ __('Consumers') }}:</label>

                    <select id="product_consumers_type" class="form-select @error('consumer_id') is-invalid @enderror" size="1" name="consumer_id" autofocus aria-label="{{ __('Consumers') }}">

                        <option @disabled(true) @selected(isset($product) ? false : true)>--------</option>
                        @foreach ($consumers as $consumer)
                            <option value="{{ $consumer->id }}" @selected(isset($product) ? $product->property->consumer_id == $consumer->id : old('consumer_id')) >{{ $consumer->langField('name') }}</option>
                        @endforeach

                    </select>
                        @error('consumer_id')
                            <span class="invalid-feedback select_error_msg" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="product__create mb-1">
                    <label for="product_code" class="col-form-label text-md-end">{{ __('Code') }}:</label>
                    <div class="product_code_input">
                        <input id="product_code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code', isset($product) ? $product->code : null) }}"  autocomplete="code" autofocus placeholder="{{ __('Code') }}">
                        @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="product__create mb-1">
                    <label for="product_name" class="col-form-label text-md-end">Наименование товара:</label>
                    <div class="product_name_input">
                        <input id="product_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', isset($product) ? $product->name : null) }}"  autocomplete="name" autofocus placeholder="Наименование">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="product__create mb-1">
                    <label for="product_name_en" class="col-form-label text-md-end">Product name in English:</label>
                    <div class="product_name_en_input">
                        <input id="product_name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en', isset($product) ? $product->name_en : null) }}"  autocomplete="name_en" autofocus placeholder="Product name in English">
                        @error('name_en')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="product__create mb-1">
                    <label for="product_about" class="col-form-label text-md-end">Аннотация товара:</label>
                    <div class="product_about-1">
                        <textarea id="product_about" rows="3" class="form-control @error('about') is-invalid @enderror" name="about" autofocus placeholder="Аннотация товара">{{ old('about', isset($product) ? $product->productDescription->about : null) }}</textarea>
                        @error('about')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="product__create mb-1">
                    <label for="product_about_en" class="col-form-label text-md-end">Product summary in English:</label>

                    <div class="product_about_en">
                        <textarea id="product_about_en" rows="3" class="form-control @error('about_en') is-invalid @enderror" name="about_en" autofocus placeholder="Product summary in English">{{ old('about_en', isset($product) ? $product->productDescription->about_en : null) }}</textarea>
                        @error('about_en')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="product__create mb-1">
                    <label for="product_description" class="col-form-label text-md-end">Описание товара:</label>

                    <div class="product_description-1">
                        <textarea id="product_description" rows="3" class="form-control @error('description') is-invalid @enderror" name="description" autofocus placeholder="Описание товара">{{ old('description', isset($product) ? $product->productDescription->description : null) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="product__create mb-1">
                    <label for="product_description_en" class="col-form-label text-md-end">Description in English:</label>

                    <div class="product_description_en">
                        <textarea id="product_description_en" rows="3" class="form-control @error('description_en') is-invalid @enderror" name="description_en" autofocus placeholder="Description in English">{{ old('description_en', isset($product) ? $product->productDescription->description_en : null) }}</textarea>
                        @error('description_en')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="product__create mb-1">
                    <label for="product_application" class="col-form-label text-md-end">Область применения товара:</label>

                    <div class="product_application-1">
                        <textarea id="product_application" rows="3" class="form-control @error('application') is-invalid @enderror" name="application" autofocus placeholder="Область применения товара">{{ old('application', isset($product) ? $product->productDescription->application : null) }}</textarea>
                        @error('application')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="product__create mb-1">
                    <label for="product_application_en" class="col-form-label text-md-end">Application in English:</label>

                    <div class="product_application_en">
                        <textarea id="product_application_en" rows="3" class="form-control @error('application_en') is-invalid @enderror" name="application_en" autofocus placeholder="Application in English">{{ old('application_en', isset($product) ? $product->productDescription->application_en : null) }}</textarea>
                        @error('application_en')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="product__create mb-1">
                    <label for="product_origin" class="col-form-label text-md-end">Происхождение товара:</label>

                    <div class="product_origin-1">
                        <textarea id="product_origin" rows="1" class="form-control @error('origin') is-invalid @enderror" name="origin" autofocus placeholder="Происхождение товара">{{ old('origin', isset($product) ? $product->productDescription->origin : null) }}</textarea>
                        @error('origin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="product__create mb-1">
                    <label for="product_origin_en" class="col-form-label text-md-end">Origin in English:</label>

                    <div class="product_origin_en">
                        <textarea id="product_origin_en" rows="1" class="form-control @error('origin_en') is-invalid @enderror" name="origin_en" autofocus placeholder="Origin in English">{{ old('origin_en', isset($product) ? $product->productDescription->origin_en : null) }}</textarea>
                        @error('origin_en')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="product__create mb-1">
                    <label for="product_ingredients" class="col-form-label text-md-end">Состав товара:</label>

                    <div class="product_ingredients-1">
                        <textarea id="product_ingredients" rows="3" class="form-control @error('ingredients') is-invalid @enderror" name="ingredients" autofocus placeholder="Состав товара">{{ old('ingredients', isset($product) ? $product->productDescription->ingredients : null) }}</textarea>
                        @error('ingredients')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="product__create mb-1">
                    <label for="product_ingredients_en" class="col-form-label text-md-end">Ingredients in English:</label>

                    <div class="product_ingredients_en">
                        <textarea id="product_ingredients_en" rows="3" class="form-control @error('ingredients_en') is-invalid @enderror" name="ingredients_en" autofocus placeholder="Ingredients in English">{{ old('ingredients_en', isset($product) ? $product->productDescription->ingredients_en : null) }}</textarea>
                        @error('ingredients_en')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="product__create product_price mb-1">
                    <label for="product__price" class="col-form-label text-md-end">{{ __('Price') }}, BYN:</label>
                    <input id="product__price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', isset($product) ? $product->price : __('Price')) }}"  autocomplete="product__price" autofocus step="0.01" placeholder="{{ __('Price') }}">
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="product__create product_reduced_price mb-1">
                    <label for="product__reduced_price" class="col-form-label text-md-end">{{ __('Reduced price') }}, BYN:</label>
                    <input id="product__reduced_price" type="number" class="form-control @error('reduced_price') is-invalid @enderror" name="reduced_price" value="{{ old('reduced_price', isset($product) ? $product->reduced_price :  __('Reduced price')) }}"  autocomplete="product__reduced_price" autofocus step="0.01" placeholder="{{ __('Reduced price') }}">
                    @error('reduced_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="product__create product_amount mb-1">
                    <label for="product__amount" class="col-form-label text-md-end">{{ __('Amount') }}:</label>
                    <input id="product__amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount', isset($product) ? $product->amount : __('Amount')) }}"  autocomplete="product__amount" autofocus step="1" placeholder="{{ __('Amount') }}">
                    @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="product__create product_new mb-1">
                    <label for="product__new" class="col-form-label text-md-end">{{ __('New') }}:</label>
                    <input id="product__new" type="checkbox" class="form-check-input" name="new" @checked( old('new', isset($product) ? $product->new : 0))>
                </div>

                <div class="product__create product_top mb-1">
                    <label for="product__top" class="col-form-label text-md-end">{{ __('Top') }}:</label>
                    <input id="product__top" type="checkbox" value="1" class="form-check-input" name="top"
                    @checked( old('top', (isset($product) && $product->top === 1) ? true : false))>
                </div>

                <div class="product__create mb-1">
                    <label for="productFile" class="col-form-label">{{ isset($product) ? __('Change product pictures') : __('Add product pictures') }}:</label>


                    @if(isset($product))


                        @if($product->productImages->count() > 0)
                            <input class="form-control mb-3" type="file" id="productFiles" multiple name="productFiles[]" value="{{ old('productFiles') }}" accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >

                            <p>{{ __('The downloaded picture') }}:</p>
                            <ul class="product__images">
                                @foreach ($product->productImages as $image)

                                    <li>
                                        <label for="product__image_checkbox {{ $image->id }}">
                                            <input id="product__image_checkbox {{ $image->id }}" form="productPicturesRemove" type="checkbox" value="{{ $image->id }}" class="form-check-input product__image_checkbox" name="productPictures[]" @checked( old('productPictures'))>
                                            <img class="product__image" src="{{ asset('storage/'.$image->route) }}" alt="{{ __('Image') }}" />
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                            <span class="d-inline-block fs-6">{{ __('Click picture for removing') }}</span>
                            <button id="btn__product_img_remove" type="submit" form="productPicturesRemove" onClick="()=> {submit()}" class="btn btn-primary align-self-center btn__product_img_remove ms-3" href="" @disabled(true)>{{ __('Remove') }}</button>

                        @else
                            <p>{{ __('No pictures') }}.</p>
                            <input class="form-control" type="file" id="productFiles" multiple name="productFiles[]" value="{{ old('productFiles') }}" accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >
                        @endif

                    @else

                        <input class="form-control @error('productFiles') is-invalid @enderror" type="file" id="productFiles" multiple name="productFiles[]"  value="{{ old('productFiles') }}" accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >

                        @error('productFiles')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    @endif
                </div>


                <button type="submit" onClick="()=> {submit()}" class="btn btn-success align-self-center btn__product__form-create" href="">{{ isset($product) ? __('Edit') : __('Create') }}</button>
            </form>

        @endif

        @isset($product)

            <form style="display: none" id="productPicturesRemove" action="{{ route('admin.product_pictures', $product) }}" method="POST">
                @csrf
            </form>
        @endisset

    </div>

</div>

@endsection

