@extends('layouts.index')

@section('title', __('Profile'))

@section('content')

    <div class="container">

        <section class="user-card">
            <div class="user-card-header">
                <h2>{{ $user->name }}</h2>
                <p>BLife ID: {{ $user->id }} > {{ __('since') }} {{ $user->created_at }}</p>
            </div>

            <ul class="user-card-credentials">
                <li class="credentials-item">
                    <p class="item-name">{{ __('Name or nickname') }}</p>
                    <p>{{ $user->name }}</p>
                    <p><a  href="{{ route ('person.reset_username', $user) }}">{{ __('Reset') }}</a></p>
                </li>
                <li class="credentials-item">
                    <p class="item-email">{{ __('E-mail') }}</p>
                    <p >{{ $user->email }}</p>
                    <p><a href="{{ route ('person.get_check_form_email') }}">{{ __('Reset') }}</a></p>
                </li>
                <li class="credentials-item">
                    <p class="item-reset-password">{{ __('Reset Password') }}</p>
                    <p><a href="{{ route ('person.get_check_form_password') }}">{{ __('Reset') }}</a></p>
                </li>
            </ul>

        </section>



    </div>

@endsection
