@extends('admin.layout.app')

@section('title', isset($email_message) ? __('Update').' '.__('message') :  __('Create').' '.__('message'))

@section('content')

<div class="container">

    <div class="admin__messages__section-create d-flex flex-column align-items-center justify-content-start">

        <h2>{{ isset($email_message) ? __('Update') : __('Create') }} {{ __('message') }}</h2>

        <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.messages.index') }}">{{ __('Back') }}</a>

        <form method="POST"
            @if (isset($email_message))
                action="{{ route('admin.messages.update', $email_message) }}"
            @else

                action="{{ route('admin.messages.store') }}"
            @endif class="form-message">
            @csrf
            @isset($email_message)
                @method('PUT')
            @endisset

            <div class="message__create__subject mb-1">
                <label for="subject" class="col-form-label text-md-end">Тема:</label>
                <div class="subject_input">
                    <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject', isset($email_message) ? $email_message->subject : null) }}"  autocomplete="subject" autofocus placeholder="Тема:">
                    @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="message__create__subject mb-1">
                <label for="subject_en" class="col-form-label text-md-end">Subject in English:</label>
                <div class="subject_input">
                    <input id="subject_en" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject_en" value="{{ old('subject_en', isset($email_message) ? $email_message->subject_en : null) }}"  autocomplete="subject_en" autofocus placeholder="Subject in English">
                    @error('subject_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="message__create__subject mb-1">
                <label for="type" class="col-form-label text-md-end">{{ __('Type') }}:</label>
                <select id="type" class="form-select @error('subject') is-invalid @enderror" name="type" aria-label="{{ __('Message type') }}">
                    <option  @if(!isset($email_message)) selected @endif disabled>{{ __('Message type') }}</option>
                    <option value="discount" @selected(old('type', 'discount') == (isset($email_message) ? $email_message->type : null))>{{ __('discount') }}</option>
                    <option value="promo-action" @selected(old('type', 'promo-action') == (isset($email_message) ? $email_message->type : null)) >{{ __('promo-action') }}</option>
                    <option value="notification" @selected(old('type', 'notification') == (isset($email_message) ? $email_message->type : null))>{{ __('notification') }}</option>
                </select>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="message__create__addition-data mb-1">
                <label for="addition_data" class="col-form-label text-md-end">Дополнительная информация:</label>
                <textarea id="addition_data" rows="5" class="form-control" name="additional_info"  autocomplete="addition_data" autofocus placeholder="Дополнительная информация">{{ isset($email_message) ? $email_message->additional_info : null }}</textarea>
            </div>

            <div class="message__create__addition-data mb-1">
                <label for="addition_data_en" class="col-form-label text-md-end">Additional data in English:</label>
                <textarea id="addition_data_en" rows="5" class="form-control" name="additional_info_en"  autocomplete="addition_data_en" autofocus placeholder="Additional data in English">{{ isset($email_message) ? $email_message->additional_info_en : null }}</textarea>
            </div>

            <button class="btn btn-success align-self-center btn__message__form-create" href="">{{ isset($email_message) ? __('Update') : __('Create') }}</button>
        </form>

    </div>
</div>

@endsection


