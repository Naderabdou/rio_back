@extends('dashboard.layouts.app')

@section('title', transWord('تعديل كلمة المرور'))

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
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('تعديل كلمه المرور') }}</a>
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
                                    <h2 class="card-title">{{ transWord('تعديل كلمه المرور') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" action="{{ route('admin.merchant.password.update') }}"
                                        method="POST" enctype="multipart/form-data" id="update_password_merchant" data-url="{{ route('admin.check.password.merchants') }}">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                                        <div class="row">


                                            {{-- <div class="col-12">
                                                <div class="form-group">
                                                    <label for="old_password">{{ transWord('كلمة السر القديمة') }}</label>
                                                    <input type="text" id="old_password" class="form-control"
                                                        name="old_password" />
                                                    @error('old_password')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div> --}}

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
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password">{{ transWord('كلمة السر الجديدة') }}</label>
                                                    <input type="password" id="password" class="form-control"
                                                        name="password" />
                                                    @error('password')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label
                                                        for="password_confirmation">{{ transWord('تاكيد كلمه السر الجديدة') }}</label>
                                                    <input type="password" id="password_confirmation" class="form-control"
                                                        name="password_confirmation" />
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
                $("#update_password_merchant").validate({
                    // initialize the plugin

                    rules: {

                        // old_password: {
                        //     required: true,
                        //     minlength: 8,
                        //     remote: {
                        //         url: $('#update_password_merchant').data('url'),
                        //         type: "post",
                        //         headers: {
                        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        //         },
                        //         data: {
                        //             old_password: function() {
                        //                 return $("#old_password").val();
                        //             },
                        //             id: function() {
                        //                 return $("#id")
                        //                     .val(); // assuming the ID of the record is stored in a field with the ID "id"
                        //             }
                        //         },
                        //         dataFilter: function(data) {

                        //             var json = JSON.parse(data);
                        //             if (json.message) {
                        //                 return "\"" + json.message + "\"";
                        //             }
                        //             return true;
                        //         }


                        //     }
                        // },
                        password: {
                            required: true,
                            minlength: 8
                        },
                        password_confirmation: {
                            required: true,
                            equalTo: "#password"
                        },



                        messages: {


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
