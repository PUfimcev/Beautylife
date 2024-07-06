@extends('layouts.index')

@section('title', $blog->langField('blog_title'))

@section('crumbs')
    <ul class="crumbs__list d-flex justify-content-start align-items-center gap-1">
        <li><a class="crumbs__reffers" href="{{ route('index') }}">{{ __('Main page')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><a class="crumbs__reffers" href="{{ route('blogs') }}">{{ __('Blogs')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><span>{{ $blog->langField('blog_title')}}</span></li>
    </ul>
@endsection

@section('content')

<section class="full_blog">

    <div class="full_blog_top">

        @if(isset($blog->blog_image_route) && !empty($blog->blog_image_route))
            <img class="image" src="{{ asset('storage/'.$blog->blog_image_route) }}" alt="{{ __('Image') }}">
        @endif

        <h2 class="reviews__title">{{  $blog->langField('blog_title') }}</h2>

        <span class="date">{{ Carbon\Carbon::parse($blog->created_at)->isoformat("D MMMM Y")  }}</span>

    </div>
    <div class="full_blog_content">

        @if( App::isLocale('ru'))
            @if (isset($blog->blog_summary) && !empty($blog->blog_summary))

                <p class="blog_summary">{{  $blog->blog_summary }}</p>
            @endif

            @if (isset($blog->blog_subtitle_1) && !empty($blog->blog_subtitle_1))

                <p class="blog_subtitle">{{  $blog->blog_subtitle_1 }}</p>
            @endif

            @if (isset($blog->blog_paragraph_1) && !empty($blog->blog_paragraph_1))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_1 }}</p>
            @endif

            @if (isset($blog->blog_subtitle_2) && !empty($blog->blog_subtitle_2))

                <p class="blog_subtitle">{{  $blog->blog_subtitle_2 }}</p>
            @endif

            @if (isset($blog->blog_paragraph_2) && !empty($blog->blog_paragraph_2))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_2 }}</p>
            @endif

            @if (isset($blog->blog_subtitle_3) && !empty($blog->blog_subtitle_3))

                <p class="blog_subtitle">{{  $blog->blog_subtitle_3 }}</p>
            @endif

            @if (isset($blog->blog_paragraph_3) && !empty($blog->blog_paragraph_3))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_3 }}</p>
            @endif

            @if (isset($blog->blog_subtitle_4) && !empty($blog->blog_subtitle_4))

                <p class="blog_subtitle">{{  $blog->blog_subtitle_4 }}</p>
            @endif

            @if (isset($blog->blog_paragraph_4) && !empty($blog->blog_paragraph_4))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_4 }}</p>
            @endif

            @if (isset($blog->blog_subtitle_5) && !empty($blog->blog_subtitle_5))

            <p class="blog_subtitle">{{  $blog->blog_subtitle_5 }}</p>
            @endif

            @if (isset($blog->blog_paragraph_5) && !empty($blog->blog_paragraph_5))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_5 }}</p>
            @endif

            @if (isset($blog->blog_subtitle_6) && !empty($blog->blog_subtitle_6))

            <p class="blog_subtitle">{{  $blog->blog_subtitle_6 }}</p>
            @endif

            @if (isset($blog->blog_paragraph_6) && !empty($blog->blog_paragraph_6))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_6 }}</p>
            @endif

            @if (isset($blog->blog_subtitle_7) && !empty($blog->blog_subtitle_7))

            <p class="blog_subtitle">{{  $blog->blog_subtitle_7 }}</p>
            @endif

            @if (isset($blog->blog_paragraph_7) && !empty($blog->blog_paragraph_7))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_7 }}</p>
            @endif

            @if (isset($blog->blog_subtitle_8) && !empty($blog->blog_subtitle_8))

            <p class="blog_subtitle">{{  $blog->blog_subtitle_8 }}</p>
            @endif

            @if (isset($blog->blog_paragraph_8) && !empty($blog->blog_paragraph_8))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_8 }}</p>
            @endif

            @if (isset($blog->blog_subtitle_9) && !empty($blog->blog_subtitle_9))

            <p class="blog_subtitle">{{  $blog->blog_subtitle_9 }}</p>
            @endif

            @if (isset($blog->blog_paragraph_9) && !empty($blog->blog_paragraph_9))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_9 }}</p>
            @endif

            @if (isset($blog->blog_subtitle_10) && !empty($blog->blog_subtitle_10))

            <p class="blog_subtitle">{{  $blog->blog_subtitle_10 }}</p>
            @endif

            @if (isset($blog->blog_paragraph_10) && !empty($blog->blog_paragraph_10))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_10 }}</p>
            @endif

        @endif


        @if( App::isLocale('en'))
            @if (isset($blog->blog_summary_en) && !empty($blog->blog_summary_en))

                <p class="blog_summary">{{  $blog->blog_summary_en }}</p>
            @endif


            @if (isset($blog->blog_subtitle_1_en) && !empty($blog->blog_subtitle_1_en))

                <p class="blog_subtitle">{{  $blog->blog_subtitle_1_en }}</p>
            @endif

            @if (isset($blog->blog_paragraph_1_en) && !empty($blog->blog_paragraph_1_en))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_1_en }}</p>
            @endif

            @if (isset($blog->blog_subtitle_2_en) && !empty($blog->blog_subtitle_2_en))

                <p class="blog_subtitle">{{  $blog->blog_subtitle_2_en }}</p>
            @endif

            @if (isset($blog->blog_paragraph_2_en) && !empty($blog->blog_paragraph_2_en))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_2_en }}</p>
            @endif

            @if (isset($blog->blog_subtitle_3_en) && !empty($blog->blog_subtitle_3_en))

                <p class="blog_subtitle">{{  $blog->blog_subtitle_3_en }}</p>
            @endif

            @if (isset($blog->blog_paragraph_3_en) && !empty($blog->blog_paragraph_3_en))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_3_en }}</p>
            @endif

            @if (isset($blog->blog_subtitle_4_en) && !empty($blog->blog_subtitle_4_en))

                <p class="blog_subtitle">{{  $blog->blog_subtitle_4_en }}</p>
            @endif

            @if (isset($blog->blog_paragraph_4_en) && !empty($blog->blog_paragraph_4_en))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_4_en }}</p>
            @endif

            @if (isset($blog->blog_subtitle_5_en) && !empty($blog->blog_subtitle_5_en))

                <p class="blog_subtitle">{{  $blog->blog_subtitle_5_en }}</p>
            @endif

            @if (isset($blog->blog_paragraph_5_en) && !empty($blog->blog_paragraph_5_en))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_5_en }}</p>
            @endif

            @if (isset($blog->blog_subtitle_6_en) && !empty($blog->blog_subtitle_6_en))

                <p class="blog_subtitle">{{  $blog->blog_subtitle_6_en }}</p>
            @endif

            @if (isset($blog->blog_paragraph_6_en) && !empty($blog->blog_paragraph_6_en))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_6_en }}</p>
            @endif

            @if (isset($blog->blog_subtitle_7_en) && !empty($blog->blog_subtitle_7_en))

                <p class="blog_subtitle">{{  $blog->blog_subtitle_7_en }}</p>
            @endif

            @if (isset($blog->blog_paragraph_7_en) && !empty($blog->blog_paragraph_7_en))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_7_en }}</p>
            @endif

            @if (isset($blog->blog_subtitle_8_en) && !empty($blog->blog_subtitle_8_en))

                <p class="blog_subtitle">{{  $blog->blog_subtitle_8_en }}</p>
            @endif

            @if (isset($blog->blog_paragraph_8_en) && !empty($blog->blog_paragraph_8_en))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_8_en }}</p>
            @endif

            @if (isset($blog->blog_subtitle_9_en) && !empty($blog->blog_subtitle_9_en))

                <p class="blog_subtitle">{{  $blog->blog_subtitle_9_en }}</p>
            @endif

            @if (isset($blog->blog_paragraph_9_en) && !empty($blog->blog_paragraph_9_en))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_9_en }}</p>
            @endif

            @if (isset($blog->blog_subtitle_10_en) && !empty($blog->blog_subtitle_10_en))

                <p class="blog_subtitle">{{  $blog->blog_subtitle_10_en }}</p>
            @endif

            @if (isset($blog->blog_paragraph_10_en) && !empty($blog->blog_paragraph_10_en))

                <p class="blog_paragraph">{{  $blog->blog_paragraph_10_en }}</p>
            @endif

        @endif

    </div>


</section>

@endsection
