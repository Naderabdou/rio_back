@extends('dashboard.layouts.app')

@section('title', transWord('تعديل الشركاء'))

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}">
                                            {{ transWord('الشركاء') }} </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('تعديل الشركاء ') }}</a>
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
                                    <h2 class="card-title">{{ transWord('تعديل الشركاء ') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="UpdateOurValuesForm"
                                        action="{{ route('admin.partners.update', $partner->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="row">



                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="formFile"
                                                        class="form-label">{{ transWord('الصوره') }}</label>
                                                    <input class="form-control image" type="file" id="formFile"
                                                        name="image" accept=".jpg,.jpeg,.png">
                                                    @error('image')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group prev">
                                                    <img src="{{ $partner->image_path }}" style="width: 100px"
                                                        class="img-thumbnail preview-formFile" alt="">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="name_en">{{ transWord('اللينك') }}</label>
                                                    <input type="text" id="name_en" class="form-control" name="link"
                                                        required value="{{ old('link', $partner->link) }}" />
                                                    @error('link')
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
        <script src="{{ asset('dashboard/assets/js/custom/validation/ourValuesForm.js') }}"></script>


        <script>
            $('.select2').select2({
                dir: "rtl",
                language: "ar",
                placeholder: "اختر قسم الخدمه",
                allowClear: true,
                width: '100%'
            });

            $(document).on('click', '.remove-btn', function(e) {
                e.preventDefault();
                $(this).closest('.row').remove();
            });

            $('.add-btn').click(function(e) {
                e.preventDefault();
                var content = `<div class="row my-2">
                                    <div class="col-md-8">
                                        <input type="text" name="keywords[]"
                                            class="form-control"
                                            value="">
                                    </div>
                                    <div class="col-md-4">
                                        <a class="btn btn-danger remove-btn">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </div>`;
                $(this).parent().prepend(content);
            });
        </script>
    @endpush
@endsection
