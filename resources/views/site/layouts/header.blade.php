<!DOCTYPE html>

<html>

<head>
    <title> {{ getSetting('name_website',app()->getLocale()) }} | @yield('title') </title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content=" website" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="shortcut icon" href="images/logo.ico">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/' . getSetting('favicon')) }}">

    <meta name="msapplication-TileColor" content="">
    <meta name="msapplication-TileImage" content="">

    @seo

    @include('site.layouts.style')



</head>
<body>



    <div class="body_page  d-flex flex-column justify-content-between">
