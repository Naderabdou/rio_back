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
            <a href="{{  route('site.profile') }}"> {{ transWord('البروفايل') }} </a> <img
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
                                    <a href="" class="order-filter active" id="pending"> {{ transWord('حالية') }}
                                    </a>
                                    <a href="" class="order-filter " id="completed">{{ transWord('منتهية') }} </a>
                                </div>
                            </div>
                            <div id='order_data' class="grid_order">
                                <div class="list">


                                    @forelse ($orders as $order)
                                        <div class="orders-myacount">
                                            <div class="title-orders-myacount">
                                                <h2 class="order_name">{{ transWord('رقم الطلب') }}
                                                    {{ $order->order_number }}</h2>
                                                <a href="{{ route('site.orders.show', $order->id) }}" class="ctm-btn2">
                                                    {{ transWord('تفاصيل الطلب') }}</a>
                                            </div>
                                            <ul>
                                                @foreach ($order->orderItems as $item)
                                                    <li class="actor">
                                                        <div class="img-order-myacount">
                                                            <img src="{{ $item->products->image_path ?? '' }}"
                                                                alt="">
                                                        </div>
                                                        <div class="text-order-myacount">
                                                            <h2>{{ $item->product_name }}</h2>
                                                            <h3>EGP {{ $item->price }} </h3>
                                                            <p>
                                                                {{ transWord('تم استلام طلبك في ') }}
                                                                {{ $order->address }} ,
                                                                {{ $order->date }}

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
                                @if ($orders->count() > 0)

                                <ul class="pagination custom-pagination"></ul>
                                @endif
                            </div>



                        </div>
                    </div>
                </div>
        </section>











    </main>

@endsection
@push('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
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

                        if ($('.not_order').length > 0) {

                            $('.pagination').hide(); // Optionally, hide pagination as well
                        } else {
                            initializeListJS();
                            // $('.list').show(); // Show the list
                            // $('.pagination').show(); // Show pagination
                        }
                    }
                });
            });

            function initializeListJS() {
                var options = {
                    valueNames: ['order_name'],
                    page: 3,
                    pagination: true
                };
                var addressList = new List('order_data', options);
            }

            // Initialize List.js on page load
            initializeListJS();
        });
    </script>
@endpush
