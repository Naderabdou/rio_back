@extends('site.layouts.app')
@section('title', transWord('السله'))

@title(getSetting('seo_title', app()->getLocale()))
@description(Str::limit(getSetting('desc_seo', app()->getLocale()), 160))
@keywords(implode(',', json_decode(getSetting('keyword', app()->getLocale()))))
@image(asset('storage/' . getSetting('logo')))
@section('sub-header')
    <div class="title-page">
        <div class="main-container">
            <h2>{{ transWord('السله') }}</h2>
            <div class="breadcrumb-header">
                <a href="{{ route('site.home') }}"> {{ transWord('الرئيسية') }} </a> <img
                    src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
                <span>{{ transWord('السله') }}</span>

            </div>
        </div>
    </div>
@endsection
@section('content')
@endsection
