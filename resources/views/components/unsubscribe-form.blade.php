@extends('components.component-layout.index')

@section('title', __('Unsubscription'))

@section('content')

<div class="container">


    <div class="unsubscribe row justify-content-center">
        <div class="unsubscribe__headbar d-flex justify-content-between align-items-center">
            <a class="headbar-brand__logo" href="{{ route('index') }}">BLife</a>
            <a class="unsubscribe_cancel-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
            </svg></a>
        </div>
        <div class="unsubscribe__card">

            <h5 class="unsubscribe__card-text">{{ __('We feel pity that you have decided to leave us') }}.</h5>

            <h5 class="unsubscribe__card-text">{{ __('We hope that you will have a change of heart and return') }}.</h5>

            <form class="unsubscribe__form" method="POST" action="{{ route('subscriptions.destroy', $subscription) }}">
                    @csrf
                    @method('DELETE')

                <div class="unsubscribe__button">
                    <button type="submit" class="btn btn-danger">
                        {{ __('Unsubscribe') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
    <script>document.querySelector('.unsubscribe_cancel-icon').addEventListener('click', () => {window.close()});</script>
</div>


@endsection
