@extends('admin.layout.app')

@section('title', isset($consumer) ? __('Edit').' '.__('Consumer') :  __('Create').' '.__('Consumer'))

@section('content')

<div class="container">

    <div class="admin__consumers__section-create d-flex flex-column align-items-center justify-content-start">

        <h2>{{ __('Consumer') }} {{ isset($consumer) ? __('Edit') : __('Create') }}</h2>

        @if (isset($consumer))
            @if((url()->previous()) && (url()->previous() !== route('admin.consumers.edit', $consumer)))

                <a class="btn btn-light align-self-end  btn-return" href="{{ url()->previous() }}">{{ __('Back') }}</a>
            @else
                <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.consumers.index') }}">{{ __('Back') }}</a>
            @endif
        @else

            @if((url()->previous()) && (url()->previous() !== route('admin.consumers.create')))

                <a class="btn btn-light align-self-end  btn-return" href="{{ url()->previous() }}">{{ __('Back') }}</a>
            @else
                <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.consumers.index') }}">{{ __('Back') }}</a>
            @endif
        @endif

        <form method="POST"
            @if (isset($consumer))
                action="{{ route('admin.consumers.update', $consumer) }}"
            @else
                action="{{ route('admin.consumers.store') }}"
            @endif enctype="multipart/form-data" class="form_consumers">

            @csrf
            @isset($consumer)
                @method('PUT')
            @endisset

            <div class="consumer__create mb-1">
                <label for="consumer_code" class="col-form-label text-md-end">{{ __('Code') }}:</label>
                <div class="consumer_code_input">
                    <input id="consumer_code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code', isset($consumer) ? $consumer->code : null) }}"  autocomplete="code" autofocus placeholder="{{ __('Code') }}">
                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="consumer__create mb-1">
                <label for="consumer_name" class="col-form-label text-md-end">Потребитель:</label>
                <div class="consumer_name_input">
                    <input id="consumer_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', isset($consumer) ? $consumer->name : null) }}"  autocomplete="name" autofocus placeholder="Потребитель">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="consumer__create mb-1">
                <label for="consumer_name_en" class="col-form-label text-md-end">Consumer in English:</label>
                <div class="consumer_name_en_input">
                    <input id="consumer_name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en', isset($consumer) ? $consumer->name_en : null) }}"  autocomplete="name_en" autofocus placeholder="Consumer in English">
                    @error('name_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

           <button type="submit" onClick="()=> {submit()}" class="btn btn-success align-self-center btn__consumer__form-create" href="">{{ isset($consumer) ? __('Edit') : __('Create') }}</button>
        </form>


    </div>

</div>

@endsection


