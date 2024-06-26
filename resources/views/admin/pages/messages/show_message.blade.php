@extends('admin.layout.app')

@section('title', __('Message'))

@section('content')

<div class="container">

    <div class="admin__messages__section-show d-flex flex-column align-items-center justify-content-start gap-3">

        <h2>{{ __('Message') }}</h2>

        <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.messages.index') }}">{{ __('Back') }}</a>

        <div class="message_details">
            <ul class="message_details_list">
                <li><span class="details-name">id:</span><span class="details-content">{{ $email_message->id }}</span></li>
                <li><span class="details-name">Заголовок: </span><span class="details-content">{{ $email_message->subject }}</span></li>
                <li><span class="details-name">Subject: </span><span class="details-content">{{ $email_message->subject_en }}</span></li>
                <li><span class="details-name">Тип: </span><span class="details-content">{{ $email_message->type }}</span></li>
                <li><span class="details-name">Доп. данные: </span><span class="details-content">{{ $email_message->additional_info !== null ? $email_message->additional_info : ' --- ' }}</span></li>
                <li><span class="details-name">Additional data: </span><span class="details-content">{{ $email_message->additional_info_en !== null ? $email_message->additional_info_en : ' --- ' }}</span></li>
                <li><span class="details-name">{{ __('Create date') }}: </span><span class="details-content">{{ $email_message->created_at }}</span></li>
                <li><span class="details-name">{{ __('Update date') }}: </span><span class="details-content">{{ $email_message->updated_at }}</span></li>
            </ul>
        </div>

        <form method="POST" action="{{ route('admin.messages.destroy', $email_message) }}">
            @csrf
            @method('DELETE')
            <a class="btn btn-primary" href="{{ route('admin.mail_message', $email_message) }}"><span>{{ __('Send') }}</span></a>
            <a class="btn btn-warning" href="{{ route('admin.messages.edit', $email_message) }}"><span>{{ __('Update') }}</span></a>
            <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
        </form>

    </div>
</div>

@endsection
