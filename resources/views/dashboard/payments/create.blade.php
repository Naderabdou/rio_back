@extends('dashboard.layouts.app')

@section('title', transWord('إضافة وسيله دفع جديد'))

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
                                            href="{{ route('admin.payments.index') }}">{{ transWord(' وسائل الدفع') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                            href="#">{{ transWord('إضافة وسيله دفع جديد') }}</a>
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
                                    <h2 class="card-title">{{ transWord('إضافة وسيله دفع جديد') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" action="{{ route('admin.payments.store') }}"
                                        method="POST" id="createPaymentsForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

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
                                                    <label for="name_en">{{ transWord('الأسم بالإنجليزية') }}</label>
                                                    <input type="text" id="name_en" class="form-control" name="name_en"
                                                        value="{{ old('name_en') }}" />
                                                    @error('name_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="PAYMOB_IFRAME_ID">PAYMOB_IFRAME_ID</label>
                                                    <input type="text" id="PAYMOB_IFRAME_ID" class="form-control"
                                                        name="PAYMOB_IFRAME_ID" value="{{ old('PAYMOB_IFRAME_ID') }}" />
                                                    @error('PAYMOB_IFRAME_ID')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="is_cash">{{ transWord('هل نوع الدفع هذا كاش ام لا ؟') }}</label>
                                                    <select class=" form-control select2" id="is_cash" name="is_cash">
                                                        <option value="">{{ transWord('اختر') }}</option>
                                                        <option value="1"
                                                            @if (old('is_cash') == '1') selected @endif>
                                                            {{ transWord('نعم') }}</option>
                                                        <option value="0"
                                                            @if (old('is_cash') == '0') selected @endif>
                                                            {{ transWord('لا') }}</option>
                                                    </select>
                                                    @error('is_cash')
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
                                                    <img src="" style="width: 100px"
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
        <script>
            window.payment = "{{ route('admin.check.paymentName') }}";
        </script>
        <script src="{{ asset('dashboard/app-assets/js/custom/preview-image.js') }}"></script>

        <script src="{{ asset('dashboard/assets/js/custom/validation/PaymentsForm.js') }}"></script>

        <script>
            $(document).ready(function() {
                // // Function to show/hide PAYMOB_IFRAME_ID input based on is_cash radio selection
                // function togglePaymobIframeId() {
                //     if ($('#is_cash_no').is(':checked')) {
                //         // If "No" is selected, hide the PAYMOB_IFRAME_ID input
                //         $('#PAYMOB_IFRAME_ID').closest('.form-group').show();
                //     } else {
                //         // Otherwise, show it
                //         $('#PAYMOB_IFRAME_ID').closest('.form-group').hide();
                //     }
                // }

                // // Run the function on page load
                // togglePaymobIframeId();

                // // Also run the function whenever the selection changes
                // $('input[type=radio][name=is_cash]').change(function() {
                //     togglePaymobIframeId();
                // });

                $('#is_cash').change(function() {
                    if ($(this).val() == 0) {
                        $('#PAYMOB_IFRAME_ID').closest('.form-group').show();
                    } else {
                        $('#PAYMOB_IFRAME_ID').closest('.form-group').hide();
                    }
                });
            });
            </script>
    @endpush
@endsection
