@extends('site.layouts.app')
@section('title', transWord('الملف الشخصي'))

@title(getSetting('seo_title', app()->getLocale()))
@description(Str::limit(getSetting('desc_seo', app()->getLocale()), 160))
@keywords(implode(',', json_decode(getSetting('keyword', app()->getLocale()))))
@image(asset('storage/' . getSetting('logo')))
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css">
@endpush
@section('sub-header')
    <div class="title-page">
        <div class="main-container">
            <h2>{{ transWord('تفاصيل الطلب') }}</h2>
            <div class="breadcrumb-header">
                <a href="{{ route('site.home') }}"> {{ transWord('الرئيسية') }} </a> <img
                    src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
                <span>{{ transWord('تفاصيل الطلب') }}</span>

            </div>
        </div>
    </div>
@endsection
@section('content')
    <main id="app">

        <section class="my-account mr-section">
            <div class="main-container">
                <div class="row">
                    <div class="col-lg-4">
                        @include('site.components.user_profile')
                    </div>
                    <div class="col-lg-8">
                        <div class="main-form-my-account">
                            <div class="title-form-acount">
                                <h2>{{ transWord('تفاصيل الطلب') }}</h2>
                            </div>
                            <div class="title-order-details">
                                <div class="sub-title-order-details">
                                    <h2> {{ transWord('رقم الطلب') }} {{ $order->order_number }}</h2>
                                    <p>{{ transWord('تاريخ الطلب') }} {{ $order->date }} </p>
                                </div>
                                <h3> {{ $order->price_befor_discount }} </h3>
                            </div>

                            <div class="main-scoll">

                                <div class="order-tracking">
                                    <div class="sub-order-tracking {{ $order->processing_at != null ? 'active' : '' }}">
                                        <span></span>

                                        <div class="status-order">
                                            <img src="{{ asset('site/images/1.png') }}" alt="">
                                            <h2>{{ transWord('تم تحضير الطلب') }}</h2>
                                        </div>
                                    </div>
                                    <div class="sub-order-tracking {{ $order->shipped_at != null ? 'active' : '' }}">
                                        <span></span>

                                        <div class="status-order">
                                            <img src="{{ asset('site/images/2.png') }}" alt="">
                                            <h2>{{ transWord('تم شحن الطلب') }}</h2>
                                        </div>
                                    </div>
                                    <div class="sub-order-tracking {{ $order->driving_at != null ? 'active' : '' }}">
                                        <span></span>

                                        <div class="status-order">
                                            <img src="{{ asset('site/images/3.png') }}" alt="">
                                            <h2>{{ transWord('في الطريق إليك') }}</h2>
                                        </div>
                                    </div>
                                    <div class="sub-order-tracking {{ $order->completed_at != null ? 'active' : '' }}">
                                        <span></span>

                                        <div class="status-order ">
                                            <img src="{{ asset('site/images/4.png') }}" alt="">
                                            <h2>{{ transWord('تم التسليم') }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="main-status-tracking">
                                <h2> {{ transWord('نشاط الطلب ') }}</h2>



                                @if ($order->completed_at)
                                    <div class="sub-status-tracking">
                                        <div class="img-status-tracking">
                                            <img src="{{ asset('site/images/tac2.png') }}" alt="">
                                        </div>
                                        <div class="text-status-tracking">
                                            <h3> {{ transWord('تم تسليم الطلب  , شكرا لتسوقك في Rioplast') }} </h3>
                                            <p> {{ $order->completed_at }} </p>
                                        </div>
                                    </div>
                                @endif

                                @if ($order->driving_at)
                                    <div class="sub-status-tracking">
                                        <div class="img-status-tracking">
                                            <img src="{{ asset('site/images/tac2.png') }}" alt="">
                                        </div>
                                        <div class="text-status-tracking">
                                            <h3> {{ transWord('رجل التوصيل في طريقه اليك') }} </h3>
                                            <p> {{ $order->driving_at }}</p>
                                        </div>
                                    </div>
                                @endif
                                @if ($order->shipped_at)
                                    <div class="sub-status-tracking">
                                        <div class="img-status-tracking">
                                            <img src="{{ asset('site/images/tac2.png') }}" alt="">
                                        </div>
                                        <div class="text-status-tracking">
                                            <h3>{{ transWord('لقد قام رجل التوصيل لدينا باستلام طلبك') }}</h3>
                                            <p> {{ $order->shipped_at }}</p>
                                        </div>
                                    </div>
                                @endif
                                @if ($order->processing_at)
                                    <div class="sub-status-tracking">
                                        <div class="img-status-tracking">
                                            <img src="{{ asset('site/images/tac2.png') }}" alt="">
                                        </div>
                                        <div class="text-status-tracking">
                                            <h3>{{ transWord('تم تحضير الطلب') }}</h3>
                                            <p> {{ $order->processing_at }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($order->created_at)
                                    <div class="sub-status-tracking">
                                        <div class="img-status-tracking">
                                            <img src="{{ asset('site/images/tac2.png') }}" alt="">
                                        </div>
                                        <div class="text-status-tracking">
                                            <h3>{{ transwORD('تم استلام طلبك') }}</h3>
                                            <p> {{ $order->date }}</p>
                                        </div>
                                    </div>
                                @endif





                                <div class="table-cart-page">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">{{ transWord('المنتج') }}</th>
                                                <th scope="col">{{ transWord('السعر') }}</th>
                                                <th scope="col">{{ transWord('الكمية') }}</th>
                                                <th scope="col">{{ transWord('المجموع') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderItems as $item)
                                                <tr>
                                                    <th>
                                                        <div class="main-product-cart">
                                                            <div class="sub-product-cart">
                                                                <div class="img-product-cart">
                                                                    <img src="{{ $item->products->image_path }}"
                                                                        alt="">
                                                                </div>
                                                                <h3> {{ $item->product_name }}</h3>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td>EGP {{ $item->price }}</td>
                                                    <td>
                                                       {{ $item->quantity }}
                                                    </td>
                                                    <td>EGP {{ $order->price_befor_discount }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>











    </main>

@endsection
