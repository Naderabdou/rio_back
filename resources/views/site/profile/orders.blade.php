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
            <h2>{{ transWord('طلباتي') }}</h2>
            <div class="breadcrumb-header">
                <a href="{{ route('site.home') }}"> {{ transWord('الرئيسية') }} </a> <img
                    src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
                <span>{{ transWord('طلباتي') }}</span>

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
                                <h2>{{ transWord('طلباتي') }}</h2>

                                <div class="fliter-orders">
                                    <a href="" class="order-filter active" id="pending"> {{ transWord('حالية') }} </a>
                                    <a href="" class="order-filter " id="completed">{{ transWord('منتهية') }} </a>
                                </div>
                            </div>
                            <div id='order_data'>

                                @forelse ($orders as $order)
                                    <div class="orders-myacount">
                                        <div class="title-orders-myacount">
                                            <h2>{{ transWord('رقم الطلب') }} {{ $order->order_number }}</h2>
                                            <a href="{{ route('site.orders.show', $order->id) }}" class="ctm-btn2">
                                                {{ transWord('تفاصيل الطلب') }}</a>
                                        </div>
                                        <ul>
                                            @foreach ($order->orderItems as $item)
                                                <li>
                                                    <div class="img-order-myacount">
                                                        <img src="{{ $item->products->image_path }}" alt="">
                                                    </div>
                                                    <div class="text-order-myacount">
                                                        <h2>{{ $item->product_name }}</h2>
                                                        <h3>EGP {{ $item->price }} </h3>
                                                        <p>
                                                            {{ transWord('تم التوصيل في ') }}
                                                            {{ transWord($order->address) }} , {{ $order->driving_at }}
                                                        </p>
                                                    </div>
                                                </li>
                                            @endforeach



                                        </ul>
                                    </div>
                                @empty
                                <div class="orders-myacount">
                                    <div class="title-orders-myacount">
                                        <h2>{{ transWord('لا يوجد طلبات') }}</h2>
                                    </div>
                                </div>
                                @endforelse
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </section>











    </main>

@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('.order-filter').click(function(e) {
            e.preventDefault();
            var filter = $(this).attr('id');
            $('.order-filter').removeClass('active');
            $("#" + filter).addClass('active');
            $.ajax({
                url: "{{ route('site.orders.filter') }}",
                type: 'GET',
                data: {
                    filter: filter
                },
                success: function(data) {
                    $('#order_data').html(data);

                }
            });
        });
    });
    </script>

@endpush
