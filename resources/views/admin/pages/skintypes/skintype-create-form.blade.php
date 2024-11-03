@extends('admin.layout.app')

@section('title', isset($skintype) ? __('Edit').' '.__('Skin type') :  __('Create').' '.__('Skin type'))

@section('content')

<div class="container">

    <div class="admin__skintypes__section-create d-flex flex-column align-items-center justify-content-start">

        <h2>{{ isset($skintype) ? __('Edit') : __('Create') }} {{ __('Skin type') }}</h2>

        @if (isset($skintype))
            @if((url()->previous()) && (url()->previous() !== route('admin.skintypes.edit', $skintype)))

                <a class="btn btn-light align-self-end  btn-return" href="{{ url()->previous() }}">{{ __('Back') }}</a>
            @else
                <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.skintypes.index') }}">{{ __('Back') }}</a>
            @endif
        @else

            @if((url()->previous()) && (url()->previous() !== route('admin.skintypes.create')))

                <a class="btn btn-light align-self-end  btn-return" href="{{ url()->previous() }}">{{ __('Back') }}</a>
            @else
                <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.skintypes.index') }}">{{ __('Back') }}</a>
            @endif
        @endif

        <form method="POST"
            @if (isset($skintype))
                action="{{ route('admin.skintypes.update', $skintype) }}"
            @else
                action="{{ route('admin.skintypes.store') }}"
            @endif enctype="multipart/form-data" class="form_skintypes">

            @csrf
            @isset($skintype)
                @method('PUT')
            @endisset

            <div class="skintype__create mb-1">
                <label for="skintype_code" class="col-form-label text-md-end">{{ __('Code') }}:</label>
                <div class="skintype_code_input">
                    <input id="skintype_code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code', isset($skintype) ? $skintype->code : null) }}"  autocomplete="code" autofocus placeholder="{{ __('Code') }}">
                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="skintype__create mb-1">
                <label for="skintype_name" class="col-form-label text-md-end">Название Типа кожи:</label>
                <div class="skintype_name_input">
                    <input id="skintype_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', isset($skintype) ? $skintype->name : null) }}"  autocomplete="name" autofocus placeholder="Тип кожи">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="skintype__create mb-1">
                <label for="skintype_name_en" class="col-form-label text-md-end">Skin type name in English:</label>
                <div class="skintype_name_en_input">
                    <input id="skintype_name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en', isset($skintype) ? $skintype->name_en : null) }}"  autocomplete="name_en" autofocus placeholder="Skin type name in English">
                    @error('name_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

           <button type="submit" onClick="()=> {submit()}" class="btn btn-success align-self-center btn__skintype__form-create" href="">{{ isset($skintype) ? __('Edit') : __('Create') }}</button>
        </form>


    </div>

</div>

@endsection


