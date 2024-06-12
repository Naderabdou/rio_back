@extends('dashboard.layouts.app')

@section('title', transWord('اضافه الشركاء'))

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}"> {{ transWord('الشركاء') }} </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('اضافة الشركاء ') }}</a>
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
                                    <h2 class="card-title">{{ transWord('اضافة الشركاء') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="createOurValuesForm"
                                        action="{{ route('admin.partners.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">



                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="image" class="form-label">{{ transWord('الصوره') }}</label>
                                                    <input class="form-control image" type="file" id="image"
                                                           name="image"  accept=".jpg,.jpeg,.png , .svg">
                                                    @error('image')
                                                    <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group prev">
                                                    <img src="" style="width: 100px"
                                                         class="img-thumbnail preview-image" alt="">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="link">{{ transWord('اللينك') }}</label>
                                                    <input type="url" id="link" class="form-control" name="link"
                                                           value="{{ old('link') }}" />
                                                    @error('link')
                                                    <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>




                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1">{{ transWord('save') }}</button>
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




    @endpush
@endsection
