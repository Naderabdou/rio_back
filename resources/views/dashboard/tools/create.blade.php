@extends('dashboard.layouts.app')

@section('title', transWord('إضافة مقدمة جديدة'))

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
                                            href="{{ route('admin.banners.index') }}">{{ transWord('المقدمة') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('إضافة مقدمة جديدة') }}</a>
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
                                    <h2 class="card-title">{{ transWord('إضافة مقدمة جديدة') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="createForm"
                                        action="{{ route('admin.banners.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name_ar">{{ transWord('العنوان بالعربية') }}</label>
                                                    <input type="text" id="name_ar" class="form-control" name="name_ar"
                                                        value="{{ old('name_ar') }}" />
                                                    @error('name_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name_en">{{ transWord('العنوان بالإنجليزية') }}</label>
                                                    <input type="text" id="name_en" class="form-control" name="name_en"
                                                        value="{{ old('name_en') }}" />
                                                    @error('name_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="formFile"
                                                        class="form-label">{{ transWord('الصورة') }}</label>
                                                    <input class="form-control image" type="file" id="formFile"
                                                        name="image" accept=".png, .jpg, .jpeg" required>
                                                    @error('image')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group prev">
                                                    <img src="" style="width: 100px"
                                                        class="img-thumbnail preview-formFile" alt="">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="position">{{ transWord('الموقع') }}</label>
                                                    <select name="position" id="position" class="form-control" required>
                                                        <option value="">{{ transWord('اختر') }}</option>
                                                        <option value="solutions">{{ transWord('رتام للحلول') }}</option>
                                                        <option value="supply">{{ transWord('رتام للتوريد') }}</option>
                                                    </select>
                                                    @error('position')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6" id="desc_ar">
                                                <div class="form-group">
                                                    <label for="desc_ar">{{ transWord('المحتوى بالعربية') }}</label>
                                                    <textarea class="form-control tinyEditor" name="desc_ar" rows="10">{{ old('desc_ar') }}</textarea>
                                                    @error('desc_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6" id="desc_en">
                                                <div class="form-group">
                                                    <label for="desc_en">{{ transWord('المحتوى بالإنجليزية') }}</label>
                                                    <textarea class="form-control tinyEditor" name="desc_en" rows="10">{{ old('desc_en') }}</textarea>
                                                    @error('desc_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12" id="sector_id">
                                                <div class="form-group">
                                                    <label for="sector_id">{{ transWord('القطاعات') }}</label>
                                                    <select name="sector_id" class="form-control">
                                                        <option value="">{{ transWord('اختر') }}</option>
                                                        @foreach ($sectors as $sector)
                                                            <option value="{{ $sector->id }}">{{ $sector->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('sector_id')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12" id="product_id">
                                                <div class="form-group">
                                                    <label for="product_id">{{ transWord('المنتجات') }}</label>
                                                    <select name="product_id" class="form-control">
                                                        <option value="">{{ transWord('اختر') }}</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('product_id')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary mr-1">{{ transWord('حفظ') }}</button>
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
        {{-- <script src="{{ asset('dashboard/assets/js/custom/validation/articleForm.js') }}"></script> --}}
        <script src="{{ asset('dashboard/app-assets/js/custom/preview-image.js') }}"></script>

        <script>
            $('#sector_id').hide();
            $('#product_id').hide();
            $('#desc_ar').hide();
            $('#desc_en').hide();

            $('#position').change(function(e) {
                e.preventDefault();

                let val = $(this).find(":selected").val();

                if (val === 'solutions') {
                    $('#sector_id').show();
                    $('#desc_ar').show();
                    $('#desc_en').show();
                    $('#product_id').hide();
                } else if (val === 'supply') {
                    $('#product_id').show();
                    $('#sector_id').hide();
                    $('#desc_ar').hide();
                    $('#desc_en').hide();
                } else {
                    $('#sector_id').hide();
                    $('#product_id').hide();
                    $('#desc_ar').hide();
                    $('#desc_en').hide();
                }

            });
        </script>
    @endpush
@endsection
