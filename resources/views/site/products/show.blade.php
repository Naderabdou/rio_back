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
                                    <a href=""> <i class="bi bi-share"></i></a>
                                    {{-- <a href=""> <i class="bi bi-heart"></i> </a> --}}
                                    <a href="" data-url="{{ route('site.add.favorite') }}"
                                        data-id="{{ $product->id }}"
                                        class="heart pull-right {{ auth()->user() ? 'add_to_favorite' : 'auth_login' }}"><i
                                            class="{{ auth()->user() && $product->favorites->contains('user_id', auth()->user()->id) ? 'bi-heart-fill' : 'bi bi-heart' }}"></i></a>

                                </div>
                            </div>

                            <div class="product-price">
                                <h3> {{ $product->price }} EGP </h3>
                                {{-- @if ($product->discount)
                                <h4> {{ $product->price_after_discount  }} EGP </h4>
                                <div class="offer-price"> {{ $product->discount ?? 0 }}% OFF</div>
                                @endif --}}
                                {{-- <h4> {{ $product->price_after_discount ?? $product->price }} EGP </h4> --}}
                                <h4> {{ $product->price_after_discount ?? 0 }} EGP </h4>
                                <div class="offer-price"> {{ $product->discount ?? 0 }}% OFF</div>
                            </div>

                            <p>
                                {{ strip_tags($product->desc) }}
                            </p>

                            <div class="btns-product-details">
                                <div class="counter">
                                    <span class="plus"> <i class="bi bi-plus"></i> </span>
                                    <input type="text" id="required-quantity" value="1" />
                                    <span class="minus"> <i class="bi bi-dash"></i> </span>
                                </div>
                                <a href="{{ route('site.cart.store') }}" data-id="{{ $products->id }}"
                                    class="{{ auth()->user() ? 'btn-cart ctm-btn' : 'auth_login ctm-btn' }}">

                                    <a class="ctm-btn"> <img src="{{ asset('site/images/icon/shopping-cart-w.svg') }}"  alt="">{{ transWord('اضف للسلة') }}</a>
                            </div>


                            <div class="features-product">
                                <div class="sub-features-product">
                                    <img src="{{ asset('site/images/f5.png') }}" alt="">
                                    <h2>{{ transWord('تسوق آمن') }}</h2>
                                </div>
                                <div class="sub-features-product">
                                    <img src="{{ asset('site/images/f6.png') }}" alt="">
                                    <h2>{{ transWord('الدفع عند الاستلام') }}</h2>
                                </div>
                                <div class="sub-features-product">
                                    <img src="{{ asset('site/images/f7.png') }}" alt="">
                                    <h2>{{ transWord('تسوق آمن') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="sub-details ">
                            <h2>{{ transWord('نظرة عامة') }}</h2>
                            <p>
                                {{ strip_tags($product->desc) }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="sub-details">
                            <h2>{{ transWord('مواصفات المنتج') }}</h2>
                            <ul>
                                @forelse ($product->details as $details)
                                    <li> {{ $details->key }} <span> {{ $details->value }} </span></li>
                                @empty
                                    <li> {{ transWord('لا يوجد موصفات لهذا المنتج') }} </li>
                                @endforelse

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="comments-details">
                            <h2>{{ transWord('التقييمات والتعليقات') }}</h2>
                            @forelse ( $reviews as $review )
                                <div class="sub-comments-details">
                                    <div class="img-comments-details">
                                        <img src="{{ $review->user?->image_path }}" alt="">
                                    </div>

                                    <div class="text-comments-details">
                                        <h2> {{ $review->user->name }}</h2>
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
                                </div>
                            @endforelse



                        </div>
                        {{-- <div class="col-lg-12">

                            {{ $reviews->links('site.pagination.custom') }}

                        </div> --}}
                        <form action="{{ route('site.reviews.store') }}" method="post"
                            id="{{ auth()->user() ? 'form_reviews' : 'auth_login' }}">
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
                                                            <h3>EGP {{ $products->price }} </h3>
                                                            {{-- <h4> EGP {{ $products->price_after_discount }} </h4> --}}
                                                            {{-- <h4> {{ $product->price_after_discount ?? $product->price }} EGP </h4> --}}
                                                            <h4> {{ $products->price_after_discount ?? $products->price }}
                                                                EGP </h4>

                                                            <div class="offer-price"> {{ $products->discount ?? 0 }}% OFF
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="btns-product">
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









    </main>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>

    <script>
        // add top favoret
        $(document).ready(function() {

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
                                title: response.message,
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
