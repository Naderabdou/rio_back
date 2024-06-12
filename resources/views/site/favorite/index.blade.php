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
                                            <div class="main-product-cart">
                                                <div class="delete-cart">
                                                    <button> <i class="bi bi-trash"></i></button>
                                                </div>
                                                <div class="sub-product-cart">
                                                    <div class="img-product-cart">
                                                        <img src="images/p1.png" alt="">
                                                    </div>
                                                    <h3> زجاجة مياه رياضية </h3>
                                                </div>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="product-price">
                                                <h3>EGP 175 </h3>
                                                <h4> EGP 200 </h4>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="btn-favorite">
                                                <a href="" class="ctm-btn2"> <img
                                                        src="images/icon/shopping-cart-b.svg" alt=""> اضف للسلة </a>
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























    </main>
@endsection
