@extends('site.layouts.app')
@section('title', transWord('Home'))

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
                    <h2>{{ transWord('عربة التسوق') }}</h2>

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
                                            <div class="main-product-cart" id="product-cart-{{$favorite->id  }}">
                                                <div class="delete-cart">
                                                    <form action="{{route('site.favorite.destroy' , $favorite->id ) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="delete-fav" data-url=""> <i class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                                <div class="sub-product-cart">
                                                    <div class="img-product-cart">
                                                        <img src="{{  $favorite->imagePath  }} alt="">
                                                    </div>
                                                    <h3> {{  $favorite->name }}</h3>
                                                </div>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="product-price">

                                                <h3>EGP {{ $favorite->price }} </h3>

                                                <h4>EGP {{ $favorite->price_after_discount }} </h4>


                                            </div>
                                        </td>

                                        <td>
                                            <div class="btn-favorite">
                                                <a href="" class="ctm-btn2"> <img
                                                    src="{{ asset('site/images/icon/shopping-cart-b.svg') }}" alt=""> {{ transWord('اضف للسلة ') }}</a>
                                                    <a href="" class="btn-share-favorite"> <i class="bi bi-share"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
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











 (@session('success'))
        @push('js')
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });

            </script>
        @endpush

    @endsession




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
