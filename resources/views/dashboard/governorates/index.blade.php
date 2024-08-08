@extends('dashboard.layouts.app')

@section('title', transWord('المحافظات'))
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
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                    href="{{ route('admin.brands.create') }}"><i class="mr-1"
                                        data-feather="circle"></i><span
                                        class="align-middle">{{ transWord('اضافه ماده تصنيع جديدة') }}
                                    </span></a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ transWord('الاسم') }}</th>
                                            <th>{{ transWord('سعر التوصيل') }}</th>

                                            <th>{{ transWord('الإجراءات') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($governorates as $governorate)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ $governorate->name }}</td>
                                                <td>{{ $governorate->tax }}</td>



                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.governorates.edit', $governorate->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="{{ route('admin.governorates.destroy', $governorate->id) }}"
                                                            data-id="{{ $governorate->id }}"
                                                            class="btn btn-sm btn-danger item-delete"><i
                                                                class="fa-solid fa-trash-can"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            {{-- <div class="modal fade governorate-modal-update-{{ $governorate->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">

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
                                                                    method="POST" class="governorates_update"
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
                                                                                @error('name_ar')
                                                                                    <span class="alert alert-danger">
                                                                                        <small
                                                                                            class="errorTxt">{{ $message }}</small>
                                                                                    </span>
                                                                                @enderror
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
                                                                                @error('name_en')
                                                                                    <span class="alert alert-danger">
                                                                                        <small
                                                                                            class="errorTxt">{{ $message }}</small>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="tax">{{ transWord('سعر الشحن') }}</label>
                                                                                <input type="text" id="tax"
                                                                                    class="form-control" name="tax"
                                                                                    value="{{ old('tax') }}" />
                                                                                @error('tax')
                                                                                    <span class="alert alert-danger">
                                                                                        <small
                                                                                            class="errorTxt">{{ $message }}</small>
                                                                                    </span>
                                                                                @enderror
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
                                            </div> --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Basic table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @push('js')
        {{-- <script>
            $(document).ready(function() {
                $(".governorates_update").validate({
                    // initialize the plugin

                    rules: {
                        name_ar: {
                            required: true,
                            minlength: 3,
                            maxlength: 255,


                        },
                        name_en: {
                            required: true,
                            minlength: 3,
                            maxlength: 255,

                        },
                        tax: {
                            required: true,
                            number: true,
                        },

                    },


                    errorElement: "span",
                    errorLabelContainer: ".errorTxt",

                    submitHandler: function(form) {
                        form.submit();
                    },
                });





            });
        </script> --}}
        <script src="{{ asset('dashboard/app-assets/js/custom/custom-delete.js') }}"></script>
        {{-- <script src="{{ asset('dashboard/assets/js/custom/validation/governorates.js') }}"></script> --}}
    @endpush
@endsection
