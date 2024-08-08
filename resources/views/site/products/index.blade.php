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

                    @include('site.products.filterTypes')

                    <div class="col-lg-8">
                        <div class="main-product-page">
                            <div class="select-product-page">
                                <h3>{{ transWord('رتب حسب :') }}</h3>
                                <div class="input-form arrow-select">
                                    <select class="form-select form-control filter" name="arrane" id="arrange">
                                        <option value="all"> {{ transWord('الكل') }}</option>
                                        <option value="latest"> {{ transWord('الاحدث') }} </option>
                                        <option value="high_low"> {{ transWord('الاعلى سعرا') }} </option>
                                        <option value="low_high"> {{ transWord('الاقل سعرا') }} </option>
                                    </select>
                                </div>
                            </div>

                            <div id="filter-result">
                                <div class="list row row-gap">
                                    @forelse ($products as $product)
                                        <div class="col-lg-6">
                                            <div class="sub-product">
                                                <a href="{{ route('site.products.show', $product->id) }}">
                                                    <div class="img-sub-product">
                                                        <img src="{{ $product->image_path }}" alt="">
                                                    </div>

                                                    <div class="text-sub-product">
                                                        <h2 class="product_name">{{ $product->name }}</h2>
                                                        <p>{{ $product->sub_title }}</p>

                                                        @php
                                                            $isMerchant =
                                                                auth()->check() && auth()->user()->hasRole('merchant'); // Assuming hasRole() is a method you've defined or comes from a package like Spatie's Laravel Permission.
                                                            $displayPrice = $isMerchant
                                                                ? $product->list_price
                                                                : $product->total_price;
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
                                                            <p>هذا السعر للكرتونة</p>
                                                        @endif
                                                    </div>


                                                    <div style="background-color: {{ $product->label_color }}"
                                                        class="discount sub-tools"> {{ $product->label }} </div>
                                                </a>
                                                <div class="btns-product">
                                                    {{-- share --}}



                                                    <div class="shareLinks-{{ $product->id }}  main-share-links"
                                                        style="display: none;">
                                                        {!! Share::page(route('site.products.show', $product->id))->facebook()->twitter()->linkedin()->whatsapp()->telegram() !!}
                                                    </div>
                                                    {{-- end share --}}



                                                    <a href="{{ route('site.products.show', $product->id) }}"
                                                        class="ctm-btn3 w-100">{{ transWord('مشاهدة المنتج') }}</a>
                                                    <a href="{{ route('site.cart.store') }}" data-id="{{ $product->id }}"
                                                        class="{{ auth()->user() ? 'btn-cart' : 'auth_login btn-cart' }}">

                                                        <svg width="32" height="33" viewBox="0 0 32 33"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                                    <a class="btn_share" data-id="{{ $product->id }}"
                                                        href="javascript:void(0);"> <i class="bi bi-share"></i></a>
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
                                </div>
                                @if ($products->count() > 0)
                                    <ul class="pagination custom-pagination"></ul>
                                @endif
                                {{-- <div class="col-lg-12">
                                {{ $products->links('site.pagination.custom') }}.

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
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script src="{{ asset('site/js/range_slider.js') }}"></script>
    <script>
        $(document).ready(function() {
            //     function toggleShareLinks() {
            //     $('#shareLinks').toggle();
            // }
            $(document).on('click', '.btn_share', function() {
                var id = $(this).data('id');
                $('.shareLinks-' + id).toggle();
            })
            $(document).ready(function() {
            function handleFilter() {
                // Hide the button
                        $('#filter-result').hide();

                        // Add a spinner
                        $('#filter-result').parent().append(
                            `<div class="spinner" style="display: flex; justify-content: center; align-items: center; position: relative; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.5); z-index: 1050;">
                                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>`
                        );

                // Get filter values
                var category = $('.category_filter:checked').data('category-id');
                var min_num = $('#min_num_filter').val();
                var max_num = $('#max_num_filter').val();
                var arrange = $('#arrange').val();

                console.log(category);
                console.log(min_num);
                console.log(max_num);

                // Perform the AJAX request
                $.ajax({
                    url: "{{ route('site.products.filter') }}",
                    type: 'GET',
                    data: {
                        category: category,
                        min_num: min_num,
                        max_num: max_num,
                        arrange: arrange
                    },
                    success: function(data) {
                        $('#filter-result').show();

                        // Remove the spinner
                        $('#filter-result').next('.spinner').remove();
                        $('#filter-result').html(data);

                        if ($('.not_product').length > 0) {
                            $('.pagination').hide(); // Optionally, hide pagination as well
                        } else {
                            initializeListJS();
                        }
                    }
                });
            }

            // Attach event handlers
            $('.filter-button').click(handleFilter);
            $('.filter').on('input', handleFilter);
        });
                });

                function initializeListJS() {
                    var options = {
                        valueNames: ['product_name'],
                        page: 4,
                        pagination: true
                    };
                    var addressList = new List('filter-result', options);
                }

                // Initialize List.js on page load
                initializeListJS();
    </script>

    {{-- <script>
        $(document).on('change','#arrange', function() {
            var arrange = $(this).val();
            $.ajax({
                url: "{{ route('site.products.arrange') }}",
                type: 'GET',
                data: {
                    arrange: arrange
                },
                success: function(data) {
                    $('#filter-result').html(data);
                    //remove data that checked
                    $('.category_filter').prop('checked', false);
                    $('.brand_filter').prop('checked', false);
                }
            });
        });
    </script> --}}
@endpush
