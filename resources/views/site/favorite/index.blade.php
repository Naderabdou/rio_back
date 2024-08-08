@extends('site.layouts.app')
@section('title', transWord('المفضلة'))

@title(getSetting('seo_title', app()->getLocale()))
@description(Str::limit(getSetting('desc_seo', app()->getLocale()), 160))
@keywords(implode(',', json_decode(getSetting('keyword', app()->getLocale()))))
@image(asset('storage/' . getSetting('logo')))
@section('sub-header')
    <div class="title-page">
        <div class="main-container">
            <h2>{{ transWord('المفضلة') }}</h2>
            <div class="breadcrumb-header">
                <a href="{{ route('site.home') }}"> {{ transWord('الرئيسية') }} </a> <img
                    src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
                <span>{{ transWord('المفضلة') }}</span>

            </div>
        </div>
    </div>
@endsection
@section('content')
    <main id="app">

        <section class="favorite mr-section">
            <div class="main-container">
                <div class="product-cart-page">
                    <h2>{{ transWord('المفضلة') }}</h2>

                    <div class="table-cart-page">
                        <table class="table">
                            @if ($favorites->count() > 0)
                                <thead class="thead-light">

                                    <tr>
                                        <th scope="col">{{ transWord('المنتج') }}</th>
                                        <th scope="col">{{ transWord('السعر') }}</th>
                                        <th scope="col">{{ transWord('اجراء') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($favorites as $favorite)
                                        <tr>
                                            <th>
                                                <div class="main-product-cart"
                                                    id="product-cart-{{ $favorite->product->id }}">
                                                    <div class="delete-cart">
                                                        <form
                                                            action="{{ route('site.favorite.destroy', $favorite->product->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="delete-fav" data-url=""> <i
                                                                    class="bi bi-trash"></i></button>
                                                        </form>
                                                    </div>
                                                    <div class="sub-product-cart">
                                                        <div class="img-product-cart">
                                                            <img src="{{ $favorite->product->image_path }}" alt="">
                                                        </div>
                                                        <h3> {{ $favorite->product->name }}</h3>
                                                    </div>
                                                </div>
                                            </th>
                                            <td>
                                                @php
                                                    $isMerchant =
                                                        auth()->check() && auth()->user()->hasRole('merchant'); // Assuming hasRole() is a method you've defined or comes from a package like Spatie's Laravel Permission.
                                                    $displayPrice = $isMerchant
                                                        ? $favorite->product->list_price
                                                        : $favorite->product->total_price;
                                                    $currency = transWord('جنية');
                                                @endphp
                                                <div class="product-price">
                                                    <h3>{{ $displayPrice }} {{ $currency }}</h3>
                                                    @if (!$isMerchant && $favorite->product->discount)
                                                        <h4>{{ $favorite->product->price }} {{ $currency }}</h4>
                                                        <div class="offer-price">{{ $favorite->product->discount }}
                                                            {{ transWord('ج.م') }}</div>
                                                    @endif
                                                </div>
                                            </td>

                                            <td>
                                                <div class="btn-favorite">

                                                    <a href="{{ route('site.cart.store') }}" class="ctm-btn2" data-id="{{$favorite->product->id  }}">
                                                        <img
                                                            src="{{ asset('site/images/icon/shopping-cart-b.svg') }}"
                                                            alt=""> {{ transWord('اضف للسلة ') }}</a>

                                                    <a id="share-modal" href="" data-toggle="modal"
                                                        class="btn-share-favorite" data-target=".share-modal"
                                                        data-dismiss="modal">
                                                        <i class="bi bi-share"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade share-modal" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-fotm-aosh">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true"> <i class="bi bi-x-circle"></i></span>
                                                        </button>
                                                        <div class="logo-aosh">
                                                            <a href="{{ route('site.home') }}">
                                                                <object data="{{ asset('site/images/logo.svg') }}"
                                                                    type="">
                                                                    <img src="{{ asset('site/images/logo.svg') }}"
                                                                        alt="">
                                                                </object>
                                                            </a>
                                                        </div>





                                                        <div class="form-aosh">

                                                            {!! Share::page(route('site.products.show', $favorite->product->id), $favorite->product->name)->facebook()->twitter()->linkedin()->whatsapp()->telegram() !!}

                                                        </div>




                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </tbody>
                            @else
                                <div class="alert alert-warning" role="alert">
                                    {{ transWord('لا يوجد منتجات في المفضلة') }}
                                </div>
                            @endif
                        </table>

                    </div>

                </div>
            </div>
        </section>









            @push('js')
                <script>
                    $(document).ready(function() {
                        $(document).on('click', '.btn-share-favorite', function(e) {
                            e.preventDefault(); // Prevent the default link action

                            // Assuming you have a data attribute 'data-product-link' for the product link
                            var productLink = $(this).href;

                            // Create a temporary input
                            var tempInput = $("<input>");
                            $("body").append(tempInput);
                            tempInput.val(productLink).select();
                            document.execCommand("copy");
                            tempInput.remove(); // Remove the temporary input

                            // Notify the user
                           
                        });

                        $(document).on('click', '.ctm-btn2', function(e) {
                            e.preventDefault();
                            var id = $(this).data('id');
                            var url = $(this).attr('href');


                            $.ajax({
                                url: url,
                                type: 'GET',
                                data: {
                                    id: id,

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
                    });
                </script>
            @endpush





        {{-- @push('js')
            <script>
             $(document).on('click', '.delete-cart', function(e) {
    e.preventDefault();
    var url = $('.delete-fav').data('url');
        console.log(url);
    // $(".delete-cart").click(function (e) {
    // });
    $.ajax({
        url: url,
        type: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(data) {
            if (data.status == true) {
                // $('#product-cart-' + id).remove();
                //show message
                $(this).parents("tr").remove();

                var message = '{{ transWord('تم الحذف بنجاح') }}';
                alert(message);
            }
        }
    });
});

            </script>

        @endpush --}}








    </main>
@endsection
