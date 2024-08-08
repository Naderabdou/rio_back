@extends('dashboard.layouts.app')

@section('title', transWord('إضافة تاجر جديد'))

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
                                            href="{{ route('admin.merchants.index') }}">{{ transWord('التجار') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('اضافة تاجر جديد') }}</a>
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
                                    <h2 class="card-title">{{ transWord('اضافة تاجر جديد') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" action="{{ route('admin.merchants.store') }}"
                                        method="POST" enctype="multipart/form-data" id="MerchantsFormCreate">
                                        @csrf
                                        <div class="row">


                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="name">{{ transWord('الاسم بالكامل') }}</label>
                                                    <input type="text" id="name" class="form-control" name="name"
                                                        value="{{ old('name') }}" />
                                                    @error('name')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email">{{ transWord('البريد الاكتروني') }}</label>
                                                    <input type="email" id="email" class="form-control" name="email"
                                                        value="{{ old('email') }}" />
                                                    @error('email')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="phone">{{ transWord('رقم الجوال') }}</label>
                                                    <input type="text" id="phone" class="form-control" name="phone"
                                                        value="{{ old('phone') }}" />
                                                    @error('phone')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="col-6">
                                                <div class="form-group">
                                                    <label
                                                        for="additional_phone">{{ transWord('رقم الجوال الاخر') }}</label>
                                                    <input type="text" id="additional_phone" class="form-control"
                                                        name="additional_phone" value="{{ old('additional_phone') }}" />
                                                    @error('additional_phone')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="password">{{ transWord('كلمه السر') }}</label>
                                                    <input type="password" id="password" class="form-control"
                                                        name="password" value="{{ old('password') }}" />
                                                    @error('password')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label
                                                        for="password_confirmation">{{ transWord('تاكيد كلمه السر') }}</label>
                                                    <input type="password" id="password_confirmation" class="form-control"
                                                        name="password_confirmation"
                                                        value="{{ old('password_confirmation') }}" />
                                                    @error('password_confirmation')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1">{{ transWord('save') }}
                                                </button>
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
            $(document).ready(function() {

                $.validator.addMethod("noSpecialChars", function(value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF ]*$/.test(value);
                }, window.noSpecialChars);
                $.validator.addMethod("domain", function(value, element) {
                    // Allow emails from gmail.com, yahoo.com, hotmail.com, and outlook.com
                    return this.optional(element) ||
                        /^[\w.-]+@(gmail\.com|yahoo\.com|hotmail\.com|outlook\.com)$/.test(value);
                }, window.emailmessage);

                $.validator.addMethod("phone_type", function(value, element) {
                    return this.optional(element) || /^[0-9+]+$/.test(value);
                }, window.phoneMessage);
                $.validator.addMethod('string', function(value, element) {
                    return this.optional(element) || /^[\u0600-\u06FFa-zA-Z\s]+$/i.test(value);
                }, window.stringMessage);

                $.validator.addMethod("egyptPhone", function(value, element) {
                    return this.optional(element) || /^(?:\+2)?0(15|10|12|11)[0-9]{8}$/.test(value);
                }, window.egyptPhone);

                $.validator.addMethod("fullname", function(value, element) {
                    var words = value.split(' ');
                    return this.optional(element) || /^[\u0600-\u06FFa-zA-Z-' ]+$/.test(value) && words
                        .length >= 3;
                }, window.fullname);


                $("#MerchantsFormCreate").validate({
                    // initialize the plugin

                    rules: {
                        name: {
                            required: true,
                            minlength: 2,
                            noSpecialChars: true,
                            string: true,
                            fullname: true,
                        },

                        email: {
                           required: true,
                            minlength: 3,
                            domain: true,
                            remote: {
                                url: window.merchantsEmail,
                                type: "post",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    email: function() {
                                        return $("#email").val();
                                    }
                                },
                                dataFilter: function(data) {

                                    var json = JSON.parse(data);
                                    if (json.message) {
                                        return "\"" + json.message + "\"";
                                    }
                                    return true;
                                }
                            }
                        },
                        phone: {
                            required: true,
                            egyptPhone: true,
                            phone_type: true,
                            minlength: 11,
                            maxlength: 12,
                            remote: {
                                url: window.merchantsPhone,
                                type: "post",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    phone: function() {
                                        return $("#phone").val();
                                    }
                                },
                                dataFilter: function(data) {

                                    var json = JSON.parse(data);
                                    if (json.message) {
                                        return "\"" + json.message + "\"";
                                    }
                                    return true;
                                }
                            }
                        },
                        password: {
                            required: true,
                            minlength: 8,
                        },
                        password_confirmation: {
                            required: true,
                            equalTo: "#password"
                        },
                        messages: {

                            phone: {
                                minlength: window.phoneMinLengthMessage,
                                maxlength: window.phoneMaxLengthMessage,
                            },
                            password_confirmation: {
                                equalTo: window.passwordConfirmMessage
                            },




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

        <script>
            window.merchantsEmail = "{{ route('admin.check.email') }}";
            window.merchantsPhone = "{{ route('admin.check.phone') }}";
        </script>
    @endpush
@endsection
