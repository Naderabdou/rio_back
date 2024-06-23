@extends('site.layouts.app')
@section('title', transWord('اتمام الطلب'))

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
                <a href="{{ route('site.home') }}"> {{ transWord('الرئيسية') }} </a> <img
                    src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
                <a href="{{ route('site.cart') }}"> {{ transWord('عربة التسوق ') }}</a> <img
                    src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
                <span>{{ transWord('اتمام الطلب') }}</span>

            </div>
        </div>
    </div>
@endsection

@section('content')
    @if ($cart)
        <main id="app">


            <section class="puyment-page mr-section">
                <form action="{{ route('site.checkout.store') }}" method="POST" id="form_checkout">
                    @csrf
                    <div class="main-container">
                        <div class="row row-gap">




                            <div class="col-lg-7">



                                <div class="select-puyment">
                                    <h2>{{ transWord('عنوان الشحن') }}
                                        <a href="" data-toggle="modal" data-target=".address-modal" class="ctm-btn2">
                                            {{ transWord('اضف عنوان جديد') }}</a>
                                    </h2>
                                    <div class="title-select-puyment">
                                        <div class="input-form arrow-select">
                                            <select class="form-select form-control address_id" name="address_id">
                                                <option selected disabled value=""> {{ transWord('اختر عنوان') }}
                                                </option>

                                                @foreach (auth()->user()->address as $address)
                                                    <option value="{{ $address->id }}">
                                                        {{ $address->street }} - {{ $address->governorate->name }} -
                                                        {{ $address->city->name }}

                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="forms-puyment-page">
                                    {{-- <div class="address-puyment">
                                <h2>{{ transWord('عنوان الشحن') }}</h2>
                                <div class="main-form">
                                    <div class="input-form">
                                        <input type="text" placeholder="{{ transWord('الاسم') }}" class="form-control"
                                            name="name">
                                    </div>
                                    <div class="input-form">
                                        <input type="text" placeholder="{{ transWord('المحافظة') }}"
                                            class="form-control" name="governorate">
                                    </div>
                                    <div class="input-form">
                                        <input type="text" placeholder="{{ transWord('المدينة') }}" class="form-control"
                                            name="city">
                                    </div>
                                    <div class="input-form">
                                        <input type="text" placeholder="{{ transWord('عنوان الشارع') }}"
                                            class="form-control" name="address">
                                    </div>
                                </div>
                            </div> --}}
                                    <div class="information-address">
                                        <h2>{{ transWord('بيانات التواصل') }}</h2>
                                        <div class="main-form">
                                            <div class="input-form">
                                                <input type="text" placeholder="{{ transWord('الاسم') }}"
                                                    class="form-control" name="name" value="{{ auth()->user()->name }}"
                                                    readonly>
                                            </div>
                                            <div class="input-form">
                                                <input type="email" placeholder="{{ transWord('البريد الالكتروني') }}"
                                                    class="form-control" name="email" value="{{ auth()->user()->email }}"
                                                    readonly>
                                            </div>
                                            <div class="input-form">
                                                <input type="tel" placeholder="{{ transWord('رقم الهاتف') }}"
                                                    class="form-control" name="phone" value="{{ auth()->user()->phone }}"
                                                    readonly>
                                            </div>
                                            <div class="input-form">
                                                <input type="tel" placeholder="{{ transWord('رقم اضافي') }}"
                                                    class="form-control" name="additional_phone">
                                            </div>

                                        </div>
                                    </div>


                                    <div class="chosse-puyment">
                                        <h2>{{ transWord('طرق الدفع') }}</h2>
                                        @foreach ($payments as $payment)
                                            <div class="input-puyment">
                                                <input type="radio" name="puy" id="puy-1" value="{{ $payment->name_en }}">
                                                <label for="puy-1">
                                                    <img src="{{ $payment->image_path }}" alt="">
                                                    <div class="text-chosse-puyment">
                                                        <h3>{{ $payment->name }}</h3>
                                                    </div>
                                                </label>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="info-cart-page">
                                    <h2>{{ transWord('ملخص الطلب') }}</h2>
                                    <div class="product-payment">
                                        @foreach ($cart->orderItems as $itmes)
                                            <div class="sub-product-payment">
                                                <div class="img-product-payment">
                                                    <img src="{{ $itmes->products->image_path }}" alt="">
                                                </div>
                                                <div class="text-product-payment">
                                                    <h3>{{ $itmes->product_name }}</h3>
                                                    <p>{{ transWord('الكمية') }} {{ $itmes->quantity }} <span> EGP
                                                            {{ $itmes->price }} </span></p>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>

                                    <ul>
                                        <li> {{ transWord('المجموع الفرعي') }} ( {{ $cart->orderItems->count() }}
                                            {{ transWord('منتجات') }}) <span> EGP {{ $cart->price_before_discount }}
                                            </span>
                                        </li>
                                        <li> {{ transWord('رسوم الشحن') }}<span id="tax">EGP 20 </span></li>
                                        @if ($cart->coupon_code)
                                            <li> {{ transWord('الخصم المكتسب') }}<span
                                                    class="coupon">{{ $cart->coupon_value }}
                                                    EGP
                                                </span></li>
                                        @endif
                                    </ul>
                                    <div class="total-cart">
                                        <h3> {{ transWord('الاجمالي') }} <span>EGP <span
                                                    class="totel_tax">{{ $cart->coupon_code ? $cart->price_before_discount + 20 - $cart->coupon_value : $cart->price_before_discount + 20 }}</span>
                                            </span></h3>
                                    </div>

                                    <button type="submit" class="ctm-btn w-100">{{ transWord('اتمام طلبك') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

            </section>



        </main>

        <div class="modal fade address-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="main-add-address m-auto">
                        <div class="img-add-address">
                            <img src="{{ asset('site/images/address.png') }}" alt="">
                        </div>
                        <div class="title-center mb-5">
                            <h2>{{ transWord('إضافة عنوان جديد') }}</h2>
                        </div>
                        <form action="{{ route('site.address.store') }}" method="POST" class="address_store">
                            @csrf
                            <div class="input-form arrow-select">
                                <select class="form-select form-control governorate_id" name="governorate_id">
                                    <option value=""> {{ transWord('اختر المحافظه') }} </option>
                                    @foreach ($governorates as $governorate)
                                        <option value="{{ $governorate->id }}"> {{ $governorate->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-form arrow-select">
                                <select class="form-select form-control city_id" name="city_id">
                                    <option value=""> {{ transWord('اختر المدينه') }} </option>

                                </select>
                            </div>
                            <div class="input-form">
                                <input type="text" name="street" placeholder="{{ transWord('العنوان') }}"
                                    class="form-control">
                            </div>

                            <div class="btn-add-address mt-4">
                                <button class="ctm-btn w-100"> {{ transWord('حفظ') }} </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
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
            $('.governorate_id').change(function() {
                var governorate_id = $(this).val();
                if (governorate_id) {
                    $.ajax({
                        url: "{{ route('site.cities') }}",
                        type: "POST",
                        data: {
                            governorate_id: governorate_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            $('.city_id').empty();
                            $('.city_id').append(
                                '<option value="">{{ transWord('اختر المدينة') }}</option>'
                            );
                            $.each(data, function(key, value) {
                                @if (app()->getLocale() == 'ar')
                                    $('.city_id').append('<option value="' + key +
                                        '">' + value.name_ar + '</option>');
                                @else
                                    $('.city_id').append('<option value="' + key +
                                        '">' + value.name_en + '</option>');
                                @endif

                            });
                        }
                    });
                }
            });

            // $(document).on('submit', '#form_checkout', function(e) {
            //     e.preventDefault();
            //     $('#ctm-btn').prop('disabled', true);
            //     // Hide the button
            //     $('#ctm-btn').hide();

            //     // Add a spinner
            //     $('#ctm-btn').parent().append(
            //         `<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        //             <span class="sr-only">Loading...</span>
        //             </div>
        //                         `
            //     );

            //     var formData = new FormData($('#form_checkout')[0])



            // })

            $("#form_checkout").validate({


                rules: {
                    // Define validation rules for your form fields here


                    email: {
                        required: true,
                        minlength: 3,
                        domain: true
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 15,
                        phone_type: true,
                    },

                    additional_phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 15,
                        phone_type: true,
                    },
                    address_id: {
                        required: true,
                    },
                    puy: {
                        required: true,
                    },




                    // Add more fields as needed
                },

                messages: {

                    phone: {
                        minlength: window.phoneMinLengthMessage,
                        maxlength: window.phoneMaxLengthMessage,
                    }



                },



                errorElement: "span",
                errorLabelContainer: ".errorTxt",

                submitHandler: function(form) {
                    form.submit();
                },
                // submitHandler: function(form) {
                //     $('.ctm-btn').prop('disabled', true);
                //     // Hide the button
                //     $('.ctm-btn').hide();

                //     // Add a spinner
                //     $('.ctm-btn').parent().append(
                //         `<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            //         <span class="sr-only">Loading...</span>
            //         </div>
            //             `
                //     );


                //     var formData = new FormData(form);
                //     let url = form.action;
                //     $.ajax({
                //         url: url,
                //         method: 'POST',
                //         data: formData,
                //         processData: false,
                //         contentType: false,
                //         success: function(data) {

                //             form.reset();
                //             Swal.fire({
                //                 icon: 'success',
                //                 title: `<h5> ${data.success}</h5> `,
                //                 showConfirmButton: false,
                //                 timer: 2000
                //             });
                //             $('.ctm-btn').prop('disabled', false);


                //             // Show the button
                //             $('.ctm-btn').show();

                //             // Remove the spinner
                //             $('.ctm-btn').next('.spinner-border').remove();

                //         },
                //         error: function(data) {
                //             $('.ctm-btn').prop('disabled', false);

                //             // Show the button
                //             $('.ctm-btn').show();

                //             // Remove the spinner
                //             $('.ctm-btn').next('.spinner-border').remove();
                //             $('.error-message').text('');
                //             var errors = data.responseJSON.errors;
                //             $.each(errors, function(field, messages) {
                //                 var errorMessage = messages.join(', ');
                //                 $('#' + field + '_error').text(
                //                     errorMessage);
                //             });
                //         },
                //     });

                // },
            });
        });
    </script>
@endpush
