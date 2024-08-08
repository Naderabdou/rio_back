@extends('site.layouts.app')
@section('title', transWord('Home'))

@title(getSetting('seo_title', app()->getLocale()))
@description(Str::limit(getSetting('desc_seo', app()->getLocale()), 160))
@keywords(implode(',', json_decode(getSetting('keyword', app()->getLocale()))))
@image(asset('storage/' . getSetting('logo')))

@section('content')

    <!-- start app ====
                                                                                                                                                                            ===============================
                                                                                                                                                                            ================================
                                                                                                                                                                            ============== --
                                                                                                                                                                            -->
    <main id="app">
        <!-- start hero -->
        <section class="hero">
            <div class="main-container">
                {{-- <div class="modal fade vidoe-open" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <object id="object_video" data="" type="">
                                    <video width="50%" height="50%" controls>
                                        <source id="video_src" src="" type="video/mp4">
                                    </video>
                                </object>
                            </div>

                        </div>
                    </div>
                </div> --}}
                <!-- Modal -->
                <div class="modal fade vidoe-open" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" id="model-content-remove">
                            <div class="modal-fotm-aosh">
                                <div class="logo-aosh">

                                    <div id="object_video" type="">
                                        <video id="video-model-slider" width="50%" height="50%" controls>
                                            <source id="video_src" src="" type="video/mp4">
                                        </video>
                                    </div>

                                </div>









                            </div>
                        </div>
                    </div>
                </div>
                {{-- model --}}


                <div class="row align-items-center">
                    <div class="col-lg-6 p-l-85 p-l-sm-res">
                        <div class="text-hero">
                            <h3>{{ transWord('خصومات تصل ل 20%') }}</h3>
                            <h1>
                                {{ transWord('استمتع بأفضل العروض والخصومات مع') }}
                                <span>{{ getSetting('name_website', app()->getLocale()) }} </span>
                            </h1>
                            <div class="btn-hero">
                                <a href="{{ route('site.products') }}" class="ctm-btn">{{ transWord('تسوق الان') }}</a>

                                <a target="__blank" href="{{ url(asset('storage/' . getSetting('catlog_company'))) }}"
                                    class="ctm-btn2"><img src="{{ asset('site/images/Simplification.png') }}"
                                        alt="">
                                    {{ transWord('كتالوج الشركة') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="owl-carousel owl-theme" id="main-slider">
                            @forelse ($sliders as  $slider)
                                <div class="item">

                                    {{-- Tee video viewer --}}




                                    <div class="img-hero">
                                        @if ($slider->type == 'image')
                                            <object data="{{ $slider->image_path }}" type="">
                                                <img src="{{ $slider->image_path }}" alt="">
                                            </object>
                                        @else
                                            <div class="slider-img">
                                                <img src="{{ $slider->image_video_path }}" alt="">
                                                <a data-video="{{ $slider->video_path }}" href=""
                                                    data-toggle="modal" class="icon" data-target=".vidoe-modal"
                                                    data-dismiss="modal">
                                                    <i class="fa-solid fa-play"></i>
                                                </a>
                                                {{-- <div class="icon" data-toggle="modal" data-target="#exampleModalLong"> <i
                                                        class="fa-solid fa-play"></i> </div> --}}
                                            </div>

                                            <!-- Modal -->
                                            <!-- Button trigger modal -->
                                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModalCenter">
                                                Launch demo modal
                                            </button> --}}
                                        @endif


                                    </div>

                                </div>
                            @empty
                                <div class="item">

                                    <div class="img-hero">
                                        <object data="{{ asset('storage/' . getSetting('slider_image')) }}" type="">
                                            <img src="{{ asset('storage/' . getSetting('slider_image')) }}" alt="">
                                        </object>
                                    </div>

                                </div>
                            @endforelse


                        </div>

                        {{-- <div class="img-hero">
                            <object data="{{ asset('storage/' . getSetting('slider_image')) }}" type="">
                                <img src="{{ asset('storage/' . getSetting('slider_image')) }}" alt="">
                            </object>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero -->


        <!-- start features-index  -->
        <section class="features-index">
            <div class="main-container">
                <div class="row row-gap">
                    @forelse ($features as $feature)
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="sub-features-index">
                                <div class="img-features-index">
                                    <img src="{{ $feature->icon_path }}" alt="">
                                </div>
                                <div class="text-features-index">
                                    <h2>{{ $feature->title }}</h2>
                                    <p> {{ $feature->desc }} </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="sub-features-index">
                                <div class="img-features-index">
                                    <img src="{{ asset('site/images/not.png') }}" alt="">
                                </div>
                                <div class="text-features-index">
                                    <h2>{{ transWord('لايوجد مميزات') }} </h2>
                                    <p>{{ transWord('لايوجد مميزات') }} </ح>
                                </div>
                            </div>
                        </div>
                    @endforelse


                </div>
            </div>
        </section>
        <!-- end features-index  -->

        <!-- start offers products -->
        <section class="offers-products mr-section">
            <div class="main-container">
                <div class="title-start">
                    <h2>{{ transWord('عروض مميزه') }}</h2>
                </div>

                <div class="slider-offers-products">
                    <div class="owl-carousel owl-theme " id="offers-products">
                        @forelse ($products->where('has_offer',1) as $offer)
                            <div class="item">
                                <div class="sub-product">
                                    <a href="{{ route('site.products.show', $offer->id) }}">
                                        <div class="img-sub-product">
                                            <img src="{{ $offer->image_path }}" alt="">
                                        </div>


                                        <div class="text-sub-product">
                                            <h2 class="product_name">{{ $offer->name }}</h2>
                                            <p>{{ $offer->sub_title }}</p>

                                            @php
                                                $isMerchant = auth()->check() && auth()->user()->hasRole('merchant'); // Assuming hasRole() is a method you've defined or comes from a package like Spatie's Laravel Permission.
                                                $displayPrice = $isMerchant ? $offer->list_price : $offer->total_price;
                                                $currency = transWord('جنية');
                                            @endphp

                                            <div class="product-price">
                                                <h3>{{ $displayPrice }} {{ $currency }}</h3>
                                                @if (!$isMerchant && $offer->discount)
                                                    <h4>{{ $offer->price }} {{ $currency }}</h4>
                                                    <div class="offer-price">{{ $offer->discount }}
                                                        {{ transWord('ج.م') }}</div>
                                                @endif
                                            </div>
                                            @if ($isMerchant)
                                                <p>{{ transWord('هذا السعر للكرتونة') }}</p>
                                            @endif
                                        </div>















                                        <div style="background-color: {{ $offer->label_color }}"
                                            class="discount sub-tools"> {{ $offer->label }} </div>

                                    </a>
                                    <div class="btns-product btns-product-offer">



                                        <div class="shareLinks-{{ $offer->id }} main-share-links "
                                            style="display: none;">
                                            {!! Share::page(route('site.products.show', $offer->id))->facebook()->twitter()->linkedin()->whatsapp()->telegram() !!}
                                        </div>

                                        <a href="{{ route('site.products.show', $offer->id) }}"
                                            class="ctm-btn3 w-100">{{ transWord('مشاهدة المنتج') }}</a>
                                        <a href="{{ route('site.cart.store') }}"
                                            class="{{ auth()->user() ? 'btn-cart' : 'auth_login btn-cart' }}"
                                            data-id="{{ $offer->id }}">
                                            <svg width="32" height="33" viewBox="0 0 32 33" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2.6665 3.16665H4.98651C6.42651 3.16665 7.55984 4.40665 7.43984 5.83332L6.33317 19.1133C6.1465 21.2866 7.86649 23.1533 10.0532 23.1533H24.2532C26.1732 23.1533 27.8532 21.58 27.9998 19.6733L28.7198 9.67332C28.8798 7.45999 27.1998 5.65998 24.9732 5.65998H7.75985"
                                                    stroke="#333333" stroke-width="1.8" stroke-miterlimit="10"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M21.6667 29.8333C22.5871 29.8333 23.3333 29.0871 23.3333 28.1667C23.3333 27.2462 22.5871 26.5 21.6667 26.5C20.7462 26.5 20 27.2462 20 28.1667C20 29.0871 20.7462 29.8333 21.6667 29.8333Z"
                                                    stroke="#333333" stroke-width="1.8" stroke-miterlimit="10"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M11.0002 29.8333C11.9206 29.8333 12.6668 29.0871 12.6668 28.1667C12.6668 27.2462 11.9206 26.5 11.0002 26.5C10.0797 26.5 9.3335 27.2462 9.3335 28.1667C9.3335 29.0871 10.0797 29.8333 11.0002 29.8333Z"
                                                    stroke="#333333" stroke-width="1.8" stroke-miterlimit="10"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M12 11.1667H28" stroke="#333333" stroke-width="1.8"
                                                    stroke-miterlimit="10" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </a>

                                        <a href="javascript:void(0);" class="btn_share" data-id="{{ $offer->id }}">
                                            <i class="bi bi-share"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @empty
                            <div>
                                <div class="notFound">
                                    <img src="{{ asset('site/images/not.png') }}">
                                    <h2>{{ transWord('لايوجد عروض في الوقت الحالي') }} </h2>
                                </div>
                            </div>
                        @endforelse


                    </div>
                </div>

                <div class="text-center mt-4">
                    <a class="ctm-btn" href="{{ route('site.offers.products') }}">{{ transWord('المزيد') }} </a>
                </div>
            </div>
        </section>
        <!-- end offers products -->

        <!-- start categories-index -->
        <section class="categories-index mr-section">
            <div class="main-container">
                <div class="title-center">
                    <h2>{{ transWord('تصنيفات منتجاتنا') }}</h2>
                </div>
                <div class="owl-carousel owl-theme " id="categories">
                    @forelse ($categories as $category)
                        <div class="item">
                            <a href="{{ route('site.products.category',$category->id) }}">
                                <div class="sub-categories-index">
                                    <div class="img-categories-index">
                                        <img src="{{ $category->image_path }}" alt="">
                                    </div>
                                    <h2>{{ $category->name }}</h2>
                                </div>
                            </a>
                        </div>
                    @empty


                        <div class="item">
                            <a href="">
                                <div class="sub-categories-index">
                                    <div class="img-categories-index">
                                        <img src="{{ asset('site/images/not.png') }}" alt="">
                                    </div>
                                    <h2>{{ transWord('لايوجد تصنيفات الان') }}</h2>
                                </div>
                            </a>
                        </div>
                    @endforelse


                </div>
            </div>
        </section>
        <!-- end categories-index -->

        <!-- start prodects-index -->
        <section class="prodects-index mr-section">
            <div class="main-container">
                <div class="title-products-index">
                    <div class="title-start">
                        <h2>{{ transWord('منتجاتنا') }} </h2>
                    </div>
                    <div class="filter-product-index">
                        <ul>
                            <li><a href="" class="active home-filter" id="all"> {{ transWord('الكل') }}
                                </a></li>
                            <li><a href="" class=" home-filter" id="new">{{ transWord('جديدة') }}</a></li>
                            <li><a href=""class=" home-filter" id="most-sale"> {{ transWord('الاكثر مبيعا') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row row-gap product-result">
                    @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6">
                            <div class="sub-product">
                                <a href="{{ route('site.products.show', $product->id) }}">
                                    <div class="img-sub-product">
                                        <img src="{{ $product->image_path }}" alt="">
                                    </div>



                                    <div class="text-sub-product">
                                        <h2 class="product_name">{{ $product->name }}</h2>
                                        <p>{{ $product->sub_title }}</p>

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
                                        @if ($isMerchant)
                                            <p>{{ transWord('هذا السعر للكرتونة') }}</p>
                                        @endif
                                    </div>









                                </a>
                                <div class="btns-product">



                                    <div class="shareLinksProduct-{{ $product->id }} main-share-links"
                                        style="display: none;">
                                        {!! Share::page(route('site.products.show', $product->id))->facebook()->twitter()->linkedin()->whatsapp()->telegram() !!}
                                    </div>
                                    <a href="{{ route('site.products.show', $product->id) }}"
                                        class="ctm-btn3 w-100">{{ transWord('مشاهدة المنتج') }}</a>

                                    <a href="{{ route('site.cart.store') }}"
                                        class="{{ auth()->user() ? 'btn-cart' : 'auth_login btn-cart' }}"
                                        data-id="{{ $product->id }}">
                                        <svg width="32" height="33" viewBox="0 0 32 33" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.6665 3.16665H4.98651C6.42651 3.16665 7.55984 4.40665 7.43984 5.83332L6.33317 19.1133C6.1465 21.2866 7.86649 23.1533 10.0532 23.1533H24.2532C26.1732 23.1533 27.8532 21.58 27.9998 19.6733L28.7198 9.67332C28.8798 7.45999 27.1998 5.65998 24.9732 5.65998H7.75985"
                                                stroke="#333333" stroke-width="1.8" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M21.6667 29.8333C22.5871 29.8333 23.3333 29.0871 23.3333 28.1667C23.3333 27.2462 22.5871 26.5 21.6667 26.5C20.7462 26.5 20 27.2462 20 28.1667C20 29.0871 20.7462 29.8333 21.6667 29.8333Z"
                                                stroke="#333333" stroke-width="1.8" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M11.0002 29.8333C11.9206 29.8333 12.6668 29.0871 12.6668 28.1667C12.6668 27.2462 11.9206 26.5 11.0002 26.5C10.0797 26.5 9.3335 27.2462 9.3335 28.1667C9.3335 29.0871 10.0797 29.8333 11.0002 29.8333Z"
                                                stroke="#333333" stroke-width="1.8" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12 11.1667H28" stroke="#333333" stroke-width="1.8"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>

                                    <a href="javascript:void(0);" class="btn_share_product"
                                        data-id="{{ $product->id }}">
                                        <i class="bi bi-share"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="notFound">
                            {{-- <img src="{{ asset('site/images/not.png') }}"> --}}
                            <img src="{{ asset('site/images/not.png') }}">

                            <h2>{{ transWord('لايوجد منتجات في الوقت الحالي') }} </h2>
                        </div>
                    @endforelse



                    <div class="col-lg-12">
                        <div class="text-center mt-4">
                            <a class="ctm-btn" href="{{ route('site.products') }}">{{ transWord('كل المنتجات') }}</a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- end prodects-index -->

        <!-- start banner  -->
        <section class="banners mr-section">
            <div class="main-container">
                <div class="owl-carousel owl-theme " id="banners">
                    @forelse ($banners as $banner)
                        <div class="item">
                            <div class="sub-banners" style="background-color: {{ $banner->color['color_ground'] }};">
                                <div class="img-banners">
                                    <img src="{{ $banner->image_path }}" alt="">
                                </div>
                                <div class="text-banner">
                                    <h3>{{ $banner->title }}</h3>
                                    <h2 style="color: {{ $banner->color['color_title'] }}">{{ $banner->sub_title }}</h2>
                                    <a href="{{ route('site.products.show', $banner->product_id) }}"
                                        style="background-color: {{ $banner->color['color_btn'] }}" class="ctm-btn">
                                        {{ transWord('تسوق الان ') }}</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="item">
                            <div class="sub-banners" style="background-color: #EDFAFF;">
                                <div class="img-banners">
                                    <img src="{{ asset('site/images/not.png') }}" alt="">
                                </div>
                                <div class="text-banner">
                                    <h3>{{ transWord('لايوجد اعلانات االان') }}</h3>

                                </div>
                            </div>
                        </div>
                    @endforelse



                </div>
            </div>
        </section>
        <!-- end banner  -->



        <section class="aboutus-index">
            <div class="main-container h-100">
                <div class="row align-items-center h-100">
                    <div class="col-lg-7">
                        <div class="text-aboutus-index">
                            <h2> {{ transWord('عن الشركة ') }}</h2>
                            <p>
                                {{ getSetting('home_about_desc', app()->getLocale()) }}

                            </p>
                            <a href="{{ route('site.aboutUs') }}" class="ctm-btn center-btn" >{{ transWord('أقرأ المزيد') }}</a>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="main-img-aboutus-index">

                            <div class="img-aboutus-index">
                                <span>
                                    <img src="{{ asset('storage/' . getSetting('home_about_image')) }}" alt="">
                                </span>
                            </div>
                            <div class="bg-about-index">
                                <object data="{{ asset('site/images/logoabout.svg') }}" type="">
                                    <img src="{{ asset('site/images/logoabout.svg') }}" alt="">
                                </object>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- end app ====
                                                                                                                                                                            =============================
                                                                                                                                                                            ==================================
                                                                                                                                                                            ==================== -->

@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.btn_share').click(function() {
                var id = $(this).data('id');

                $('.shareLinks-' + id).toggle();
            });
            $(document).on('click', '.btn_share_product', function() {
                var id = $(this).data('id');
                $('.shareLinksProduct-' + id).toggle();
            });
            // $('.btn-cart').click(function(e) {
            //     e.preventDefault();
            //     var id = $(this).data('id');
            //     var url = $(this).attr('href');
            //     $.ajax({
            //         url: url,
            //         type: 'GET',
            //         data: {
            //             id: id
            //         },
            //         success: function(data) {
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: `<h5> ${data.message}</h5> `,
            //                 showConfirmButton: false,
            //                 timer: 1500
            //             });
            //             if (data.type == 'success') {
            //                 setTimeout(() => {
            //                     location.reload();

            //                 }, 1000);
            //             }


            //             // $('#add_cart').append(data);
            //             // $('#order_emty').hide();
            //             // $('.cart_count').text(data.cart_count);
            //             // $('.cart_count').show();
            //         }
            //     });
            // });
            $('.home-filter').click(function(e) {
                e.preventDefault();
                var filter = $(this).attr('id');
                $('.home-filter').removeClass('active');
                $('.product-result').hide();

                // Add a spinner
                $('.product-result').parent().append(
                    `<div class="spinner" style="display: flex; justify-content: center; align-items: center; position: reletive; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.5); z-index: 1050;">
<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
<span class="sr-only">Loading...</span>
</div>
</div>`
                );
                $.ajax({
                    url: "{{ route('site.homefilter') }}",
                    type: 'GET',
                    data: {
                        filter: filter
                    },
                    success: function(data) {
                        $('.product-result').show();
                        $('.spinner').remove();
                        $('.product-result').html(data);
                        $("#" + filter).addClass('active');
                    }
                });
            });

            $(document).on('click', '.icon', function(e) {
                e.preventDefault();
                var video = $(this).data('video');
                console.log(video);
                var videoElement = $('#video-model-slider').get(0); // Get the native DOM video element

                $('#video-model-slider').find('source').attr('src', video);
                // $('#object_video').attr('data', video);
                videoElement.load(); // Important to reload the video element to apply the new source
                videoElement.play(); // Optionally, auto-play the new video

                $('.vidoe-open').modal('show');
                // $('.vidoe-open').find('iframe').attr('src', video);

            });

            $('.vidoe-open').on('click', function(e) {

                $('.vidoe-open').modal('hide');

                var videoElement = $('#video-model-slider').get(0); // Get the native DOM video element
                if (videoElement) { // Check if the video element exists
                    videoElement.pause(); // Pause the video
                    $('#video-model-slider').find('source').attr('src', ''); // Clear the video source
                    //$('#object_video').attr('data', ''); // Clear the video source
                    //  videoElement.load(); // Reload the video element to apply changes
                } else {
                    console.error('Video element not found');
                }
            });

        });
    </script>
@endpush
