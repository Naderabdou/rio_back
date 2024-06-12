@extends('site.layouts.app')
@section('title', transWord('عن الشركة'))

@title(getSetting('seo_title', app()->getLocale()))
@description(Str::limit(getSetting('desc_seo', app()->getLocale()), 160))
@keywords(implode(',', json_decode(getSetting('keyword', app()->getLocale()))))
@image(asset('storage/' . getSetting('logo')))
@section('sub-header')
    <div class="title-page">
        <div class="main-container">
            <h2>{{ transWord('تواصل معنا') }}</h2>
            <div class="breadcrumb-header">
                <a href="{{ route('site.home') }}"> {{ transWord('الرئيسية') }} </a> <img
                    src="{{ asset('site/images/icon/arrow.svg') }}" alt=""> <span>
                    {{ transWord('تواصل معنا') }}
                </span>
            </div>
        </div>
    </div>
@endsection


@section('content')
    <main id="app">
        <section class="contactus mr-section">
            <div class="main-container">
                <div class="row row-gap">
                    <div class="col-lg-6">
                        <div class="form-contactus">
                            <div class="title-start">
                                <h2>{{ transWord('تواصل معنا') }}</h2>
                            </div>
                            <form action="{{ route('site.contactUs.store') }}" id="contact_form">
                                <div class="row">
                                    @csrf

                                    <div class="col-lg-6">
                                        <div class="input-form">
                                            <input type="text" name="name"
                                                placeholder="{{ transWord('الاسم') }}" class="form-control">
                                        </div>
                                        @error('name')
                                            <span class="alert alert-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-form">
                                            <input type="email" name="email"
                                                placeholder="{{ transWord('البريد الاكتروني') }}" class="form-control">
                                        </div>
                                        @error('email')
                                            <span class="alert alert-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-form">
                                            <input type="tel" name="phone" id="phone"
                                                placeholder="{{ transWord('رقم الجوال') }}" class="form-control">
                                            @error('phone')
                                                <span class="alert alert-danger">
                                                    <small class="errorTxt">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="input-form">
                                            <input type="text" name="subject" placeholder="{{ transWord('الموضوع') }}"
                                                class="form-control">
                                        </div>
                                        @error('subject')
                                            <span class="alert alert-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-form">
                                            <textarea name="message" class="form-control" placeholder="{{ transWord('نص الرسالة') }}"></textarea>
                                        </div>
                                        @error('message')
                                            <span class="alert alert-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12">
                                        <button class="ctm-btn"> {{ transWord('ارسال') }} </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="info-contectus">
                            <h2>{{ transWord('معلومات التواصل ') }}</h2>
                            <p>
                                {{ getSetting('contact_desc', app()->getLocale()) }}
                            </p>
                            <ul>
                                <li>
                                    <div class="img-info-contectus">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                    <a target="__blank"
                                        href="https://www.google.com/maps?q={{ getSetting('lat') }},{{ getSetting('lng') }}">

                                        <h2>{{ transWord(getSetting('address')) }}</h2>
                                    </a>
                                </li>
                                <li>
                                    <div class="img-info-contectus">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <a target="__blank" href="mailto::{{ getSetting('email') }}">

                                        <h2> {{ getSetting('email') }}</h2>
                                    </a>

                                </li>
                                <li>
                                    <div class="img-info-contectus">
                                        <i class="bi bi-telephone"></i>
                                    </div>

                                    <a target="__blank" href="tel:{{ getSetting('phone') }}">
                                        <h2>{{ getSetting('phone') }}</h2>
                                    </a> -
                                    <a href="https://wa.me/{{ getSetting('whatsapp') }}">
                                        <h2>{{ getSetting('whatsapp') }}</h2>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>








    </main>


@endsection
