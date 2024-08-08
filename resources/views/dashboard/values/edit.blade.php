@extends('dashboard.layouts.app')

@section('title', transWord('خصائص المنتج'))

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
                                            href="{{ route('admin.ourValues.index') }}">{{ transWord('خصائص المنتج') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('تعديل خصائص المنتج') }}</a>
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
                                    <h2 class="card-title">{{ transWord('تعديل خصائص المنتج ') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical"
                                        action="{{ route('admin.ourValues.update', $OurValue->id) }}" method="POST"
                                        id="UpdateOurValuesForm" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="id" id="id" value="{{ $OurValue->id }}">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="product_id">{{ transWord('المنتجات') }}</label>
                                                    <select class="form-control select_2" name="product_id" id="product_id"
                                                        required>
                                                        <option value="">{{ transWord('اختر') }}
                                                        </option>
                                                        @foreach ($products as $product)
                                                            <option
                                                                {{ old('product_id',$OurValue->product_id) == $product->id ? 'selected' : '' }}
                                                                value="{{ $product->id }}">{{ $product->name }}
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
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="title_ar">{{ transWord('الأسم بالعربية') }}</label>
                                                    <input type="text" id="title_ar" class="form-control"
                                                        name="title_ar"
                                                        value="{{ old('title_ar', $OurValue->title_ar) }}" />
                                                    @error('title_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="title_en">{{ transWord('الأسم بالإنجليزية') }}</label>
                                                    <input type="text" id="title_en" class="form-control"
                                                        name="title_en"
                                                        value="{{ old('title_en', $OurValue->title_en) }}" />
                                                    @error('title_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="formFile"
                                                        class="form-label">{{ transWord('الصورة') }}</label>
                                                    <input class="form-control image" type="file" id="formFile"
                                                        name="icon" accept=".png, .jpg, .jpeg">
                                                    @error('icon')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group prev">
                                                    <img src="{{ $OurValue->icon_path }}" style="width: 100px"
                                                        class="img-thumbnail preview-formFile" alt="">
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

        <script src="{{ asset('dashboard/assets/js/custom/validation/ourValuesForm.js') }}"></script>
        <script>
            window.UrlValue = "{{ route('admin.check.valueName') }}";
        </script>
    @endpush
@endsection
