@extends('dashboard.layouts.app')

@section('title', transWord('تعديل الاعلان '))

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
                                            href="{{ route('admin.banners.index') }}">{{ transWord(' الاعلانات') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('تعديل الاعلان ') }}</a>
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
                                    <h2 class="card-title">{{ transWord('تعديل الاعلان ') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical"
                                        action="{{ route('admin.banners.update', $banner->id) }}" method="POST"
                                        id="UpdateBannersForm" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="product_id">{{ transWord('المنتجات') }}</label>
                                                    <select class="form-control select_2" name="product_id" id="product_id"
                                                        required>
                                                        <option value="">{{ transWord('اختر') }}
                                                        </option>
                                                        @foreach ($products as $product)
                                                            <option
                                                                {{ old('product_id',$banner->product_id) == $product->id ? 'selected' : '' }}
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
                                                        name="title_ar" value="{{ old('title_ar', $banner->title_ar) }}" />
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
                                                        name="title_en" value="{{ old('title_en', $banner->title_en) }}" />
                                                    @error('title_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="sub_title_ar">{{ transWord('العنوان بالعربية') }}</label>
                                                    <input type="text" id="sub_title_ar" class="form-control"
                                                        name="sub_title_ar"
                                                        value="{{ old('sub_title_ar', $banner->sub_title_ar) }}" />
                                                    @error('sub_title_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label
                                                        for="sub_title_en">{{ transWord('العنوان بالإنجليزية') }}</label>
                                                    <input type="text" id="sub_title_en" class="form-control"
                                                        name="sub_title_en"
                                                        value="{{ old('sub_title_en', $banner->sub_title_en) }}" />
                                                    @error('sub_title_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="color_title">{{ transWord('لون الأسم ') }}</label>
                                                    <input type="color" id="color_title" class="form-control"
                                                        name="color_title"
                                                        value="{{ old('color_title', $banner->color['color_title']) }}" />
                                                    @error('color_title')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="color_btn">{{ transWord('لون الزر ') }}</label>
                                                    <input type="color" id="color_btn" class="form-control"
                                                        name="color_btn"
                                                        value="{{ old('color_btn', $banner->color['color_btn']) }}" />
                                                    @error('color_btn')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="color_ground">{{ transWord('لون الخلفية ') }}</label>
                                                    <input type="color" id="color_ground" class="form-control"
                                                        name="color_ground"
                                                        value="{{ old('color_ground', $banner->color['color_ground']) }}" />
                                                    @error('color_ground')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="formFile"
                                                        class="form-label">{{ transWord('الصوره') }}</label>
                                                    <input class="form-control image" type="file" id="formFile"
                                                        name="image" accept=".png, .jpg, .jpeg">
                                                    @error('image')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group prev">
                                                    <img src="{{ $banner->image_path }}" style="width: 100px"
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

        <script src="{{ asset('dashboard/assets/js/custom/validation/bannersForm.js') }}"></script>
    @endpush
@endsection
