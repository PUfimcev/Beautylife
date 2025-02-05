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

    /* @media only screen and (max-width: 2560px) { */

        .container{
            width: min(95%, 45rem);
            margin: 0 auto;
        }

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

        .message_additional-info{
            width: 100%;
            margin-bottom: 2rem;
        }

        .offer{
            display: block !important;
            width: 100%;
        }

        .offer_head{
            width: 100%;
            height: 20rem;
        }

        .image{
            display: block;
            width: clamp(20.5rem, 100%, 35rem);
            height: 100%;
            /* object-fit: contain; */
            object-fit: cover;
        }

        .offer_content{
            color: #530C0C;
            width: 85%;
        }

        .offer_title{
            font-size: 1.5rem;
        }

        .link_to_page{
            width: 80%;
            font-size: 1.2rem;
            color: #de2323;
            font-weight: 500;
            text-align: end;
        }


        .info_item{
            color: #530C0C;
            font-weight: 600;
        }

        .products_list{
            width: 100%;
            margin: 1rem auto;
        }

        .newArrivals{
            margin-top: 1rem;
        }
        .products_list-title{
            color: #530C0C;
            margin-bottom: 1rem;
        }
        .bestseller_product__element, .newArrival_product__element{
            width: 100%;
            border-bottom: 1px solid #987B75;
            list-style: none;
            margin: 0.5rem 0;
        }

        /* .bestseller__element{
            width: 100%;
            height: 100%;
        } */

        .bestseller__image, .newArrival__image{
            width: 100%;
            max-height: 10rem !important;
            /* object-fit: contain; */
            object-fit: contain;
            margin-bottom: 0.4rem;
        }

        .content_text{
            color: #530C0C;
            text-decoration: underline;
            margin-bottom: 0.4rem;
        }

        .price{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 1rem;
            margin-bottom: 0.4rem;
            margin-left: auto;
        }

        .discount-price{
            margin-right: 1rem;
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
        .message_social_media-rights{
            width: 100%;
        }

        .social-media{
            width: 100%;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            margin: 1rem 0;
        }

        .social-media>p{
            margin-right: 4rem;
        }

        .unsubscribe > p{
            margin-top: 1rem;
            font-size: 14px !important;
        }

    /* } */

    @media only screen and (max-width: 600px) {
        .message{
            padding: 0;
        }

        .header_links-1{
            margin-right: 0;
        }

        .offer_head{
            height: 20rem;
            position: relative;
        }

        .offer_content{
            position: absolute;
            top: 15px;
            right: 5px;
        }

        .image{
            margin: 0 auto;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        .link_to_page{
            width: 100%;
        }

        .social-media{
            justify-content:space-around;

        }
        .social-media>p{
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
                    <a class="offer" href="{{ route('offers', $mailbody) }}" title="{{ $mailbody->langField('title') }}">
                        <div class="offer_head">


                            @if(isset($mailbody->image_route) && !empty($mailbody->image_route))
                                <img class="image" src="{{ $message->embed(asset('storage/'.$mailbody->image_route)) }}" alt="{{ __('Offer picture') }}">
                            @endif

                            <div class="offer_content">

                                <h3 class="offer_title">{{ $mailbody->langField('title') }}</h3>

                                <p class="offer_summary">{{ $mailbody->langField('about') }}</p>

                            </div>
                        </div>
                        <p class="link_to_page">{{ __('learn more') }}</p>
                    </a>

                </div>

                <div class="products_list">

                    @isset($bestsellers)
                    <h3 class="products_list-title">{{  __('Bestsellers') }}</h3>
                    <ul class="bestsellers__list">
                        @foreach ($bestsellers  as $bestseller)
                        <li class="bestseller_product__element">

                            <div  class="bestseller__element">
                                <div class="bestseller_top">


                                    @if($bestseller->productImages->count() > 0)

                                        <img class="bestseller__image" src="{{ $message->embed(asset('storage/'.$bestseller->productImages[0]->route)) }}" alt="{{ __('Image') }}" />

                                    @else
                                        <span class="no_picture">{{ __('No picture') }}</span>
                                    @endif
                                </div>
                                <div class="bestseller__content">

                                    <a class="content_text" href="{{ route('product', [$bestseller->getCategory()->first(), $bestseller->getSubcategory()->first(), $bestseller]) }}">{{ $bestseller->langField('name') }}</a>
                                </div>

                                <div class="price">

                                    @if($bestseller->reduced_price > 0)
                                        <p class="discount-price">BYN {{ $bestseller->reduced_price }}</p>
                                    @endif

                                    <p class="total-price"  @if($bestseller->reduced_price > 0) style="text-decoration-line: line-through; opacity: 0.5" @endif>BYN {{ $bestseller->price }}</p>

                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endisset

                    @isset($newArrivals)
                    <h3 class="products_list-title newArrivals">{{  __('New arrivals') }}</h3>
                    <ul class="newArrivals__list">
                        @foreach ($newArrivals  as $newArrival)
                        <li class="newArrival_product__element">

                            <div  class="newArrival__element">
                                <div class="newArrival_top">

                                    @if($newArrival->productImages->count() > 0)

                                        <img class="newArrival__image" src="{{ $message->embed(asset('storage/'.$newArrival->productImages[0]->route)) }}" alt="{{ __('Image') }}" />

                                    @else
                                        <span class="no_picture">{{ __('No picture') }}</span>
                                    @endif
                                </div>
                                <div class="newArrival__content">

                                    <a class="content_text" href="{{ route('product', [$newArrival->getCategory()->first(), $newArrival->getSubcategory()->first(), $newArrival]) }}">{{ $newArrival->langField('name') }}</a>
                                </div>

                                <div class="price">

                                    @if($newArrival->reduced_price > 0)
                                        <p class="discount-price">BYN {{ $newArrival->reduced_price }}</p>
                                    @endif

                                    <p class="total-price"  @if($newArrival->reduced_price > 0) style="text-decoration-line: line-through; opacity: 0.5" @endif>BYN {{ $newArrival->price }}</p>

                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
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

