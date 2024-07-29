@extends('admin.layout.app')

@section('title', isset($offer) ? __('Edit').' '.__('offer') :  __('Create').' '.__('offer'))

@section('content')

<div class="container">

    <div class="admin__offers__section-create d-flex flex-column align-items-center justify-content-start">

        <h2>{{ isset($offer) ? __('Edit') : __('Create') }} {{ __('offer') }}</h2>

        <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.offers.index') }}">{{ __('Back') }}</a>


        <form method="POST"
            @if (isset($offer))
                action="{{ route('admin.offers.update', $offer) }}"
            @else
                action="{{ route('admin.offers.store') }}"
            @endif enctype="multipart/form-data" class="form_offer">

            @csrf
            @isset($offer)
                @method('PUT')
            @endisset

            <div class="offer__create mb-1">
                <label for="offer_title" class="col-form-label text-md-end">Заголовок предложения:</label>
                <div class="offer_title_input">
                    <input id="offer_title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', isset($offer) ? $offer->title : null) }}"  autocomplete="title" autofocus placeholder="Заголовок предложения">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="offer__create mb-1">
                <label for="offer_title_en" class="col-form-label text-md-end">Offer title in English:</label>
                <div class="offer_title_en_input">
                    <input id="offer_title_en" type="text" class="form-control @error('title_en') is-invalid @enderror" name="title_en" value="{{ old('title_en', isset($offer) ? $offer->title_en : null) }}"  autocomplete="title_en" autofocus placeholder="Offer title in English">
                    @error('title_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="offer__create mb-1">
                <label for="offer_about" class="col-form-label text-md-end">Аннотация предложения:</label>

                <div class="offer_about-1">
                    <textarea id="offer_about" rows="3" class="form-control @error('about') is-invalid @enderror" name="about" autofocus placeholder="Аннотация предложения">{{ old('about', isset($offer) ? $offer->about : null) }}</textarea>
                    @error('about')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="offer__create mb-1">
                <label for="offer_about_en" class="col-form-label text-md-end">Offer summary in English:</label>

                <div class="offer_about_en">
                    <textarea id="offer_about_en" rows="3" class="form-control @error('about_en') is-invalid @enderror" name="about_en" autofocus placeholder="Offer summary in English">{{ old('about_en', isset($offer) ? $offer->about_en : null) }}</textarea>
                    @error('about_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="offer__create mb-1">
                <label for="offerFile" class="col-form-label">{{ isset($offer) ? __('Change offer picture') : __('Offer picture') }}:</label>

                @if (isset($offer))
                    @if($offer->image_route !== null)

                        <p>{{ __('The downloaded picture') }}:</p>
                        <img class="offer__image"
                        src="{{ asset('storage/'.$offer->image_route) }}" alt="{{ __('Image') }}" />

                        <input class="form-control" type="file" id="offerFile" name="offerFile" value="{{ old('offerFile', isset($offer) ? $offer->image_route : null) }}" accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >
                    @else
                        <p>{{ __('No picture') }}.</p>
                        <input class="form-control" type="file" id="offerFile" name="offerFile"  accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >
                    @endif
                @else

                    <input class="form-control @error('offerFile') is-invalid @enderror" type="file" id="offerFile" name="offerFile"  accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >
                    @error('offerFile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                @endif

            </div>

            <div class="offer__create mb-1">
                <label for="offer_description" class="col-form-label text-md-end">Описание предложения:</label>

                <div class="offer_description">

                    <textarea id="offer_description" rows="5" class="form-control @error('description') is-invalid @enderror" name="description"  autofocus placeholder="Описание предложения">{{ old('description', isset($offer) ? $offer->description : null) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="offer__create mb-1">
                <label for="offer_description_en" class="col-form-label text-md-end">Offer description in English:</label>

                <div class="offer_description_en">

                    <textarea id="offer_description_en" rows="5" class="form-control @error('description_en') is-invalid @enderror" name="description_en"  autofocus placeholder="Offer description in English">{{ old('description_en', isset($offer) ? $offer->description_en : null) }}</textarea>
                    @error('description_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="offer__create offer_discount mb-1">
                <label for="offer__discount_size" class="col-form-label text-md-end">{{ __('Discount size') }}, %:</label>
                <input id="offer__discount_size" type="number" class="form-control @error('discount_size') is-invalid @enderror" name="discount_size" value="{{ old('discount_size', isset($offer) ? $offer->discount_size : 0) }}"  autocomplete="offer__discount_size" autofocus step="1"  placeholder="{{ __('Discount size') }}">
                @error('discount_size')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="offer__create offer_period mb-1">
                <div>{{ __('Period of validity') }}:</div>
                <div><label for="offer__period_from" class="col-form-label text-md-end">{{ __('from') }}:</label>
                    <input id="offer__period_from" type="datetime-local" class="form-control @error('period_from') is-invalid @enderror" name="period_from" value="{{ old('period_from', isset($offer) ? $offer->period_from : null) }}">
                    @error('period_from')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="offer__period_to" class="col-form-label text-md-end">{{ __('till') }}:</label>
                    <input id="offer__period_to" type="datetime-local" class="form-control @error('period_to') is-invalid @enderror" name="period_to" value="{{ old('period_to', isset($offer) ? $offer->period_to : null) }}">
                    @error('period_to')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            </div>

            <div class="offer__create mb-1">
                <label for="offer_brand_type" class="col-form-label text-md-end">{{ __('Brand') }}:</label>

                <button type="button" class="btn btn-light btn-secondary mb-1 select_reset-btn">{{ __('Reset') }}</button>

                <select id="offer_brand_type" class="form-select @error('offer_brand_type') is-invalid @enderror" size="4" multiple name="offer_brand_type[]" aria-label="{{ __('Brand type') }}">

                    @foreach ($brands as $brand)

                        <option value="{{ $brand->id }}" @selected(old('offer_brand_type', '{{ $brand->brand_name }}') == (isset($offer) && $offer->brands?->contains($brand)) ? $brand->brand_name : null) >{{ $brand->brand_name }}</option>
                    @endforeach

                </select>
                    @error('offer_brand_type')
                        <span class="invalid-feedback select_error_msg" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="offer__create mb-1">
                <label for="offer_categories" class="col-form-label text-md-end">{{ __('Categories') }}:</label>
                <button type="button" class="btn btn-light btn-secondary mb-1 select_reset-btn">{{ __('Reset') }}</button>
                <select id="offer_categories" class="form-select @error('offer_categories') is-invalid @enderror" size="4" multiple name="offer_categories[]" aria-label="{{ __('Categories') }}">

                    {{-- @foreach ($categories as $category)
                        <option value="{{ $brand->brand_name }}" @selected(old('offer_categories', '{{ $brand->brand_name }}') == (isset($brand) ? $brand->brand_name : null))>{{ $brand->brand_name }}</option>
                    @endforeach --}}

                </select>
                    @error('offer_categories')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="offer__create mb-1">
                <label for="offer_product_groups" class="col-form-label text-md-end">{{ __('Product groups') }}:</label>
                <button type="button" class="btn btn-light btn-secondary mb-1 select_reset-btn">{{ __('Reset') }}</button>
                <select id="offer_product_groups" class="form-select @error('offer_product_groups') is-invalid @enderror" size="4" multiple name="offer_product_groups[]" aria-label="{{ __('Product groups') }}">
{{--
                    @foreach ($productGroups as $productGroup)
                        <option value="{{ $brand->brand_name }}" @selected(old('offer_product_groups', '{{ $brand->brand_name }}') == (isset($brand) ? $brand->brand_name : null))>{{ $brand->brand_name }}</option>
                    @endforeach --}}

                </select>
                    @error('offer_product_groups')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>


            <button type="submit" onClick="()=> {submit()}" class="btn btn-success align-self-center btn__offer__form-create" href="">{{ isset($offer) ? __('Edit') : __('Create') }}</button>
        </form>


    </div>

</div>

@endsection


