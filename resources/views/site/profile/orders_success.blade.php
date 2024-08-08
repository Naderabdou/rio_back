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
            <h2>{{ transWord('اتمام الطلب') }}</h2>
            <div class="breadcrumb-header">
                <a href="{{ route('site.home') }}"> {{ transWord('الرئيسية') }} </a>
                <img src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
                <a href="{{ route('site.home') }}"> {{ transWord('عربة التسوق') }} </a>
                <img src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
                <span>{{ transWord('اتمام الطلب') }}</span>

            </div>
        </div>
    </div>
@endsection
@section('content')
    <main id="app">

        <section class="comfirm-order mr-section">
            <div class="main-container">
                <div class="sub-comfirm-order">
                    <div class="img-comfirm-order">
                        <img src="{{ asset('site/images/CheckCircle.png') }}" alt="">
                    </div>
                    <h2>{{ transWord('شكرا لك ! 🎉 ') }}</h2>
                    <p>{{ transWord('تم استلام طلبك بنجاح ') }}</p>
                    <div class="product-comfirm-order">
                        @foreach ($order->orderItems as $item)
                            <div class="sub-product-comfirm-order">
                                <img src="{{ $item->products->image_path }}" alt="">
                                <span class="count-order">{{ $item->quantity }}</span>
                            </div>
                        @endforeach
                    </div>
                    <ul>
                        <li>{{ transWord('رقم الطلب ') }}<span>{{ $order->order_number }}</span></li>
                        <li>{{ transWord('التاريخ') }} <span>{{ $order->created_at->locale('ar')->isoFormat('DD MMMM YYYY | HH:mm a') }}</span></li>
                        @if ($order->coupon_code)
                            <li>{{ transWord('الخصم المكتسب') }} <span>{{ $order->coupon_value }} {{ transWord('جنية') }}</span></li>
                        @endif
                        <li>{{ transWord('رسوم الشحن') }} <span>{{ $order->tax }} {{ transWord('جنية') }}</span></li>
                        <li>{{ transWord('سعر المنتج') }} <span>{{ $order->price_before_discount }} {{ transWord('جنية') }}</span></li>
                        <li>{{ transWord('الاجمالي') }} <span>{{ $order->getTotalPrice() }} {{ transWord('جنية') }}</span></li>
                        <li>{{ transWord('طريقة الدفع ') }}<span>{{ $order->payment_method }}</span></li>
                    </ul>
                    <a href="{{ route('site.home') }}" class="ctm-btn w-50 mt-4"> {{ transWord('العودة للرئيسية ') }}</a>
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

    {{-- <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>

    <script>
        let elem = document.querySelector('.grid_order');
        let infScroll = new InfiniteScroll(elem, {
            // options
            path: 'profile/orders/@{{ # }}',
            append: '.orders-myacount',
            status: '.page-load-status'
            // history: false,
        });
    </script> --}}
@endpush
