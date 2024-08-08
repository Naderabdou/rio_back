@extends('site.layouts.app')
@section('title', transWord('عن الشركة'))

@title(getSetting('seo_title', app()->getLocale()))
@description(Str::limit(getSetting('desc_seo', app()->getLocale()), 160))
@keywords(implode(',', json_decode(getSetting('keyword', app()->getLocale()))))
@image(asset('storage/' . getSetting('logo')))
@section('sub-header')
    <div class="title-page">
        <div class="main-container">
            <h2> {{ transWord('عن الشركة') }}</h2>
            <div class="breadcrumb-header">
                <a href="{{ route('site.home') }}"> {{ transWord('الرئيسية') }} </a>
                <img src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
                 <span> {{ transWord('عن الشركة') }}</span>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <main id="app">

        <section class="aboutus-page">
            <div class="aboutus-index">
                <div class="main-container h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-lg-7">
                            <div class="text-aboutus-index">
                                <h2> {{ transWord('عن الشركة ') }}</h2>
                                <p>
                                    {{ getSetting('home_about_desc', app()->getLocale()) }}
                                </p>
                                {{-- <a href="" class="ctm-btn">{{ transWord('أقرأ المزيد') }}</a> --}}
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="main-img-aboutus-index">

                                <div class="img-aboutus-index">
                                    <span>
                                        <img src="{{ asset('storage/' . getSetting('home_about_image')) }}" alt="">
                                    </span>
                                </div>
                                <div class="bg-about-index">
                                    <object data="{{ asset('site/images/logoabout.svg') }}" type="">
                                        <img src="{{ asset('site/images/logoabout.svg') }}" alt="">
                                    </object>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="aboutus-info mr-section">
                <div class="main-container">
                    <div class="row row-gap">
                        <div class="col-lg-4">
                            <div class="sub-aboutus-info">
                                <div class="img-aboutus-info">
                                    <img src="{{ asset('site/images/i1.png') }}" alt="">
                                </div>
                                <div class="text-aboutus-info">
                                    <h2>{{ transWord('رؤيتنا') }}</h2>
                                    <p>  {{ getSetting('our_vision', app()->getLocale()) }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="sub-aboutus-info">
                                <div class="img-aboutus-info">
                                    <img src="{{ asset('site/images/i2.png') }}" alt="">
                                </div>
                                <div class="text-aboutus-info">
                                    <h2>{{ transWord('رسالتنا') }}</h2>
                                    <p>  {{ getSetting('our_message', app()->getLocale()) }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="sub-aboutus-info">
                                <div class="img-aboutus-info">
                                    <img src="{{ asset('site/images/i3.png') }}" alt="">
                                </div>
                                <div class="text-aboutus-info">
                                    <h2>{{ transWord('مهمتنا') }}</h2>
                                    <p> {{ getSetting('our_mission', app()->getLocale()) }}  </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="ask-aboutus mr-section">
                <div class="row pg-none">
                    <div class="col-lg-5 pg-none">
                        <div class="img-ask-aboutus">
                            <img src="{{ asset('storage/' . getSetting('question_image')) }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="text-ask-aboutus">
                            <h2>{{ transWord('اسئلة مكررة') }}</h2>
                            <p> {{ transWord('إجابات سريعة على الأسئلة التي قد تكون لديك ') }}</p>
                            <ul>
                                @forelse ($questions as $question)
                                <li>
                                    <h2><img src="{{ asset('site/images/e.png') }}" alt="">
                                    {{ $question->question }}
                                        <div class="puls-que"></div>
                                    </h2>
                                    <p>
                                        {{ $question->answer }}
                                    </p>

                                </li>
                                @empty
                                <li>
                                    <h2><img src="{{ asset('site/images/e.png') }}" alt="">
                                    {{ transWord('لا يوجد اسئلة حاليا') }}
                                        <div class="puls-que"></div>
                                    </h2>
                                    <p>
                                        {{ transWord('لا يوجد اسئلة حاليا') }}
                                    </p>
                                </li>

                                @endforelse


                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </main>


@endsection
