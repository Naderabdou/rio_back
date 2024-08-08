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
    @if ($cart)
        <main id="app">


            <section class="cart-page mr-section">
                <div class="main-container">
                    <div class="row row-gap">
                        <div class="col-lg-8">
                            <div class="product-cart-page">
                                <h2>{{ transWord('عربة التسوق') }}</h2>

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
                                            @foreach ($cart->orderItems as $itmes)
                                                <tr>
                                                    <th>

                                                        <div class="main-product-cart">
                                                            <div class="delete-cart">
                                                                <a
                                                                    href="{{ route('site.cart.index.destroy', $itmes->id) }}">
                                                                    <i class="bi bi-trash"></i></a>
                                                            </div>
                                                            <div class="sub-product-cart">
                                                                <div class="img-product-cart">
                                                                    <img src="{{ $itmes?->products?->image_path }}"
                                                                        alt="">
                                                                </div>
                                                                <h3> {{ $itmes->product_name }}</h3>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td> {{ $itmes->price }} {{ transWord('جنية') }}</td>
                                                    <td>
                                                        <div class="counter">
                                                            <span class="plus" id="{{ $itmes->id }}"> <i
                                                                    class="bi bi-plus"></i> </span>
                                                            <input type="number" id="quan-{{ $itmes->id }}"
                                                                class="required-quantity" value="{{ $itmes->quantity }}"
                                                                min="1" readonly />
                                                            <span class="minus" id="{{ $itmes->id }}"> <i
                                                                    class="bi bi-dash"></i> </span>
                                                        </div>
                                                    </td>
                                                    <td id="total-{{ $itmes->id }}">
                                                        {{ $itmes->price * $itmes->quantity }} {{ transWord('جنية') }}
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="info-cart-page">
                                <h2>{{ transWord('ملخص الطلب ') }}</h2>
                                @if (!auth()->user()->hasRole('merchant'))
                                <div class="copon-code">
                                    <form action="{{ route('site.cart.coupon') }}" id="form_coupon">
                                        <input type="text" class="form-control" name="code"
                                            placeholder="{{ transWord('ادخل كود الخصم') }}" id="">
                                        <button class="ctm-btn"> {{ transWord('تطبيق') }} </button>
                                    </form>
                                </div>
                                @endif

                                <ul class="ul_cart">
                                    <li> {{ transWord('المجموع الفرعي') }} ( {{ $cart->orderItems->count() }}
                                        {{ transWord('منتجات') }})
                                        <span> <span class="total_val">{{ $cart->price_before_discount }}
                                                {{ transWord('جنية') }} </span> </span>
                                    </li>
                                    {{-- <li>
                                        {{ transWord('مجموع السعر بعد الخصم') }}<span
                                            class="total_after_discount">{{ $cart->price_before_discount }} جنيه </span>
                                    </li> --}}
                                    {{-- <li> {{ transWord('رسوم الشحن') }}<span id="tax"> 20 جنية</span></li> --}}
                                    @if ($cart->coupon_code)
                                        <li> {{ transWord('الخصم المكتسب') }}<span
                                                class="coupon">{{ $cart->coupon_value }} {{ transWord('جنية') }}
                                            </span></li>
                                    @endif
                                </ul>
                                <div class="total-cart">
                                    <h3> {{ transWord('الاجمالي') }} <span> <span
                                                class="totel_tax">{{ $cart->coupon_code ? $cart->price_before_discount - $cart->coupon_value : $cart->price_before_discount }}
                                                {{ transWord('جنية') }} </span>
                                        </span></h3>
                                </div>

                                <a href="{{ route('site.checkout') }}" class="ctm-btn w-100">
                                    {{ transWord('اتمام عملية الشراء') }} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>






        </main>
    @else
        <main id="app">



            <section class="cart-notfound mr-section">
                <div class="img-cart-notfound">
                    <img src="{{ asset('site/images/cart.png') }}" alt="">
                </div>
                <h2> {{ transWord('لا توجد مشتريات فى عربة التسوق ') }}</h2>
                <a href="{{ route('site.products') }}" class="ctm-btn w-50 mt-4"> {{ transWord('تسوق الان ') }}</a>
            </section>




        </main>
    @endif
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var requestInProgress = false; // Flag to track if a request is in progress

            $('.plus').click(function() {
                if (requestInProgress) {
                    // If a request is already in progress, don't proceed with a new one
                    console.log('Please wait for the current update to finish.');
                    return;
                }
                requestInProgress = true; // Set the flag to true as we start a new request
                var quantity = $(this).parent().find('.required-quantity').val();
                quantity++;
                var id = $(this).attr('id');



                $.ajax({
                    url: "{{ route('site.cart.update') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        quantity: quantity


                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: `<h5> ${data.message}</h5> `,
                            showConfirmButton: false,
                            timer: 1500
                        });


                        $('#quanti_cart-' + data.id).text(data.quantity);
                        $('#quan-' + data.id).val(data.quantity);

                        $('#total-' + data.id).text(data.total_price + 'جنية');
                        $('.total_val').text(data.total_cart_price + ' جنية');
                        $('.total_after_discount').text(data.total_cart_discount + ' جنية');
                        $('.totel_tax').text(data.total_cart_price + ' جنية');


                        var total_fin = parseFloat($('.totel_tax').text());
                       // $('.price-cart-header').text(data.total_cart_discount + ' جنية');
                        $('.totel_cart').text(data.total_cart_discount + ' جنية');
                        let coupon = parseFloat($('.coupon').text());
                        if (coupon) {
                            $('.totel_tax').text((total_fin - coupon).toFixed(1) + ' جنية');
                            return;
                        }


                        // $('.totel_tax').text((total_fin).toFixed(1));



                    },
                    complete: function() {
                        // Once the request is complete, reset the flag after a delay
                        setTimeout(function() {
                            requestInProgress = false;
                        }, 1000); // Adjust the delay as needed
                    },
                    error: function() {
                        // In case of error, also reset the flag but immediately
                        requestInProgress = false;
                    }

                });


            });
            $('.minus').click(function() {
                if (requestInProgress) {
                    // If a request is already in progress, don't proceed with a new one
                    console.log('Please wait for the current update to finish.');
                    return;
                }
                requestInProgress = true;
                var quantity = $(this).parent().find('.required-quantity').val();
                quantity--;
                var id = $(this).attr('id');


                $.ajax({
                    url: "{{ route('site.cart.update') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        quantity: quantity


                    },
                    success: function(data) {

                        Swal.fire({
                            icon: 'success',
                            title: `<h5> ${data.message}</h5> `,
                            showConfirmButton: false,
                            timer: 1500
                        });


                        $('.quanti_cart').text(data.quantity);
                        $('#quan-' + data.id).val(data.quantity);

                        $('#total-' + data.id).text(data.total_price + 'جنية');
                        $('.total_val').text(data.total_cart_price + ' جنية');
                        $('.total_after_discount').text(data.total_cart_discount + ' جنية');
                        $('.totel_tax').text(data.total_cart_price + ' جنية');


                        var total_fin = parseFloat($('.totel_tax').text());

                        let coupon = parseFloat($('.coupon').text());
                        if (coupon) {
                            $('.totel_tax').text((total_fin - coupon).toFixed(1) + ' جنية');
                            return;
                        }
                    },
                    complete: function() {
                        // Once the request is complete, reset the flag after a delay
                        setTimeout(function() {
                            requestInProgress = false;
                        }, 1000); // Adjust the delay as needed
                    },
                    error: function() {
                        // In case of error, also reset the flag but immediately
                        requestInProgress = false;
                    }

                });
            });

            $('#form_coupon').submit(function(e) {
                e.preventDefault();
                var code = $(this).find('input[name="code"]').val();
                $.ajax({
                    url: "{{ route('site.cart.coupon') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        code: code
                    },
                    success: function(data) {
                        if (data.type == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: `<h5> ${data.message}</h5> `,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            // var subTotal = parseFloat($('.total_val').text());
                            // var tax = parseFloat($('#tax').text().replace(/[^0-9.]/g,
                            //     "")); // replace with the actual tax
                            // var coupon = data.coupon;
                            // var total = subTotal + tax - coupon;

                            var total = parseFloat($('.totel_tax').text());
                            var coupon = parseFloat(data.coupon);
                            total = total - coupon;
                            @if (app()->getLocale() == 'ar')
                                $('.totel_tax').text(total.toFixed(1) + ' جنية');
                            @else
                                $('.totel_tax').text(total.toFixed(1) + 'EG');

                            @endif
                            // $('.totel_tax').text(total.toFixed(1) + ' جنية');

                            // $('.totel_tax').text(total.toFixed(1));
                            const text = @json(transWord('الخصم المكتسب'));
                            const currn = @json(transWord('جنية'));
                            $('.ul_cart').append(`<li>${text}<span class="coupon">${coupon} ${currn}</span></li>`);

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: `<h5> ${data.message}</h5> `,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
