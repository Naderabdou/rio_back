@extends('dashboard.layouts.app')

@section('title', transWord('تعديل الاسليدر '))

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
                                            href="{{ route('admin.sliders.index') }}">{{ transWord(' الاسليدر') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                            href="#">{{ transWord('تعديل صوره الاسليدر ') }}</a>
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

                                    <h2 class="card-title">{{ transWord('تعديل الاسليدر') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical"
                                        action="{{ route('admin.sliders.update', $slider->id) }}" method="POST"
                                        id="UpdateSliderForm" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="type">{{ transWord('نوع الاسليدر ') }}</label>
                                                    <select class=" form-control select2" id="type" name="type">
                                                        <option value="">{{ transWord('اختر') }}</option>
                                                        <option value="video"
                                                            @if (old('type', $slider->type) == 'video') selected @endif>
                                                            {{ transWord('video') }}</option>
                                                        <option value="image"
                                                            @if (old('type', $slider->type) == 'image') selected @endif>
                                                            {{ transWord('image') }}</option>
                                                    </select>
                                                    @error('type')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div id="image"
                                                style="display: {{ old('type', $slider->type) == 'image' ? 'block' : 'none' }}"
                                                class="col-12">
                                                <div class="form-group">
                                                    <label for="image"
                                                        class="form-label">{{ transWord('الصورة') }}</label>
                                                    <input class="form-control image" type="file" id="image"
                                                        name="image" accept=".png, .jpg, .jpeg .svg">
                                                    @error('image')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group prev">
                                                    <img src="{{ $slider->image_path }}" style="width: 100px"
                                                        class="img-thumbnail preview-image" alt="">
                                                </div>
                                            </div>
                                            <div id="video_image"
                                            style="display: {{ old('type',$slider->type) == 'video' ? 'block' : 'none' }}"
                                            class="col-12">
                                            <div class="form-group">
                                                <label for="image_video"
                                                    class="form-label">{{ transWord('صور خلفيه الفيديو') }}</label>
                                                <input class="form-control image" type="file" id="image_video"
                                                    name="image_video" accept=".png, .jpg, .jpeg .svg">
                                                @error('image_video')
                                                    <span class="alert alert-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group prev">
                                                <img src="{{ $slider->image_video_path }}" style="width: 100px"
                                                    class="img-thumbnail preview-image" alt="">
                                            </div>
                                        </div>

                                            <div id="video"
                                                style="display: {{ old('type', $slider->type) == 'video' ? 'block' : 'none' }}"
                                                class="col-12">
                                                <div class="form-group">
                                                    <label for="video"
                                                        class="form-label">{{ transWord('الفيديو') }}</label>
                                                    <input class="form-control video" type="file" id="video"
                                                        name="video" accept=".mp4">
                                                    @error('video')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group prev">
                                                    <video src="{{ $slider->video_path }}" height="10%"
                                                        style="width: 100%; " controls class="img-thumbnail">
                                                    </video>
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
        <script>
            $(document).ready(function() {
                $.validator.addMethod('filesize', function(value, element, param) {
                    return this.optional(element) || (element.files[0].size <= param)
                }, window.filesize);
                $('#type').on('change', function() {
                    var type = $(this).val();
                    if (type == 'image') {
                        $('#image').show();
                        $('#video').hide();
                        $('#video_image').hide();
                    } else if (type == 'video') {
                        $('#video').show();
                        $('#image').hide();
                        $('#video_image').show();
                    } else {
                        $('#video').hide();
                        $('#image').hide();
                        $('#video_image').hide();
                    }
                });



                $("#UpdateSliderForm").validate({
                    // initialize the plugin

                    rules: {

                        type: {
                            required: true,
                        },

                        image: {
                            // required: true,
                            accept: "image/png, image/jpeg, image/svg+xml",
                            filesize: 1048576
                        },
                        video: {
                            // required: true,
                            accept: "video/mp4",
                            filesize: 3145728

                        },
                        image_video: {
                            accept: "image/png, image/jpeg, image/svg+xml",
                            filesize: 1048576
                        },


                    },
                    messages: {
                        image: {
                            accept: window.avatarMessage
                        },
                        video: {
                            accept: window.videoMessage
                        },
                        image_video: {
                            accept: window.avatarMessage
                        },

                    },

                    errorElement: "span",
                    errorLabelContainer: ".errorTxt",

                    submitHandler: function(form) {
                        form.submit();
                    },
                });



            });
        </script>
    @endpush
@endsection
