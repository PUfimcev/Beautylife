{{-- footer mobile--}}

<div class="footer d-flex flex-column justify-content-between align-items-start m-auto">

    <div class="headbar-brand footer"><a class="headbar-brand__logo footer" href="{{ route('index') }}">BLife</a></div>

    <div class="footer__input-elements">
        <form method="POST" action="{{ route('subscriptions.store') }}">
            @csrf
                <label for="footer_email_input mobile" class="footer_email_title mobile row-form-label text-md-end">{{ __('Subscribe to BeautyLife letters') }}</label>
                <div class="footer_email_form mobile">
                        <input id="footer_mobile_email_input" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="E-mail"
                        onfocus=" if(event.target.value.length >= 0 && document.querySelector('.invalid-feedback') !== null) { event.target.classList.remove('is-invalid');}">
                        <button type="submit" class="footer_email-btn"></button>
                        @error('email')
                            <p class="invalid-feedback" role="alert">{{ $message }}</p>
                        @enderror
                </div>
        </form>
    </div>

    <nav class="footer__navbar__line">
        @includeIf('layouts.nav_mobile')
    </nav>

    <div class="footer_mobile_contact-details">
        <div class="contacts_data">
            <p class="schedule">{{ __('Daily') }} 10:00 - 21:00</p>
            <p><a class="phone" href="tel:+350123230231" role="button" title="phone">+350 123 230 231</a></p>
            <p><a href="mailto:BeautyLife@mail.com" class="email" title="email">BeautyLife@mail.com</a></p>
        </div>
        <div class="contacts_social_media-rights">
            <div class="social-media">
                <p><a class="itstagram" href="https://www.instagram.com/instagram/" role="button" target="_blank" title="itstagram"></a></p>
                <p><a class="facebook" href="https://www.facebook.com/" role="button" target="_blank" title="facebook"></a></p>
                <p><a class="x" href="https://twitter.com/" role="button" target="_blank" title="x"></a></p>
            </div>
            <p class="copyrights">2024 &#169 BeautyLife</p>
        </div>
    </div>

</div>


