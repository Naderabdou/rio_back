@extends('site.layouts.app')
@section('title', transWord('منتجاتنا'))

@title(getSetting('seo_title', app()->getLocale()))
@description(Str::limit(getSetting('desc_seo', app()->getLocale()), 160))
@keywords(implode(',', json_decode(getSetting('keyword', app()->getLocale()))))
@image(asset('storage/' . getSetting('logo')))
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
@endpush
@section('sub-header')
    <div class="title-page">
        <div class="main-container">
            <h2>{{ transWord('منتجاتنا') }}</h2>
            <div class="breadcrumb-header">
                <a href="{{ route('site.home') }}"> {{ transWord('الرئيسية') }} </a> <img
                    src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
                <a href="{{ route('site.products') }}"> {{ transWord('منتجاتنا') }} </a> <img
                    src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
                <span>{{ transWord('تفاصيل المنتج') }}</span>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <main id="app">


        <section class="product-details mr-section">
            <div class="main-container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="main-container1">
                            <div class="nav-container">
                                <div class="slider-nav">
                                    <div class="img-slider1">
                                        <img src="{{ $product->image_path }}" alt="">
                                    </div>
                                    @foreach ($product->images as $image)
                                        <div class="img-slider1">
                                            <img src="{{ $image->image_path }}" alt="">
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                            <div class="slider slider-main">
                                <div class="img-slider">
                                    <img src="{{ $product->image_path }}" alt="">
                                </div>
                                @foreach ($product->images as $image)
                                    <div class="img-slider">
                                        <img src="{{ $image->image_path }}" alt="">
                                    </div>
                                @endforeach


                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="text-product-details">
                            <div class="title-text-product-details">
                                <div class="sub-text-product-details">
                                    <h2> {{ $product->name }}</h2>
                                    <div class="rate">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= round($product->reviews->avg('rating')))
                                                <span class="fa fa-star checked"></span>
                                            @else
                                                <span class="fa fa-star"></span>
                                            @endif
                                        @endfor
                                        <i>({{ round($product->reviews->avg('rating')) ?? 0 }})</i>
                                    </div>
                                </div>
                                <div class="btns-share">

                                    <a href="javascript:void(0);" onclick="toggleShareLinks();"> <i
                                            class="bi bi-share"></i></a>


                                    <div id="shareLinks" style="display: none;">
                                        {!! Share::page(route('site.products.show', $product->id))->facebook()->twitter()->linkedin()->whatsapp()->telegram() !!}
                                    </div>




                                    {{-- <a href=""> <i class="bi bi-heart"></i> </a> --}}
                                    <a href="" data-url="{{ route('site.add.favorite') }}"
                                        data-id="{{ $product->id }}"
                                        class="heart pull-right {{ auth()->user() ? 'add_to_favorite' : 'auth_login' }}"><i
                                            class="{{ auth()->user() && $product->favorites->contains('user_id', auth()->user()->id) ? 'bi-heart-fill' : 'bi bi-heart' }}"></i></a>

                                </div>
                            </div>


                            @php
                                $isMerchant = auth()->check() && auth()->user()->hasRole('merchant'); // Assuming hasRole() is a method you've defined or comes from a package like Spatie's Laravel Permission.
                                $displayPrice = $isMerchant ? $product->list_price : $product->total_price;
                                $currency = transWord('جنية');
                            @endphp

                            <div class="product-price">
                                <h3>{{ $displayPrice }} {{ $currency }}</h3>
                                @if (!$isMerchant && $product->discount)
                                    <h4>{{ $product->price }} {{ $currency }}</h4>
                                    <div class="offer-price">{{ $product->discount }}
                                        {{ transWord('ج.م') }}</div>
                                @endif
                            </div>

                            <p>
                                {!! $product->desc !!}
                            </p>

                            <div class="btns-product-details">
                                <div class="counter">
                                    <span class="plus"> <i class="bi bi-plus"></i> </span>
                                    <input type="text" id="required-quantity" value="1" />
                                    <span class="minus"> <i class="bi bi-dash"></i> </span>
                                </div>

                                <a class="ctm-btn {{ auth()->user() ? 'btn_cart_form' : 'auth_login btn_cart_form' }}"
                                    data-id="{{ $product->id }}" href="{{ route('site.cart.store') }}"> <img
                                        src="{{ asset('site/images/icon/shopping-cart-w.svg') }}"
                                        alt="">{{ transWord('اضف للسلة') }}</a>
                            </div>


                            <div class="features-product">
                                @forelse ($product->values as $value)
                                    <div class="sub-features-product">
                                        <img src="{{ $value->icon_path }}" alt="">
                                        <h2>{{ $value->title }}</h2>
                                    </div>
                                @empty

                                    <div class="sub-features-product">

                                        <h2>{{ transWord('لا يوجد خصائص لهذا المنتج') }}</h2>
                                    </div>
                                @endforelse


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="sub-details ">
                            <h2>{{ transWord('نظرة عامة') }}</h2>
                            <p>
                                {!! $product->desc !!}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="sub-details">
                            <h2>{{ transWord('مواصفات المنتج') }}</h2>
                            <ul>
                                @if ($product->details)
                                    <li> {{ transWord('كود المنتج') }} <span> {{ $product->code_product }} </span></li>
                                    <li> {{ transWord('ابعاد المنتج') }} <span>
                                            {{ $product->details->dimensions_product }} </span></li>
                                    <li class="li-colors"> {{ transWord('الالوان') }}
                                        <div class="colors-span">
                                            @foreach ($product->details->color as $color)
                                                <span style="color: {{ $color }}; display: inline-block;"> <i
                                                        class="fas fa-circle"></i></span>
                                            @endforeach
                                        </div>
                                    </li>
                                    @if (auth()->check() && auth()->user()->hasRole('merchant'))
                                    <li>{{ transWord('العدد في الكرتونه') }}
                                        <span>{{ $product->details->num_carton }}</span>
                                    </li>
                                    <li>{{ transWord('ابعاد الكرتونه') }}
                                        <span>{{ $product->details->dimensions_carton }}</span>
                                    </li>
                                    <li>{{ transWord('حجم الكرتونة') }} <span>{{ $product->details->size_carton }}</span>
                                    </li>
                                    <li>{{ transWord('وزن الكرتونة') }}
                                        <span>{{ $product->details->weight_carton }}</span>
                                    </li>
                                    @endif

                                @else
                                    <li> {{ transWord('لا يوجد موصفات لهذا المنتج') }} </li>
                                @endif


                                {{-- @forelse ($product->details as $details)

                                @empty
                                    <li> {{ transWord('لا يوجد موصفات لهذا المنتج') }} </li>
                                @endforelse --}}

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="comments-details" id="rate_user">
                            <h2>{{ transWord('التقييمات والتعليقات') }}</h2>
                            <div class="list">


                                @forelse ( $reviews as $review )
                                    <div class="sub-comments-details">
                                        <div class="img-comments-details">
                                            <img src="{{ $review->user?->image_path }}" alt="">
                                        </div>

                                        <div class="text-comments-details">
                                            <h2 class="rate_name"> {{ $review->user->name }}</h2>
                                            <div class="rate">

                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rating)
                                                        <span class="fa fa-star checked"></span>
                                                    @else
                                                        <span class="fa fa-star"></span>
                                                    @endif
                                                @endfor
                                                <i>({{ $review->rating }})</i>
                                            </div>
                                            <p>
                                                {{ $review->review }}
                                            </p>
                                        </div>
                                    </div>

                                @empty

                                    <div class="sub-comments-details">
                                        <h2>{{ transWord('لا يوجد تعليقات') }}</h2>
                                        <div style="display:none" class="not_rate">null</div>

                                    </div>
                                @endforelse


                            </div>
                            @if ($reviews->count() > 0)
                                <ul class="pagination custom-pagination"></ul>
                            @endif


                        </div>
                        {{-- <div class="col-lg-12">

                            {{ $reviews->links('site.pagination.custom') }}

                        </div> --}}
                        <form action="{{ route('site.reviews.store') }}" method="post"
                            class="{{ auth()->user() ? 'form_reviews' : 'auth_login' }}">
                            @csrf
                            <div class="add-form-comments">
                                <div class="input-form w-100">
                                    <input type="text" placeholder="{{ transWord('اكتب تعليقك') }}" name="review"
                                        class="form-control" required>
                                </div>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="form-control add-rate text-center">
                                    <span class="rating">
                                        <input type="radio" name="rating" id="star5" value="5">
                                        <label for="star5"><span class="fa fa-star"></span></label>

                                        <input type="radio" name="rating" id="star4" value="4">
                                        <label for="star4"><span class="fa fa-star"></span></label>

                                        <input type="radio" name="rating" id="star3" value="3">
                                        <label for="star3"><span class="fa fa-star"></span></label>

                                        <input type="radio" name="rating" id="star2" value="2">
                                        <label for="star2"><span class="fa fa-star"></span></label>

                                        <input checked type="radio" name="rating" id="star1" value="1">
                                        <label for="star1"><span class="fa fa-star"></span></label>
                                    </span>
                                </div>
                                <button type="submit" id="review_button" class="ctm-btn"> {{ transWord('إرسال') }}
                                </button>

                            </div>
                        </form>
                    </div>

                    <div class="col-lg-12">
                        <div class="offers-products mt-10">
                            <div class="title-start">
                                <h2>{{ transWord('منتجات مشابهة') }}</h2>
                            </div>

                            <div class="slider-offers-products">
                                <div class="owl-carousel owl-theme " id="offers-products">
                                    @forelse ($productsRalated as $products)
                                        <div class="item">
                                            <div class="sub-product">
                                                <a href="{{ route('site.products.show', $products->id) }}">
                                                    <div class="img-sub-product">
                                                        <img src="{{ $products->image_path }}" alt="">
                                                    </div>

                                                    <div class="text-sub-product">
                                                        <h2>{{ $products->name }}</h2>
                                                        <p>{{ $products->sub_title }}</p>
                                                        <div class="product-price">
                                                            <h3> {{ $products->total_price }} {{ transWord('جنية') }}
                                                            </h3>
                                                            @if ($products->discount)
                                                                <h4> {{ $products->discount ?? $products->price }}
                                                                    {{ transWord('جنية') }}
                                                                </h4>

                                                                <div class="offer-price"> {{ $products->discount ?? 0 }}
                                                                    {{ transWord('ج.م') }}
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="btns-product btns-product-offer">



                                                    <div class="shareLinksRe-{{ $products->id }} main-share-links"
                                                        style="display: none;">
                                                        {!! Share::page(route('site.products.show', $product->id))->facebook()->twitter()->linkedin()->whatsapp()->telegram() !!}
                                                    </div>
                                                    <a href="{{ route('site.products.show', $products->id) }}"
                                                        class="ctm-btn3 w-100">
                                                        {{ transWord('مشاهدة المنتج') }}
                                                    </a>
                                                    <a href="{{ route('site.cart.store') }}"
                                                        data-id="{{ $products->id }}"
                                                        class="{{ auth()->user() ? 'btn-cart' : 'auth_login' }}">
                                                        <svg width="32" height="33" viewBox="0 0 32 33"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2.6665 3.16665H4.98651C6.42651 3.16665 7.55984 4.40665 7.43984 5.83332L6.33317 19.1133C6.1465 21.2866 7.86649 23.1533 10.0532 23.1533H24.2532C26.1732 23.1533 27.8532 21.58 27.9998 19.6733L28.7198 9.67332C28.8798 7.45999 27.1998 5.65998 24.9732 5.65998H7.75985"
                                                                stroke="#333333" stroke-width="1.8"
                                                                stroke-miterlimit="10" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M21.6667 29.8333C22.5871 29.8333 23.3333 29.0871 23.3333 28.1667C23.3333 27.2462 22.5871 26.5 21.6667 26.5C20.7462 26.5 20 27.2462 20 28.1667C20 29.0871 20.7462 29.8333 21.6667 29.8333Z"
                                                                stroke="#333333" stroke-width="1.8"
                                                                stroke-miterlimit="10" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M11.0002 29.8333C11.9206 29.8333 12.6668 29.0871 12.6668 28.1667C12.6668 27.2462 11.9206 26.5 11.0002 26.5C10.0797 26.5 9.3335 27.2462 9.3335 28.1667C9.3335 29.0871 10.0797 29.8333 11.0002 29.8333Z"
                                                                stroke="#333333" stroke-width="1.8"
                                                                stroke-miterlimit="10" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M12 11.1667H28" stroke="#333333" stroke-width="1.8"
                                                                stroke-miterlimit="10" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn_share"
                                                        data-id="{{ $products->id }}"> <i class="bi bi-share"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div>
                                            <h2>{{ transWord('لا يوجد منتجات مشابهة') }}</h2>
                                        </div>
                                    @endforelse


                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </section>



        {{--
        <div class="modal fade share-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-fotm-aosh">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"> <i class="bi bi-x-circle"></i></span>
                        </button>
                        <div class="logo-aosh">
                            <a href="{{ route('site.home') }}">
                                <object data="{{ asset('site/images/logo.svg') }}" type="">
                                    <img src="{{ asset('site/images/logo.svg') }}" alt="">
                                </object>
                            </a>
                        </div>





                        <div class="form-aosh">

                            {!! Share::page(route('site.products.show', $product->id), $product->name)->facebook()->twitter()->linkedin()->whatsapp()->telegram() !!}

                        </div>




                    </div>
                </div>
            </div>
        </div> --}}




    </main>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>

    <script>
        // add top favoret
        $(document).ready(function() {
            $('.btn_share').click(function() {
                var id = $(this).data('id');

                $('.shareLinksRe-' + id).toggle();
            });
            $('.btn_cart_form').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = $(this).attr('href');
                var quantity = $('#required-quantity').val();

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        id: id,
                        quantity: quantity
                    },
                    success: function(data) {



                        if (data.type == 'error') {
                            Swal.fire({
                                icon: 'error',
                                title: `<h5> ${data.message}</h5> `,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            return;

                        }
                        Swal.fire({
                            icon: 'success',
                            title: "<h5> {{ transWord('تم الاضافة بنجاح') }} </h5>",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // if (data.type == 'success') {
                        //     setTimeout(() => {
                        //         location.reload();

                        //     }, 1000);
                        // }


                        $('#add_cart').html(data);
                        let count = $('.title-cart-header').data('count');
                        $('#count_cart').text(count);

                        // $('#order_emty').hide();
                        // $('.cart_count').text(data.cart_count);
                        // $('.cart_count').show();
                    }
                });
            });

            $(".add_to_favorite").click(function(e) {
                e.preventDefault();

                var id = $(this).data('id');
                var url = $(this).data('url');
                var This = $(this);
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.status = true) {

                            if (This.find("i").hasClass("bi-heart-fill")) {
                                This.find("i").removeClass("bi-heart-fill");
                                This.find("i").addClass("bi-heart");
                                This.removeClass("animated rubberBand");
                                This.css("color", "#005E8A");
                            } else {
                                This.find("i").removeClass("bi-heart");
                                This.find("i").addClass("bi-heart-fill");
                                This.addClass("animated rubberBand");
                                //   This.css("color", "#D8282D");
                            }

                            Swal.fire({
                                icon: 'success',
                                html: '<h4>' + response.message +
                                    '</h4>', // Example of adding an HTML tag
                                showConfirmButton: false,
                                timer: 1500
                            })

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }

                    },
                });

            });

        });


        var lang = 'ar';

        if (lang == 'ar') {
            var message = 'يجب عليك التسجيل لاستخدام هذه الميرة';
            var message_sure = 'هل تريد التسجبل ؟';
            var yes = 'نعم';
            var no = 'لا';
            var message_close = 'تم الالغاء بنجاح';
            var paynow = 'اشتري الان';
        } else {

            var message = 'You must register to use this feature';
            var message_sure = 'Do you want to register ?';
            var yes = 'Yes';
            var no = 'No';
            var message_close = 'Canceled successfully';
            var paynow = 'Pay Now';
        }

        $(document).on('click', '.auth_login', function(e) {
            e.preventDefault();
            Swal.fire({
                title: message_sure,
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: yes,
                cancelButtonText: no
            }).then((result) => {
                if (result.isConfirmed) {

                    $('.login-modal').modal('show');

                } else {

                }
            })

        });

        function toggleShareLinks() {
            $('#shareLinks').toggle();
        }


        @if ($reviews->count() > 0)

            function initializeListJS() {
                var options = {
                    valueNames: ['rate_name'],
                    page: 6,
                    pagination: true
                };
                var addressList = new List('rate_user', options);
            }

            // Initialize List.js on page load
            initializeListJS();
        @endif
    </script>
@endpush


{{-- @push('js')
    <script>
        // $(document).ready(function() {
        //     $.validator.addMethod("noSpecialChars", function(value, element) {
        //         return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF ]*$/.test(value);
        //     }, window.noSpecialChars);


        //     $.validator.addMethod('string', function(value, element) {
        //         return this.optional(element) || /^[\u0600-\u06FFa-zA-Z\s]+$/i.test(value);
        //     }, window.stringMessage);


        //     $("#form_reviews").validate({


        //         rules: {
        //             // Define validation rules for your form fields here
        //             review: {
        //                 required: true,
        //                 minlength: 2,
        //                 noSpecialChars: true,
        //                 string: true
        //             },

        //             rating: {
        //                 required: true,

        //             },


        //             // Add more fields as needed
        //         },




        //         errorElement: "span",
        //         errorLabelContainer: ".errorTxt",


        //         submitHandler: function(form) {
        //             $('.ctm-btn').prop('disabled', true);
        //             // Hide the button
        //             $('.ctm-btn').hide();

        //             // Add a spinner
        //             $('.ctm-btn').parent().append(
        //                 `<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        //         <span class="sr-only">Loading...</span>
        //         </div>
        //                `
        //             );


        //             var formData = new FormData(form);
        //             let url = form.action;
        //             $.ajax({
        //                 url: url,
        //                 method: 'POST',
        //                 data: formData,
        //                 processData: false,
        //                 contentType: false,
        //                 success: function(data) {
        //                     console.log(data);

        //                     form.reset();
        //                     Swal.fire({
        //                         icon: 'success',
        //                         title: `<h5> ${data.success}</h5> `,
        //                         showConfirmButton: false,
        //                         timer: 2000
        //                     });
        //                     //i need append the new review to the reviews section class comments-details
        //                     var review = `
        //                     <div class="sub-comments-details">
        //                             <div class="img-comments-details">
        //                                 <img src="${data.image}" alt="">
        //                             </div>

        //                             <div class="text-comments-details">
        //                                 <h2> ${data.name} </h2>
        //                                 <div class="rate">

        //                                     <span class="fa fa-star
        //                                     ${data.rating >= 1 ? 'checked' : ''}"></span>
        //                                     <span class="fa fa-star
        //                                     ${data.rating >= 2 ? 'checked' : ''}"></span>
        //                                     <span class="fa fa-star
        //                                     ${data.rating >= 3 ? 'checked' : ''}"></span>

        //                                     <span class="fa fa-star
        //                                     ${data.rating >= 4 ? 'checked' : ''}"></span>
        //                                     <span class="fa fa-star
        //                                     ${data.rating >= 5 ? 'checked' : ''}"></span>
        //                                     <i>(${data.rating})</i>
        //                                 </div>
        //                                 <p>
        //                                     ${data.review}
        //                                 </p>
        //                             </div>
        //                         </div>
        //                     `;


        //                     $('.comments-details').append(review);







        //                     $('.ctm-btn').prop('disabled', false);


        //                     // Show the button
        //                     $('.ctm-btn').show();

        //                     // Remove the spinner
        //                     $('.ctm-btn').next('.spinner-border').remove();

        //                 },
        //                 error: function(data) {

        //                     $('.ctm-btn').prop('disabled', false);

        //                     // Show the button
        //                     $('.ctm-btn').show();

        //                     // Remove the spinner
        //                     $('.ctm-btn').next('.spinner-border').remove();
        //                     $('.error-message').text('');
        //                     var errors = data.responseJSON.errors;
        //                     $.each(errors, function(field, messages) {
        //                         var errorMessage = messages.join(', ');
        //                         $('#' + field + '_error').text(
        //                             errorMessage);
        //                     });
        //                 },
        //             });

        //         },
        //     });

        //     // $(document).on('submit', '#form_reviews', function(e) {
        //     //     console.log('submit');
        //     //     e.preventDefault();
        //     //     var form = $(this);
        //     //     var url = form.attr('action');
        //     //     var formData = new FormData($('#form_reviews')[0]);

        //     //     $.ajax({
        //     //         type: 'POST',
        //     //         url: url,
        //     //         data: formData,
        //     //         processData: false,
        //     //         contentType: false,
        //     //         success: function(data) {
        //     //             console.log(data);
        //     //             if (data.status == true) {
        //     //                 $('#form_reviews')[0].reset();
        //     //                 toastr.success(data.message);
        //     //             } else {
        //     //                 toastr.error(data.message);
        //     //             }
        //     //         },
        //     //         error: function(data) {
        //     //             console.log(data);
        //     //             toastr.error('error');
        //     //         }
        //     //     });

        //     // });
        // });

        var lang = 'ar';

        if (lang == 'ar') {
            var message = 'يجب عليك التسجيل لاستخدام هذه الميرة';
            var message_sure = 'هل تريد التسجبل ؟';
            var yes = 'نعم';
            var no = 'لا';
            var message_close = 'تم الالغاء بنجاح';
            var paynow = 'اشتري الان';
        } else {

            var message = 'You must register to use this feature';
            var message_sure = 'Do you want to register ?';
            var yes = 'Yes';
            var no = 'No';
            var message_close = 'Canceled successfully';
            var paynow = 'Pay Now';
        }

        $(document).on('submit', '#auth_login', function(e) {
            e.preventDefault();
            Swal.fire({
                title: message_sure,
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: yes,
                cancelButtonText: no
            }).then((result) => {
                if (result.isConfirmed) {

                    $('.login-modal').modal('show');

                } else {

                }
            })

        });
</script>
@endpush --}}
