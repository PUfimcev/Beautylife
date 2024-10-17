@extends('admin.layout.app')

@section('title', isset($category) ? __('Edit').' '.__('category') :  __('Create').' '.__('category'))

@section('content')

<div class="container">

    <div class="admin__categories__section-create d-flex flex-column align-items-center justify-content-start">

        <h2>{{ isset($category) ? __('Edit') : __('Create') }} {{ __('category') }}</h2>

        @if (isset($category))
            @if((url()->previous()) && (url()->previous() !== route('admin.categories.edit', $category)))

                <a class="btn btn-light align-self-end  btn-return" href="{{ url()->previous() }}">{{ __('Back') }}</a>
            @else
                <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.categories.index') }}">{{ __('Back') }}</a>
            @endif
        @else

            @if((url()->previous()) && (url()->previous() !== route('admin.categories.create')))

                <a class="btn btn-light align-self-end  btn-return" href="{{ url()->previous() }}">{{ __('Back') }}</a>
            @else
                <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.categories.index') }}">{{ __('Back') }}</a>
            @endif
        @endif

        <form method="POST"
            @if (isset($category))
                action="{{ route('admin.categories.update', $category) }}"
            @else
                action="{{ route('admin.categories.store') }}"
            @endif enctype="multipart/form-data" class="form_category">

            @csrf
            @isset($category)
                @method('PUT')
            @endisset

            <div class="category__create mb-1">
                <label for="category_code" class="col-form-label text-md-end">{{ __('Code') }}:</label>
                <div class="category_code_input">
                    <input id="category_code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code', isset($category) ? $category->code : null) }}"  autocomplete="code" autofocus placeholder="{{ __('Code') }}">
                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="category__create mb-1">
                <label for="category_name" class="col-form-label text-md-end">Название категории:</label>
                <div class="category_name_input">
                    <input id="category_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', isset($category) ? $category->name : null) }}"  autocomplete="name" autofocus placeholder="Название категории">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="category__create mb-1">
                <label for="category_name_en" class="col-form-label text-md-end">Category name in English:</label>
                <div class="category_name_en_input">
                    <input id="category_name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en', isset($category) ? $category->name_en : null) }}"  autocomplete="name_en" autofocus placeholder="Category name in English">
                    @error('name_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="category__create mb-1">
                <label for="categoryFile" class="col-form-label">{{ isset($category) ? __('Change category picture') : __('Create category picture') }}:</label>

                @if (isset($category))
                    @if($category->image_route !== null)

                        <p>{{ __('The downloaded picture') }}:</p>
                        <img class="category__image"
                        src="{{ asset('storage/'.$category->image_route) }}" alt="{{ __('Image') }}" />

                        <input class="form-control @error('categoryFile') is-invalid @enderror" type="file" id="categoryFile" name="categoryFile" value="{{ old('categoryFile', isset($category) ? $category->image_route : null) }}" accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >
                        @error('categoryFile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    @else
                        <p>{{ __('No picture') }}.</p>
                        <input class="form-control @error('categoryFile') is-invalid @enderror" type="file" id="categoryFile" name="categoryFile"  accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >
                        @error('categoryFile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    @endif
                @else

                    <input class="form-control @error('categoryFile') is-invalid @enderror" type="file" id="categoryFile" name="categoryFile"  accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >
                    @error('categoryFile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                @endif

            </div>

           <button type="submit" onClick="()=> {submit()}" class="btn btn-success align-self-center btn__category__form-create" href="">{{ isset($category) ? __('Edit') : __('Create') }}</button>
        </form>


    </div>

</div>

@endsection


