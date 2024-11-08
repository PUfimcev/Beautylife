@extends('admin.layout.app')

@section('title', isset($agerange) ? __('Edit').' '.__('Age range') :  __('Create').' '.__('Age range'))

@section('content')

<div class="container">

    <div class="admin__ageranges__section-create d-flex flex-column align-items-center justify-content-start">

        <h2>{{ isset($agerange) ? __('Edit') : __('Create') }} {{ __('Age range') }}</h2>

        @if (isset($agerange))
            @if((url()->previous()) && (url()->previous() !== route('admin.ageranges.edit', $agerange)))

                <a class="btn btn-light align-self-end  btn-return" href="{{ url()->previous() }}">{{ __('Back') }}</a>
            @else
                <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.ageranges.index') }}">{{ __('Back') }}</a>
            @endif
        @else

            @if((url()->previous()) && (url()->previous() !== route('admin.ageranges.create')))

                <a class="btn btn-light align-self-end  btn-return" href="{{ url()->previous() }}">{{ __('Back') }}</a>
            @else
                <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.ageranges.index') }}">{{ __('Back') }}</a>
            @endif
        @endif

        <form method="POST"
            @if (isset($agerange))
                action="{{ route('admin.ageranges.update', $agerange) }}"
            @else
                action="{{ route('admin.ageranges.store') }}"
            @endif enctype="multipart/form-data" class="form_ageranges">

            @csrf
            @isset($agerange)
                @method('PUT')
            @endisset

            <div class="agerange__create mb-1">
                <label for="agerange_code" class="col-form-label text-md-end">{{ __('Code') }}:</label>
                <div class="agerange_code_input">
                    <input id="agerange_code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code', isset($agerange) ? $agerange->code : null) }}"  autocomplete="code" autofocus placeholder="{{ __('Code') }}">
                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="agerange__create mb-1">
                <label for="agerange_name" class="col-form-label text-md-end">Возрастной диапазон:</label>
                <div class="agerange_name_input">
                    <input id="agerange_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', isset($agerange) ? $agerange->name : null) }}"  autocomplete="name" autofocus placeholder="Возрастной диапазон">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="agerange__create mb-1">
                <label for="agerange_name_en" class="col-form-label text-md-end">Age range in English:</label>
                <div class="agerange_name_en_input">
                    <input id="agerange_name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en', isset($agerange) ? $agerange->name_en : null) }}"  autocomplete="name_en" autofocus placeholder="Age range in English">
                    @error('name_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

           <button type="submit" onClick="()=> {submit()}" class="btn btn-success align-self-center btn__agerange__form-create" href="">{{ isset($agerange) ? __('Edit') : __('Create') }}</button>
        </form>


    </div>

</div>

@endsection


