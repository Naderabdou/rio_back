@extends('dashboard.layouts.app')

@section('title', transWord('إضافة خصم جديد'))

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
                                            href="{{ route('admin.coupons.index') }}">{{ transWord('اكواد الخصم') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('إضافة كود خصم جديد') }}</a>
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
                                <div class="card-header">
                                    <h2 class="card-title">{{ transWord('إضافة كود خسم  جديد') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" action="{{ route('admin.coupons.store') }}"
                                        method="POST" id="createCouponsForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="code">{{ transWord('كود الخصم') }}</label>
                                                    <input type="text" id="code" class="form-control" name="code"
                                                        value="{{ old('code') }}" />
                                                    @error('code')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="value">{{ transWord('الخصم') }}</label>
                                                    <input type="text" id="value" class="form-control" name="value"
                                                        value="{{ old('value') }}" />
                                                    @error('value')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="type">{{ transWord('نوع الخصم') }}</label>
                                                    <select class=" form-control select2" id="type" name="type">
                                                        <option value="">{{ transWord('اختر نوع الخصم') }}</option>

                                                        <option value="fixed"
                                                            @if (old('type') == 'fixed') selected @endif>
                                                            {{ transWord('ثابت') }}</option>
                                                        <option value="percentage"
                                                            @if (old('type') == 'percentage') selected @endif>
                                                            {{ transWord('نسبة') }}</option>
                                                    </select>
                                                    @error('type')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary mr-1">{{ transWord('save') }}</button>
                                            </div>
                                        </div>
                                    </form>
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

        <script src="{{ asset('dashboard/assets/js/custom/validation/coupons.js') }}"></script>
        <script>
            window.coupons = "{{ route('admin.check.codeCoupons') }}";
        </script>
    @endpush
@endsection
