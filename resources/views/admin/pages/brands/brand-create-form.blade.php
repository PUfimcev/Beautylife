@extends('admin.layout.app')

@section('title', isset($brand) ? __('Edit').' '.__('brand') :  __('Create').' '.__('review'))

@section('content')

<div class="container">

    <div class="admin__brands__section-create d-flex flex-column align-items-center justify-content-start">

        <h2>{{ isset($brand) ? __('Edit') : __('Create') }} {{ __('brand') }}</h2>

        <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.brands.index') }}">{{ __('Back') }}</a>


        <form method="POST"
            @if (isset($brand))
                action="{{ route('admin.brands.update', $brand) }}"
            @else
                action="{{ route('admin.brands.store') }}"
            @endif enctype="multipart/form-data" class="form_brand">

            @csrf
            @isset($brand)
                @method('PUT')
            @endisset

            <div class="brand__create mb-1">
                <label for="brand_name" class="col-form-label text-md-end">{{ __('Brand name') }}:</label>
                <div class="brand_name_input">
                    <input id="brand_name" type="text" class="form-control @error('brand_name') is-invalid @enderror" name="brand_name" value="{{ old('brand_name', isset($brand) ? $brand->brand_name : null) }}"  autocomplete="brand_name" autofocus placeholder="{{ __('Brand name') }}">
                    @error('brand_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="brand__create mb-1">
                <label for="brand_about" class="col-form-label text-md-end">Аннотация бренда:</label>

                <div class="brand_about-1">
                    <textarea id="brand_about" rows="3" class="form-control @error('brand_about') is-invalid @enderror" name="brand_about"  value="{{ old('brand_about', isset($brand) ? $brand->brand_about : null) }}" autofocus placeholder="Аннотация бренда">{{ isset($brand) ? $brand->brand_about : null }}</textarea>
                    @error('brand_about')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="brand__create mb-1">
                <label for="brand_about_en" class="col-form-label text-md-end">Brand summary in English:</label>

                <div class="brand_about_en">
                    <textarea id="brand_about_en" rows="3" class="form-control @error('brand_about_en') is-invalid @enderror" name="brand_about_en"  value="{{ old('brand_about_en', isset($brand) ? $brand->brand_about_en : null) }}" autofocus placeholder="Brand summary in English">{{ isset($brand) ? $brand->brand_about_en : null }}</textarea>
                    @error('brand_about_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="brand__create mb-1">
                <label for="brandFile" class="col-form-label">{{ isset($brand) ? __('Change brand logo') : __('Brand logo') }}:</label>

                @if (isset($brand))
                    @if($brand->brand_image_route !== null)

                        <p>{{ __('The downloaded picture') }}:</p>
                        <img class="brand__image"
                        src="{{ asset('storage/'.$brand->brand_image_route) }}" alt="{{ __('Image') }}" />

                        <input class="form-control" type="file" id="brandFile" name="brandFile" value="{{ old('brandFile', isset($brand) ? $brand->brand_image_route : null) }}" accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >
                    @else
                        <p>{{ __('No picture') }}.</p>
                        <input class="form-control" type="file" id="brandFile" name="brandFile"  accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >
                    @endif
                @else

                    <input class="form-control @error('brandFile') is-invalid @enderror" type="file" id="brandFile" name="brandFile"  accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >
                    @error('brandFile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                @endif

            </div>

            <div class="brand__create mb-1">
                <label for="brand_description" class="col-form-label text-md-end">Описание бренда:</label>

                <div class="brand_description">

                    <textarea id="brand_description" rows="5" class="form-control @error('brand_description') is-invalid @enderror" name="brand_description"  value="{{ old('brand_description', isset($brand) ? $brand->brand_description : null) }}" autofocus placeholder="Описание бренда">{{ isset($brand) ? $brand->brand_description : null }}</textarea>
                    @error('brand_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="brand__create mb-1">
                <label for="brand_description_en" class="col-form-label text-md-end">Brand description in English:</label>

                <div class="brand_description_en">

                    <textarea id="brand_description_en" rows="5" class="form-control @error('brand_description_en') is-invalid @enderror" name="brand_description_en"  value="{{ old('brand_description_en', isset($brand) ? $brand->brand_description_en : null) }}" autofocus placeholder="Brand description in English">{{ isset($brand) ? $brand->brand_description_en : null }}</textarea>
                    @error('brand_description_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <button type="submit" onClick="()=> {submit()}" class="btn btn-success align-self-center btn__brand__form-create" href="">{{ isset($brand) ? __('Edit') : __('Create') }}</button>
        </form>


    </div>

</div>

@endsection


