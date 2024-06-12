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
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="text-hero">
                            <h3>{{ transWord('خصومات تصل ل 20%') }}</h3>
                            <h1>
                                {{ transWord('استمتع بأفضل العروض والخصومات مع') }}
                                <span>{{ getSetting('name_website', app()->getLocale()) }} </span>
                            </h1>
                            <div class="btn-hero">
                                <a href="{{ route('site.products') }}" class="ctm-btn">{{ transWord('تسوق الان') }}</a>
                                <a href="" class="ctm-btn2"><img src="{{ asset('site/images/Simplification.png') }}"
                                        alt="">
                                    {{ transWord('كتالوج الشركة') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="img-hero">
                            <object data="{{ asset('storage/' . getSetting('slider_image')) }}" type="">
                                <img src="{{ asset('storage/' . getSetting('slider_image')) }}" alt="">
                            </object>
                        </div>
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
                                    <a href="product-details">
                                        <div class="img-sub-product">
                                            <img src="{{ $offer->image_path }}" alt="">
                                        </div>

                                        <div class="text-sub-product">
                                            <h2>{{ $offer->title }}</h2>
                                            <p>{{ $offer->sub_title }}</p>
                                            <div class="product-price">
                                                <h3>{{ $offer->price }}</h3>
                                                <h4> {{ $offer->price_after_discount }} </h4>
                                            </div>
                                        </div>
                                        <div style="background-color: {{ $offer->label_color }}"
                                            class="discount sub-tools"> {{ $offer->label }} </div>

                                    </a>
                                    <div class="btns-product">
                                        <a href="{{ route('site.products.show', $offer->id) }}"
                                            class="ctm-btn3 w-100">{{ transWord('مشاهدة المنتج') }}</a>
                                        <a href="" class="btn-cart">
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
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse


                    </div>
                </div>

                <div class="text-center mt-4">
                    <a class="ctm-btn" href="{{ route('site.products') }}">{{ transWord('المزيد') }} </a>
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
                            <a href="{{ route('site.products') }}">
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
                            <li><a href="" class="active home-filter" id="all"> {{ transWord('الكل') }} </a></li>
                            <li><a href="" class=" home-filter" id="new">{{ transWord('جديدة') }}</a></li>
                            <li><a href=""class=" home-filter" id="most-sale"> {{ transWord('الاكثر مبيعا') }}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row row-gap product-result">
                    @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6">
                            <div class="sub-product">
                                <a href="product-details">
                                    <div class="img-sub-product">
                                        <img src="{{ $product->image_path }}" alt="">
                                    </div>

                                    <div class="text-sub-product">
                                        <h2>{{ $product->name }}</h2>
                                        <p>{{ $product->sub_title }}</p>
                                    </div>
                                </a>
                                <div class="btns-product">
                                    <a href="{{ route('site.products.show', $product->id) }}"
                                        class="ctm-btn3 w-100">{{ transWord('مشاهدة المنتج') }}</a>
                                    <a href="" class="btn-cart">
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
                    @forelse ( $banners as $banner )
                    <div class="item">
                        <div class="sub-banners" style="background-color: {{ $banner->color['color_ground'] }};">
                            <div class="img-banners">
                                <img src="{{ $banner->image_path }}" alt="">
                            </div>
                            <div class="text-banner">
                                <h3>{{ $banner->title }}</h3>
                                <h2 style="color: {{ $banner->color['color_title'] }}">{{ $banner->sub_title }}</h2>
                                <a href="{{ route('site.products') }}" style="background-color: {{ $banner->color['color_btn'] }}" class="ctm-btn"> {{ transWord('تسوق الان ') }}</a>
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
                            <a href="{{ route('site.aboutUs') }}" class="ctm-btn">{{ transWord('أقرأ المزيد') }}</a>
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
        $('.home-filter').click(function(e) {
            e.preventDefault();
            var filter = $(this).attr('id');
            $('.home-filter').removeClass('active');
            $.ajax({
                url: "{{ route('site.homefilter') }}",
                type: 'GET',
                data: {
                    filter: filter
                },
                success: function(data) {
                    $('.product-result').html(data);
                    $("#" + filter).addClass('active');
                }
            });
        });
    });
    </script>

@endpush
