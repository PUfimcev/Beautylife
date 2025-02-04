<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-size: 16px;
    }

    a{
        display: inline-block;
        text-decoration: none;
        color: #987B75 !important;
    }

    @media only screen and (max-width: 2560px) {

        .message{
            padding: 20px;
        }

        header{
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1rem auto;
        }


        .header_links{
            display: flex;
            gap: 16px;
            margin-left: 32px;
        }

        .header_links-1{
            margin-right: 16px;
        }

        .headbar-brand__logo > a{
            font-size: 2rem;
            line-height: 1.5rem;
        }

        .message_title{
            margin-top: 2rem;
        }

        .message_title, .message_intro{
            color: #000;
            margin-bottom: 1rem;
        }

        .info_item{
            color: #530C0C;
            font-weight: 600;
        }

        .products_list{
            height: 100px;
        }


        .footer {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            width: 100%;
            margin: 1.5rem auto;
            font-size: 12px !important;
        }

        .message__contact-data{
            margin-top: 1rem;
        }

        .message__contact-data > h3{
            color: #530C0C;
            font-weight: 600;
            margin-top: 1rem;
        }

        .message__contact-data > p{
            font-size: 14px !important;
        }

        .message__text-1{
            font-size: 14px !important;
            margin-bottom: 1rem;
        }

        .message__text-2{
            margin-bottom: 1rem;
        }

        .social-media{
            width: 100%;
            display: flex;
            justify-content:flex-start;
            align-items: center;
            gap: 48px;
            margin: 1rem 0;
        }

        .social-media>p{
            margin-right: 32px;
        }

        .unsubscribe > p{
            margin-top: 1rem;
            font-size: 14px !important;
        }

    }


    @media only screen and (max-width: 600px) {
        .message{
            padding: 0;
        }

        .header_links-1{
            margin-right: 0;
        }

    }

    </style>

</head>
<body>

    <div class="container">
        <div class="message">
            <header>
                <div class="headbar-brand__logo">
                    <a  href="{{ route('index') }}">BLife</a>
                </div>
                <div class="header_links">
                    <a class="header_links-1" href="{{ route('offers') }}" class="nav_link-offers">{{__('Offers')}}</a>
                    <a class="header_links-2" href="{{ route('catalog') }}" class="nav_link-catalog">{{__('Catalog')}}</a>
                </div>
            </header>

            <main>
                <h5 class="message_title">{{ __('Dear') }}, {{ isset($subscribe->name) ? $subscribe->name : __('User')}}!</h5>
                <p class="message_intro">{{ __('We are glad to inform you about our pleasant proposals.') }}</p>

                <div class="message_additional-info">
                    @isset($mailbody->additional_info)
                        <p class="info_item">{{ $mailbody->langField('additional_info') }}</p>
                    @endisset
                </div>
            </main>

            <footer>

                <p class="message__text-1">{{ __('The indicated prices and discounts are actual at the moment of sending this email. The current mailling is no offer. Far more product offers you will find on the site') }} <a href="{{ route('index') }}" class="message__link_to_site">BeautyLife</a></p>

                <p class="message__text-2">{{ __('Thank you for being with us!') }}</p>

                <p class="request__review">{{ __('Help us to get better. Put a review about us. Press ') }}<a href="{{ route('reviews.create') }}" class="request__review_link" title="{{ __('Review') }}">{{ __('Review') }}</a></p>

                <div class="message__contact-data">
                    <h3>BeautyLife</h3>
                    <p>{{ __('Phone number') }}: <a class="phone" href="tel:+350123230231" role="button" title="phone">+350 123 230 231</a></p>
                    <p>E-mail: <a href="mailto:BeautyLife@mail.com" class="message__email">BeautyLife@mail.com</a></p>
                </div>
                <div class="message_social_media-rights">
                    <div class="social-media">
                        <p><a class="instagram" href="https://www.instagram.com/instagram/" role="button"><img src="{{  $message->embed( asset('/storage/email_images/instagram_sign.png'))  }}" alt="Instagram sign" ></a></p>
                        <p><a class="facebook" href="https://www.facebook.com/" role="button"><img src="{{ $message->embed(
                            asset("/storage/email_images/facebook_sign.png")
                        ) }}" alt="Facebook sign"></a></p>
                        <p><a class="x" href="https://twitter.com/" role="button"><img src="{{ $message->embed(
                            asset("/storage/email_images/twitter_sign.png")
                        ) }}" alt="X sign"></a></p>
                    </div>
                    <p class="copyrights">2024 © BeautyLife</p>
                </div>
                <div class="unsubscribe">
                    <p>{{ __('In case you don\'t want to receive an email more, press') }} <a href="{{ route('unsubscribe', $subscribe) }}" class="unsubscribe_link">{{ __('Unsubscribe') }}</a></p>
                </div>
            </footer>
        </div>
    </div>
</body>

