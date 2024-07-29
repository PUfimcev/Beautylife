@extends('layouts.index')

@section('title', __('about company'))

@section('crumbs')
    <ul class="crumbs__list d-flex justify-content-start align-items-center gap-1">
        <li><a class="crumbs__reffers" href="{{ route('index') }}">{{ __('Main page')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><span>{{ __('About company')}}</span></li>
    </ul>
@endsection

@section('content')

<section class="about">

    <div class="about_company">

        <h1>BeautyLife</h1>

        <h2>{{ __('About company')}}</h2>

        <p>{{ __('BeautyLife is not just an online store and a network of branded offline stores. This is a community of people who make a conscious choice in favor of naturalness, naturalness and effectiveness') }}.</p>
        <p>{{ __('We have collected for you more than 150 brands of natural and effective cosmetics from all over the world, presented in all categories. Here you will find products tailored to your preferences and features') }}:</p>
        <ul>
            <li>{{ __('facial care cosmetics for all skin types and ages') }},</li>
            <li>{{ __('products for effective and SPA body care at home') }},</li>
            <li>{{ __('safe cosmetics for children from birth') }},</li>
            <li>{{ __('cosmetics and products for men') }},</li>
            <li>{{ __('home and professional cosmetics for hair and scalp care') }},</li>
            <li>{{ __('useful and fashionable accessories') }}.</li>
        </ul>
        <p>{{ __('We have been working for you since 2006. Our partners include only trusted manufacturers whose products, developments and production conditions meet all international requirements') }}.</p>
        <p>{{ __('Our main criteria when choosing a particular cosmetic brand are the naturalness and high quality of the ingredients, as well as their effectiveness and complete safety') }}.</p>
        <p>{{ __('All brands presented in our stores have undergone careful selection and strict testing. And a professional team of specialists in the field of cosmetology allows us to monitor the most significant new products on the global market of cosmetic products and replenish the assortment of DNA stores with the best of them') }}.</p>

        <h3>{{ __('Customer service is excellent') }}</h3>

        <p>{{ __('It is important to us that our cooperation with you brings you pleasure. To provide our customers with high service, we work on weekends and holidays') }}.</p>
        <p>{{ __('Our managers are assistants and consultants. They will be happy to help you choose cosmetics based on your wishes, and will also tell you how to place an order and make payment. Managers answer questions by phone, online chat and through feedback forms') }}.</p>

        <p class="about__selected_text">{{ __('During the consultation, we take into account your purchase history and communication with us to personalize our answers and offers. It is important for us to resolve the issue quickly and efficiently. Forming long-term relationships with clients is one of the main goals of our company. We understand that it is more convenient for you to buy goods in a store where they know your preferences and help you make the right choice') }}.</p>
        <p>{{ __('Sales consultants of the DNA network regularly undergo professional training. An in-depth study of the range of products allows them to thoroughly possess information about the composition and effect of cosmetics and their individual components, as well as competently advise customers, helping them make the best choice') }}.</p>

        <h3>{{ __('An integrated approach to goods and services') }}</h3>

        <p>{{ __('Buying cosmetics is simple only at first glance, since it is important to take care of comprehensive care to achieve maximum results') }}.</p>
        <p>{{ __('We create our product catalog in such a way that you can easily choose a set of tools to solve your particular problem') }}.</p>
        <p>{{ __('If you have any difficulties choosing cosmetics, you can always turn to our specialists for help. We will provide professional advice and promptly deliver your order anywhere in Belarus and Russia') }}.</p>

        <h3>{{ __('Discounts and bonuses for every buyer') }}</h3>

        <p>{{ __('There is not a single day of the year when we do not have a promotion or special price. The PROMOTIONS section operates 24x7. And for every purchase you receive bonuses under our loyalty program, with which you can pay up to 20% of the cost of a non-promotional product') }}.</p>

        <h3>{{ __('Honest customer reviews') }}</h3>

        <p>{{ __('We publish all reviews: we do not delete, do not edit, we post everything as is. Because it\'s honest. Your impressions, advice and recommendations help others make the right choice') }}.</p>

    </div>
</section>


@endsection

