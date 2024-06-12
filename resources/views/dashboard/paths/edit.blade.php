@extends('dashboard.layouts.app')

@section('title', transWord('تعديل مساراتنا '))

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
                                            href="{{ route('admin.ourPaths.index') }}">{{ transWord('مساراتنا') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                            href="#">{{ transWord('تعديل مساراتنا ') }}</a>
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
                                    <h2 class="card-title">{{ transWord('تعديل مساراتنا ') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" action="{{ route('admin.ourPaths.update',$path->id) }}"
                                        method="POST" enctype="multipart/form-data" id="UpdateOurPathsForm">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">


                                            <input type="hidden" name="id" value="{{ $path->id }}" id="id">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name_ar">{{ transWord('الاسم بالعربي') }}</label>
                                                    <input type="text" id="name_ar" class="form-control"
                                                        name="name_ar" value="{{ old('name_ar',$path->name_ar) }}" />
                                                    @error('name_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name_en">{{ transWord('الاسم بالإنجليزي') }}</label>
                                                    <input type="text" id="name_en" class="form-control"
                                                        name="name_en" value="{{ old('name_en',$path->name_en) }}" />
                                                    @error('name_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="desc_ar">{{ transWord('الوصف بالعربي') }}</label>
                                                    <textarea class="form-control tinyEditor " name="desc_ar" rows="10">{{ old('desc_ar',$path->desc_ar) }}</textarea>
                                                    @error('desc_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="desc_en">{{ transWord('الوصف بالانجليزي') }}</label>
                                                    <textarea class="form-control tinyEditor" name="desc_en" rows="10">{{ old('desc_en',$path->desc_en) }}</textarea>
                                                    @error('desc_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="image"
                                                        class="form-label">{{ transWord('الايقونه') }}</label>
                                                    <input class="form-control image" type="file" id="image"
                                                        name="image" accept=".png, .jpg, .jpeg, .svg">
                                                    @error('image')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group prev">
                                                    <img src="{{ $path->image_path }}" style="width: 100px"
                                                        class="img-thumbnail preview-image" alt="">
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

        <script src="{{ asset('dashboard/assets/js/custom/validation/OurPathsForm.js') }}"></script>
        <script src="https://cdn.tiny.cloud/1/ncu4y607nayo1coo3vekski4tweqhf55lrvzpu0mnmnsstgw/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
        <script>
             tinymce.init({
            menubar: false,
            selector: 'textarea.tinyEditor',
            plugins: 'anchor autolink emoticons lists searchreplace wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            setup: function(editor) {
                editor.on('init', function() {
                    // Check if the content direction should be RTL or LTR
                    const editorName = editor.id.split('_'); // Set to true for RTL, false for LTR

                    const ID = editorName[editorName.length - 1];

                    const content = editor.getBody();
                    if (ID === 'ar') {
                        content.style.direction = 'rtl';
                    } else {
                        content.style.direction = 'ltr';
                    }
                });
            }
        });
        </script>
         <script>
            window.UrlPath = "{{ route('admin.check.PathName') }}"
        </script>
    @endpush
@endsection
