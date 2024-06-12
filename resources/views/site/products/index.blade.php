@extends('site.layouts.app')
@section('title', transWord('منتجاتنا'))

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
            <h2>{{ transWord('منتجاتنا') }}</h2>
            <div class="breadcrumb-header">
                <a href="{{ route('site.home') }}"> {{ transWord('الرئيسية') }} </a> <img
                    src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
                <span>{{ transWord('منتجاتنا') }}</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <main id="app">





        <section class="products-page mr-section">
            <div class="main-container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="filter-products">
                            <div class="sub-filter-products">
                                <div class="title-filter">
                                    <h2>{{ transWord('كل الاقسام') }}</h2>
                                </div>
                                <ul class="categories-a-filter">
                                    @forelse ($categories as $category)
                                        <li>
                                            <div class="input-radio">
                                                <input type="radio" id="categories-{{ $category->id }}" name="categories">
                                                <label for="categories-1"> <img src="{{ $category->image_path }}"
                                                        alt="">
                                                    {{ $category->name }}
                                                    <span> ( {{ $category->products_count }} ) </span> </label>
                                            </div>
                                        </li>
                                    @empty
                                        <li>
                                            {{ transWord('لا يوجد اقسام') }}
                                        </li>
                                    @endforelse


                                </ul>
                            </div>
                            <div class="sub-filter-products">
                                <div class="title-filter">
                                    <h2>{{ transWord('مادة التصنيع') }}</h2>
                                </div>
                                <ul class="check-filter">
                                    @forelse ($brands as $brand)
                                        <li class="input-check">
                                            <input type="checkbox" id="check1-{{ $brand->id }}" name="check-product"
                                                value="{{ $brand->name }}">
                                            <label for="check1-{{ $brand->id }}"> {{ $brand->name }} </label>
                                        </li>
                                    @empty
                                        <li>
                                            {{ transWord('لا يوجد مواد تصنيع') }}
                                        </li>
                                    @endforelse

                                </ul>
                            </div>
                            <div class="sub-filter-products">
                                <div class="title-filter">
                                    <h2>{{ transWord('السعر') }}</h2>
                                </div>
                                <div class="range_slider">
                                    <input type="text" class="js-range-slider" name="my_range" value=""
                                        data-skin="round" data-type="double" data-min="100" data-max="1000"
                                        data-grid="false" />
                                    <div class="number_range_slider">
                                        <input type="number" maxlength="10" value="100" class="from" />
                                        <input type="number" maxlength="10" value="1000" class="to" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="main-product-page">
                            <div class="select-product-page">
                                <h3>{{ transWord('رتب حسب :') }}</h3>
                                <div class="input-form arrow-select">
                                    <select class="form-select form-control " name="category">
                                        <option value="all"> {{ transWord('الكل') }}</option>
                                        <option value="latest"> {{ transWord('الاحدث') }} </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row row-gap">
                                @forelse ($products as $product)
                                    <div class="col-lg-6">
                                        <div class="sub-product">
                                            <a href="{{ route('site.products.show', $product->id) }}">
                                                <div class="img-sub-product">
                                                    <img src="{{ $product->image_path }}" alt="">
                                                </div>

                                                <div class="text-sub-product">
                                                    <h2>{{ $product->name }}</h2>
                                                    <p>{{ $product->sub_title }}</p>
                                                    <div class="product-price">
                                                        <h3>{{ $product->price }} EGP </h3>
                                                        {{-- <h4> {{ $product->price_after_discount }} EGP </h4> --}}
                                                        {{-- <h4> {{ $product->price_after_discount ?? $product->price }} EGP </h4> --}}
                                                        <h4> {{ $product->price_after_discount ?? 0 }} EGP </h4>
                                                        <div class="offer-price"> {{ $product->discount ?? 0 }}% OFF</div>
                                                    </div>
                                                </div>
                                                <div style="background-color: {{ $product->label_color }}"
                                                    class="discount sub-tools"> {{ $product->label }} </div>
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
                                                            stroke-miterlimit="10" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-lg-12">
                                        <div class="sub-product">
                                            <h2>{{ transWord('لا يوجد منتجات') }}</h2>
                                        </div>
                                    </div>
                                @endforelse

                                {{-- <div class="col-lg-12">

                                    {{ $products->links('site.pagination.custom') }}

                                </div> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>











    </main>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script src="{{ asset('site/js/range_slider.js') }}"></script>
@endpush
