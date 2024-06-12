@extends('dashboard.layouts.app')

@section('title', transWord('اضافة منتج جديد'))

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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>

                            @endif
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.products.index') }}">{{ transWord('المنتجات') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('اضافة منتج جديد') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">{{ transWord('اضافة منتج جديد') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="createProductsForm"
                                        action="{{ route('admin.products.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row" id="append">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name_ar">{{ transWord('الأسم بالعربية') }}</label>
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
                                                    <label for="name_en">{{ transWord('الأسم بالانجليزية') }}</label>
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
                                                    <label
                                                        for="sub_title_ar">{{ transWord('العنوان الفرعي بالعربي') }}</label>
                                                    <input type="text" id="sub_title_ar" class="form-control"
                                                        name="sub_title_ar" value="{{ old('sub_title_ar') }}" />
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
                                                        for="sub_title_en">{{ transWord('العنوان الفرعي بالانجليزية') }}</label>
                                                    <input type="text" id="sub_title_en" class="form-control"
                                                        name="sub_title_en" value="{{ old('sub_title_en') }}" />
                                                    @error('sub_title_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="label_ar">{{ transWord('ملصق باللغه العربيه') }}</label>
                                                    <input type="text" id="label_ar" class="form-control"
                                                        name="label_ar" value="{{ old('label_ar') }}" />
                                                    @error('label_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="label_en">{{ transWord('ملصق باللغه الانجليزيه') }}</label>
                                                    <input type="text" id="label_en" class="form-control"
                                                        name="label_en" value="{{ old('label_en') }}" />
                                                    @error('label_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4">

                                                <div class="form-group w-25 mr-3">
                                                    <label for="label_color">{{ transWord('لون الملصق') }}</label>
                                                    <input type="color" id="label_color" class="form-control"
                                                        name="label_color" value="{{ old('label_color') }}" />
                                                    @error('label_color')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="has_offer">{{ transWord('عروض وخصومات') }}</label>
                                                    <select class="form-control select_2" name="has_offer"
                                                        id="has_offer" required>
                                                        <option {{ old('has_offer') == 1 ? 'selected' : '' }}
                                                            value="1">{{ transWord('نعم') }}
                                                        </option>
                                                        <option {{ old('has_offer') == 0 ? 'selected' : '' }}
                                                            value="0">{{ transWord('لا') }}</option>

                                                    </select>
                                                    @error('has_offer')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="category_id">{{ transWord('الاقسام') }}</label>
                                                    <select class="form-control select_2" name="category_id"
                                                        id="category" required>
                                                        <option value="">{{ transWord('اختر') }}
                                                        </option>
                                                        @foreach ($categories as $category)
                                                            <option
                                                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                                                                value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="brand_id">{{ transWord('ماركه') }}</label>
                                                    <select class="form-control select_2" name="brand_id" id="brand_id"
                                                        required>
                                                        <option value="">{{ transWord('اختر') }}
                                                        </option>
                                                        @foreach ($brands as $brand)
                                                            <option {{ old('brand_id') == $brand->id ? 'selected' : '' }}
                                                                value="{{ $brand->id }}">{{ $brand->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    @error('brand_id')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="desc_ar">{{ __('models.desc_ar') }}</label>
                                                    <textarea class="form-control tinyEditor " id="desc_ar" name="desc_ar" rows="10" required>{{ old('desc_ar') }}</textarea>
                                                    @error('desc_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="desc_en">{{ __('models.desc_en') }}</label>
                                                    <textarea style="visibility: hidden" class="form-control tinyEditor" id="desc_en" name="desc_en" rows="10"
                                                        required='required'>{{ old('desc_en') }}</textarea>
                                                    @error('desc_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="price">{{ transWord('السعر') }}</label>
                                                    <input type="number" id="price" class="form-control"
                                                        name="price" value="{{ old('price') }}" min="0" />
                                                    @error('price')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="discount">{{ transWord('الخصم') }}</label>
                                                    <input type="number" id="discount" class="form-control"
                                                        name="discount" value="{{ old('discount') }}" min="0" />
                                                    @error('discount')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label
                                                        for="price_after_discount">{{ transWord('السعر بعد الخصم') }}</label>
                                                    <input type="number" id="price_after_discount" class="form-control"
                                                        name="price_after_discount"
                                                        value="{{ old('price_after_discount') }}" min="0" />
                                                    @error('price_after_discount')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="stock">{{ transWord('الكميه') }}</label>
                                                    <input type="number" id="stock" class="form-control"
                                                        name="stock" value="{{ old('stock') }}" min="1" />
                                                    @error('stock')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="image"
                                                        class="form-label">{{ transWord('الصورة') }}</label>
                                                    <input class="form-control image" type="file" id="image"
                                                        name="image" accept=".png, .jpg, .jpeg" required>
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
                                                <h2 style="display: contents">{{ transWord('تفاصيل المنتج') }}</h2>
                                                <button id="btn_add_detiles" type="button" onclick="add();"
                                                    class="btn btn-primary my-2" style="margin-right :14px"><i
                                                        class="fa-solid fa-plus"></i></button>
                                            </div>
                                            {{-- @php
                                                $old_key_ar = old('key_ar', []);
                                                $old_value_ar = old('value_ar', []);
                                                $old_key_en = old('key_en', []);
                                                $old_value_en = old('value_en', []);
                                            @endphp
                                            @for ($i = 0; $i < max(count($old_key_ar), count($old_value_ar), count($old_key_en), count($old_value_en)); $i++)
                                                <div class="col-12 color{{ $i }}">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="key_ar.{{ $i }}">{{ transWord('اسم الصفة بالعربي') }}</label>
                                                                <input type="text" id="key_ar.{{ $i }}"
                                                                    class="form-control color" name="key_ar[]"
                                                                    value="{{ $old_key_ar[$i] ?? '' }}" >

                                                               @if ($errors->has('key_ar.' . $i))
                                                                    <span class="alert alert-danger">
                                                                        <small class="errorTxt">{{ $errors->first('key_ar.' . $i) }}</small>
                                                                    </span>
                                                                @endif

                                                            </div>
                                                        </div>

                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="value_ar">{{ transWord('القيمه بالعربي') }}</label>
                                                                <input type="text" id="value_ar"
                                                                    class="form-control color" name="value_ar[]"
                                                                    value="{{ $old_value_ar[$i] ?? '' }}">
                                                                    @if ($errors->has('value_ar.' . $i))
                                                                    <span class="alert alert-danger">
                                                                        <small class="errorTxt">{{ $errors->first('value_ar.' . $i) }}</small>
                                                                    </span>
                                                                @endif

                                                            </div>
                                                        </div>

                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="key_en">{{ transWord('اسم الصفة بالانجليزي') }}</label>
                                                                <input type="text" id="key_en"
                                                                    class="form-control color" name="key_en[]"
                                                                    value="{{ $old_key_en[$i] ?? '' }}">
                                                                    @if ($errors->has('key_en.' . $i))
                                                                    <span class="alert alert-danger">
                                                                        <small class="errorTxt">{{ $errors->first('key_en.' . $i) }}</small>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>


                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="value_en">{{ transWord('القيمه بالانجليزي') }}</label>
                                                                <input type="text" id="value_en"
                                                                    class="form-control color" name="value_en[]"
                                                                    value="{{ $old_value_en[$i] ?? '' }}">
                                                                    @if ($errors->has('value_en.' . $i))
                                                                    <span class="alert alert-danger">
                                                                        <small class="errorTxt">{{ $errors->first('value_en.' . $i) }}</small>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <!-- Repeat for other fields -->
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <button style='margin-right:14px' type="button"
                                                        onclick="remove(this);"class="btn btn-danger my-2 "
                                                        id="color{{ $i }}"><i class="fa-solid fa-trash"></i>
                                                        حذف </button>`
                                                </div>
                                            @endfor --}}

                                            @php
                                                // Fetch old input values for Arabic and English keys and values
                                                $old_keys_ar = old('key_ar', []);
                                                $old_values_ar = old('value_ar', []);
                                                $old_keys_en = old('key_en', []);
                                                $old_values_en = old('value_en', []);
                                            @endphp

                                            @for ($i = 0; $i < max(count($old_keys_ar), count($old_values_ar), count($old_keys_en), count($old_values_en)); $i++)
                                                <div class="col-12 color{{ $i }}">
                                                    <div class="row">
                                                        @foreach ([['key_ar', 'اسم الصفة بالعربي', $old_keys_ar], ['value_ar', 'القيمه بالعربي', $old_values_ar], ['key_en', 'اسم الصفة بالانجليزي', $old_keys_en], ['value_en', 'القيمه بالانجليزي', $old_values_en]] as $field)
                                                            <div class="col-3">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="{{ $field[0] }}.{{ $i }}">{{ transWord($field[1]) }}</label>
                                                                    <input type="text"
                                                                        id="{{ $field[0] }}.{{ $i }}"
                                                                        class="form-control color"
                                                                        name="{{ $field[0] }}[]"
                                                                        value="{{ $field[2][$i] ?? '' }}">
                                                                    @if ($errors->has($field[0] . '.' . $i))
                                                                        <span class="alert alert-danger">
                                                                            <small
                                                                                class="errorTxt">{{ $errors->first($field[0] . '.' . $i) }}</small>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <button style="margin-right: 14px;" type="button"
                                                        onclick="remove(this);" class="btn btn-danger my-2"
                                                        id="color{{ $i }}">
                                                        <i class="fa-solid fa-trash"></i> حذف
                                                    </button>
                                                </div>
                                            @endfor





                                        </div>

                                        <div id="add_colors_div">


                                        </div>



                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-primary mr-1">{{ __('models.save') }}</button>
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
        <script src="https://cdn.tiny.cloud/1/ncu4y607nayo1coo3vekski4tweqhf55lrvzpu0mnmnsstgw/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
        <script>
            // 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount'
            tinymce.init({
                menubar: false,
                selector: 'textarea.tinyEditor',
                plugins: 'anchor autolink emoticons image lists searchreplace wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                setup: function(editor) {
                    editor.on('init', function() {
                        // Check if the content direction should be RTL or LTR
                        const ID = editor.id.split('_')[1]; // Set to true for RTL, false for LTR
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
        <script src="{{ asset('dashboard/assets/js/custom/validation/products.js') }}"></script>

        <script>
            var i = 0;

            function add() {
                var newElement =
                    `<div class="col-12 color${i}" >
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="key_ar">{{ transWord('اسم الصفة بالعربي') }}</label>
                                                            <input type="text" id="key_ar"" class="form-control color" name="key_ar[]"
                                                                value="" >
                                                            @error('key_ar')
                                                                <span class="alert alert-danger">
                                                                    <small class="errorTxt">{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="value_ar">{{ transWord('القيمه بالعربي') }}</label>
                                                            <input type="text" id="value_ar" class="form-control color" name="value_ar[]"
                                                                value="" />
                                                            @error('value_ar')
                                                                <span class="alert alert-danger">
                                                                    <small class="errorTxt">{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="key_en">{{ transWord('اسم الصفة بالانجليزي') }}</label>
                                                            <input type="text" id="key_en" class="form-control color" name="key_en[]"
                                                                value="" />
                                                            @error('key_en')
                                                                <span class="alert alert-danger">
                                                                    <small class="errorTxt">{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="value_en">{{ transWord('القيمه بالانجليزي') }}</label>
                                                            <input type="text" id="value_en" class="form-control color" name="value_en[]"
                                                                value="" />
                                                            @error('value_en')
                                                                <span class="alert alert-danger">
                                                                    <small class="errorTxt">{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                    <button style='margin-right:14px' type="button" onclick="remove(this);"class="btn btn-danger my-2 " id="color${i}"><i class="fa-solid fa-trash"></i> حذف </button>`
                $("#add_colors_div").append(newElement);

                //  document.getElementById("add_colors_div").innerHTML = document.getElementById("add_colors_div").innerHTML +


                i++;
            }

            function remove(e) {
                var button = e.id;
                var id = document.getElementsByClassName(button)[0].remove();
                e.remove();
            }

            function deleteRow(button) {
                var row = button.parentElement.parentElement;
                row.parentElement.removeChild(row);
            }
            $('#display_price_after_discount').hide();
            $('#display_start_date').hide();
            $('#display_end_date').hide();

            $('#has_discount').change(function() {
                if (this.value == true) {
                    $('#display_price_after_discount').show();
                    $('#display_start_date').show();
                    $('#display_end_date').show();

                } else {
                    $('#display_price_after_discount').hide();
                    $('#display_start_date').hide();
                    $('#display_end_date').hide();
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.select_2').select2();
            });
        </script>
    @endpush
@endsection
