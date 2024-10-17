@extends('admin.layout.app')

@section('title', isset($subcategory) ? __('Edit').' '.__('subcategory') :  __('Create').' '.__('subcategory'))

@section('content')

<div class="container">

    <div class="admin__subcategories__section-create d-flex flex-column align-items-center justify-content-start">

        <h2>{{ isset($subcategory) ? __('Edit') : __('Create') }} {{ __('subcategory') }}</h2>


        @if((url()->previous()) && isset($subcategory))

            <a class="btn btn-light align-self-end  btn-return" href="{{ url()->previous() }}">{{ __('Back') }}</a>
        @else
             <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.subcategories.index', $category) }}">{{ __('Back') }}</a>
        @endif

        <form method="POST"
            @if (isset($subcategory))
                action="{{ route('admin.subcategories.update', [$category, $subcategory]) }}"
            @else
                action="{{ route('admin.subcategories.store', $category) }}"
            @endif>

            @csrf
            @isset($subcategory)
                @method('PUT')
            @endisset

            <div class="subcategory__create mb-1">
                <label for="subcategory_code" class="col-form-label text-md-end">{{ __('Code') }}:</label>
                <div class="subcategory_code_input">
                    <input id="subcategory_code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code', isset($subcategory) ? $subcategory->code : null) }}"  autocomplete="code" autofocus placeholder="{{ __('Code') }}">
                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="subcategory__create mb-1">
                <label for="subcategory_name" class="col-form-label text-md-end">Название подкатегории:</label>
                <div class="subcategory_name_input">
                    <input id="subcategory_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', isset($subcategory) ? $subcategory->name : null) }}"  autocomplete="name" autofocus placeholder="Название подкатегории">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="subcategory__create mb-1">
                <label for="subcategory_name_en" class="col-form-label text-md-end">Subcategory name in English:</label>
                <div class="subcategory_name_en_input">
                    <input id="subcategory_name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en', isset($subcategory) ? $subcategory->name_en : null) }}"  autocomplete="name_en" autofocus placeholder="Subcategory name in English">
                    @error('name_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

           <button type="submit" onClick="()=> {submit()}" class="btn btn-success align-self-center btn__subcategory__form-create" href="">{{ isset($subcategory) ? __('Edit') : __('Create') }}</button>
        </form>


    </div>

</div>

@endsection


