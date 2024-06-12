@extends('dashboard.layouts.app')
@section('title', transWord('الإعدادات'))
@section('content')
    {{-- @push('js')
        <link rel="stylesheet" href="{{ url('intlTelInput.min.css') }}" type="text/css" />
    @endpush --}}
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
                                            href="{{ route('admin.home') }}">{{ transWord('الرئيسية') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ transWord('الإعدادات') }}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">

                <!-- Validation -->
                <section class="bs-validation">
                    <div class="row">
                        <!-- Bootstrap Validation -->
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ transWord('الإعدادات') }}</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.settings.store') }}" method="POST"
                                        class="needs-validation" enctype="multipart/form-data" novalidate id='updateForm'>
                                        @csrf

                                        <div class="row">

                                            @foreach ($settings as $setting)
                                                @if ($setting->type == 'file')
                                                    @if (  $setting->key == 'question_image')
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label"
                                                                    for="price_from">{{ transWord($setting->neckname) }}</label>
                                                                <input type="file" id="{{ $setting->key }}"
                                                                    name="{{ $setting->key }}"
                                                                    accept="image/png, image/jpeg, image/jpg , image/svg+xml"
                                                                    class="form-control image" aria-label="Name"
                                                                    aria-describedby="basic-addon-name" require />
                                                                <div class="">
                                                                    @if ($errors->has($setting->key))
                                                                        <span class="help-block">
                                                                            <strong
                                                                                style="color: red;">{{ $errors->first($setting->key) }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group prev">
                                                                <img src="{{ url('storage/' . $setting->value) }}"
                                                                    style="width: 100px"
                                                                    class="img-thumbnail preview-{{ $setting->key }}"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label"
                                                                    for="price_from">{{ transWord($setting->neckname) }}</label>
                                                                <input type="file" id="{{ $setting->key }}"
                                                                    name="{{ $setting->key }}"
                                                                    accept="image/png, image/jpeg, image/jpg"
                                                                    class="form-control image" aria-label="Name"
                                                                    aria-describedby="basic-addon-name" require />
                                                                <div class="">
                                                                    @if ($errors->has($setting->key))
                                                                        <span class="help-block">
                                                                            <strong
                                                                                style="color: red;">{{ $errors->first($setting->key) }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group prev">
                                                                <img src="{{ url('storage/' . $setting->value) }}"
                                                                    style="width: 100px"
                                                                    class="img-thumbnail preview-{{ $setting->key }}"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @elseif($setting->type == 'text')
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="title">{{ transWord($setting->neckname) }} </label>
                                                            <input type="{{ $setting->type }}" id="{{ $setting->key }}"
                                                                name="{{ $setting->key }}" value="{{ $setting->value }}"
                                                                class="form-control image" aria-label="Name"
                                                                aria-describedby="basic-addon-name" require />
                                                            <div class="">
                                                                @if ($errors->has('title'))
                                                                    <span class="help-block">
                                                                        <strong
                                                                            style="color: red;">{{ $errors->first('title') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($setting->type == 'tel')
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="title">{{ transWord($setting->neckname) }} </label>
                                                            <input type="{{ $setting->type }}" id="{{ $setting->key }}"
                                                                name="{{ $setting->key }}" value="{{ $setting->value }}"
                                                                class="form-control image" aria-label="Name"
                                                                aria-describedby="basic-addon-name" require />
                                                            <div class="">
                                                                @if ($errors->has('title'))
                                                                    <span class="help-block">
                                                                        <strong
                                                                            style="color: red;">{{ $errors->first('title') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($setting->type == 'url')
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="title">{{ transWord($setting->neckname) }} </label>
                                                            <input type="{{ $setting->type }}" id="{{ $setting->key }}"
                                                                name="{{ $setting->key }}" value="{{ $setting->value }}"
                                                                class="form-control image" aria-label="Name"
                                                                aria-describedby="basic-addon-name" require />
                                                            <div class="">
                                                                @if ($errors->has('title'))
                                                                    <span class="help-block">
                                                                        <strong
                                                                            style="color: red;">{{ $errors->first('title') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($setting->type == 'textarea')
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="title">{{ transWord($setting->neckname) }}
                                                            </label>
                                                            <textarea name="{{ $setting->key }}" class="form-control " name="{{ $setting->key }}"
                                                                id="{{ $setting->key }}" cols="30" rows="10" require>{{ $setting->value }}</textarea>
                                                            <div class="">
                                                                @if ($errors->has('title'))
                                                                    <span class="help-block">
                                                                        <strong
                                                                            style="color: red;">{{ $errors->first('title') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($setting->type == 'json')
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="title">{{ transWord($setting->neckname) }}
                                                            </label>
                                                            @foreach (json_decode($setting->value) as $value)
                                                                <div class="row my-2">
                                                                    <div class="col-md-8">
                                                                        <input type="text"
                                                                            name="{{ $setting->key }}[]"
                                                                            class="form-control"
                                                                            value="{{ $value }}" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <a class="btn btn-danger remove-btn">
                                                                            <i class="fa-solid fa-trash"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                            <div class="">
                                                                @if ($errors->has('title'))
                                                                    <span class="help-block">
                                                                        <strong
                                                                            style="color: red;">{{ $errors->first('title') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <a class="btn btn-primary add-btn">
                                                                <i data-feather='plus'></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @elseif($setting->type == 'number')
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="title">{{ transWord($setting->neckname) }}
                                                            </label>
                                                            <input
                                                                type="{{ $setting->key == 'phone' ? 'text' : $setting->type }}"
                                                                id="{{ $setting->key }}" name="{{ $setting->key }}"
                                                                value="{{ $setting->value }}"
                                                                class="form-control {{ $setting->key }}"
                                                                aria-label="Name" aria-describedby="basic-addon-name"
                                                                require />
                                                            <div class="">
                                                                @if ($errors->has('title'))
                                                                    <span class="help-block">
                                                                        <strong
                                                                            style="color: red;">{{ $errors->first('title') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($setting->type == 'email')
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="title">{{ transWord($setting->neckname) }}
                                                            </label>
                                                            <input type="{{ $setting->type }}" id="{{ $setting->key }}"
                                                                name="{{ $setting->key }}" value="{{ $setting->value }}"
                                                                class="form-control image" aria-label="Name"
                                                                aria-describedby="basic-addon-name" require />
                                                            <div class="">
                                                                @if ($errors->has('title'))
                                                                    <span class="help-block">
                                                                        <strong
                                                                            style="color: red;">{{ $errors->first('title') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif ($setting->type == 'keyword')
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="{{ $setting->key }}">{{ __($setting->neckname) }}</label>
                                                            <select class="form-control w-100 js-select-dynamic"
                                                                multiple="multiple" name="{{ $setting->key }}[]"
                                                                id="{{ $setting->key }}">
                                                                @if (json_decode($setting->value) != null)
                                                                    @foreach (json_decode($setting->value) as $item)
                                                                        <option selected>{{ $item }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                @elseif($setting->type == 'address')
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label"
                                                                for="title">{{ $setting->neckname }} </label>
                                                            <input type="{{ $setting->type }}"
                                                                style="width: 73%;margin: 12px 0 0;"
                                                                id="{{ $setting->key }}" name="{{ $setting->key }}"
                                                                value="{{ $setting->value }}" class="form-control image"
                                                                aria-label="Name" aria-describedby="basic-addon-name" />
                                                            <div id="map" style="height: 500px;"></div>
                                                            <div class="">
                                                                @if ($errors->has('title'))
                                                                    <span class="help-block">
                                                                        <strong
                                                                            style="color: red;">{{ $errors->first('title') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($setting->key == 'lat')
                                                    <input type="hidden" name="{{ $setting->key }}"
                                                        id="{{ $setting->key }}" value="{{ $setting->value }}">
                                                @elseif($setting->key == 'lng')
                                                    <input type="hidden" name="{{ $setting->key }}"
                                                        id="{{ $setting->key }}" value="{{ $setting->value }}">
                                                @endif
                                            @endforeach
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">{{ transWord('حفظ') }} <i
                                                        data-feather="edit"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Bootstrap Validation -->

                    </div>
                </section>
                <!-- /Validation -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
    @push('js')
        <script src="{{ url('dashboard') }}/app-assets/js/custom/map.js"></script>

        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdarVlRZOccFIGWJiJ2cFY8-Sr26ibiyY&libraries=places&callback=initAutocomplete&language=ar async defer">
        </script>
        <script src="{{ asset('dashboard/assets/js/custom/validation/Setting.js') }}"></script>

        <script src="{{ url('dashboard') }}/app-assets/js/custom/preview-image.js"></script>
        <script src="https://cdn.tiny.cloud/1/ncu4y607nayo1coo3vekski4tweqhf55lrvzpu0mnmnsstgw/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
        <script>
            window.acceptMessage = "{{ __('يجب ان يكون النوع  png, jpg, jpeg') }}";

            // 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount'
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

            $(document).on('click', '.remove-btn', function(e) {
                e.preventDefault();
                $(this).closest('.row').remove();
            });

            $('.add-btn').click(function(e) {
                e.preventDefault();
                var content = `<div class="row my-2">
                                    <div class="col-md-8">
                                        <input type="text" name="features[]"
                                            class="form-control"
                                            value="" required>
                                    </div>
                                    <div class="col-md-4">
                                        <a class="btn btn-danger remove-btn">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </div>`;
                $(this).parent().prepend(content);
            });

            $(".js-select-dynamic").select2({
                tags: true,
                width: '100%',
            });
        </script>
    @endpush

@endsection
