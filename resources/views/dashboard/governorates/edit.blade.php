@extends('dashboard.layouts.app')

@section('title', transWord('تعديل سعر الشحن '))
@push('css')
    <style>
        .main-add-address {
            text-align: center;
            padding: 35px 35px;
        }

        .main-add-address .arrow-select::after {
            content: "";
            width: 21px;
            height: 23px;
            background-image: url(../images/arrow-down.png);
            background-size: contain;
            position: absolute;
            background-repeat: no-repeat;
            background-position: center;
            top: 20px;
            left: 27px;
        }

        .main-add-address .form-select {
            color: var(--color-gray) !important;
        }

        .main-add-address {
            width: 80%;
        }

        .ctm-btn {
            height: 50px;
            padding: 11px 35px;
            display: inline-block;
            background-color: var(--color-Primary1);
            border-radius: 30px;
            min-width: 160px;
            border: none;
            text-align: center;
            color: var(--color-white);
            font-family: "font_medium";
            transition: all 0.3s linear;
        }

        .ctm-btn:hover {
            color: var(--color-white);
            background-color: var(--color-Primary2);
        }

        .form-my-account .input-form {
            width: calc(100% / 2 - 10px);
        }
    </style>
@endpush
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.governorates.index') }}">{{ transWord('المحافظات') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('تعديل علي المحافظات') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="main-add-address m-auto">
                                    <div class="img-add-address">
                                        <img src="{{ asset('site/images/address.png') }}"
                                            alt="">
                                    </div>
                                    <div class="title-center mb-5">
                                        <h2>{{ transWord('اضافه سعر الشحن') }}</h2>
                                    </div>
                                    <div class="card-body">
                                        <form
                                            action="{{ route('admin.governorates.update', $governorate->id) }}"
                                            method="POST" id="governorates_update"
                                            data-id="{{ $governorate->id }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="name_ar">{{ transWord('الأسم بالعربية') }}</label>
                                                        <input type="text" id="name_ar"
                                                            class="form-control" name="name_ar"
                                                            value="{{ $governorate->name_ar }}" /
                                                            readonly>
                                                        <div style="color: red" id="name_ar_error"
                                                            class="error-message"></div>

                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="name_en">{{ transWord('الأسم بالإنجليزية') }}</label>
                                                        <input type="text" id="name_en"
                                                            class="form-control" name="name_en"
                                                            value="{{ $governorate->name_en }}" /
                                                            readonly>
                                                        <div style="color: red" id="name_en_error"
                                                            class="error-message"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="tax">{{ transWord('سعر الشحن') }}</label>
                                                        <input type="text" id="tax"
                                                            class="form-control" name="tax"
                                                            value="{{ old('tax') }}" />
                                                        <div style="color: red" id="tax_error"
                                                            class="error-message"></div>
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <button type="submit"
                                                        class="btn btn-primary mr-1 btn_gover">{{ transWord('save') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @push('js')

    <script src="{{ asset('dashboard/app-assets/js/custom/preview-image.js') }}"></script>

    <script src="{{ asset('dashboard/assets/js/custom/validation/governorates.js') }}"></script>
    @endpush
@endsection
