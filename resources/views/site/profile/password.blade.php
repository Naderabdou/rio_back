@extends('site.layouts.app')
@section('title', transWord('الملف الشخصي'))

@title(getSetting('seo_title', app()->getLocale()))
@description(Str::limit(getSetting('desc_seo', app()->getLocale()), 160))
@keywords(implode(',', json_decode(getSetting('keyword', app()->getLocale()))))
@image(asset('storage/' . getSetting('logo')))
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css">
@endpush
@section('sub-header')
    <div class="title-page">
        <div class="main-container">
            <h2>{{ transWord('الملف الشخصي') }}</h2>
            <div class="breadcrumb-header">

                <a href="{{ route('site.home') }}"> {{ transWord('الرئيسية') }} </a> <img
                src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
            <a href="{{  route('site.profile') }}"> {{ transWord('البروفايل') }} </a> <img
                src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
            <span>{{ transWord('كلمه السر') }}</span>

            </div>
        </div>
    </div>
@endsection
@section('content')

    <main id="app">

        <section class="my-account mr-section">
            <div class="main-container">
                <div class="row row-gap">
                    <div class="col-lg-4">
                        {{-- <div class="user-accout">
                            <div class="title-user-account">
                                <img src="{{ $user->image != null ? $user->image_path : asset('site/images/user2.png') }}"
                                    alt="">
                                <h2 id="name_profile"> {{ $user->name }}</h2>
                                <h3 id="email_profile"> {{ $user->email }} </h3>
                            </div>
                            <ul>
                                <li><a href="{{ route('site.profile') }}" class="active"> <img
                                            src="{{ asset('site/images/icon/profile.svg') }}" alt="">
                                        {{ transWord('حسابي') }} </a></li>
                                <li><a href="myorders.html"> <img src="{{ asset('site/images/icon/task-square.svg') }}"
                                            alt="">
                                        {{ transWord('طلباتي') }}</a></li>
                                <li><a href="{{ route('site.address.index') }}"> <img src="{{ asset('site/images/icon/house.svg') }}"
                                            alt=""> {{ transWord('العناوين') }} </a>
                                </li>
                                <li><a href="myacount.html" data-toggle="modal" data-target=".logout-modal"> <img
                                            src="{{ asset('site/images/icon/logout.svg') }}" alt="">
                                        {{ transWord('تسجيل الخروج') }}
                                    </a></li>
                            </ul>
                        </div> --}}
                        @include('site.components.user_profile')
                    </div>
                    <div class="col-lg-8">
                        <div class="main-form-my-account">
                            <div class="title-form-acount">
                                <h2>{{ transWord('تعديل كلمة المرور') }}</h2>
                            </div>
                            <form action="{{ route('site.profile.changePassword.update') }}" id="update_password" data-url="{{ route('admin.check.password') }}">
                                @csrf
                                <div class="form-my-account">
                                    <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                                    <div class="input-form " >
                                        <input type="password" placeholder="{{ transWord('كلمه المرور القديمة') }} "
                                            class="form-control" name="old_password" value="" id="old_password">
                                    </div>
                                    <div class="input-form">
                                        <input type="password" placeholder="{{ transWord('كلمه المرور الجديدة') }} "
                                            class="form-control" name="password" value="" id="password">
                                    </div>

                                    <div class="input-form"
                                        style="display: flex; justify-content: space-between; align-items: center;">
                                        <input type="password" placeholder="{{ transWord('تأكيد كلمه المرور الجديدة') }} "
                                            class="form-control" name="password_confirmation" value="" id="password_confirmation">
                                    </div>







                                </div>

                                <div class="btn-form-my-account mt-4">
                                    <button type="submit" class="ctm-btn" id="btn_update_password">
                                        {{ transWord('تحديث كلمة المرور') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        <!-- start modal aosh =============
                                ======================== -->


    </main>
@endsection

@push('js')
    <script>
        function setInputValue(name, value) {
            $('input[name="' + name + '"]').val(value);
        }
        $("#update_password").validate({


            rules: {
                // Define validation rules for your form fields here
                old_password: {
                    required: true,
                    minlength: 8,
                    remote: {
                        url: $('#update_password').data('url'),
                        type: "post",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            old_password: function() {
                                return $("#old_password").val();
                            },
                            id: function() {
                                return $("#id")
                                    .val(); // assuming the ID of the record is stored in a field with the ID "id"
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
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                },



                // Add more fields as needed
            },

            messages: {

               password_confirmation: {
                    equalTo: window.passwordConfirmMessage
                },




            },



            errorElement: "span",
            errorLabelContainer: ".errorTxt",


            submitHandler: function(form) {
                $('btn_update_password').prop('disabled', true);
                // Hide the button
                $('#btn_update_password').hide();

                // Add a spinner
                $('#btn_update_password').parent().append(
                    `<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
                </div>
                        `
                );


                var formData = new FormData(form);
                let url = form.action;
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {


                        Swal.fire({
                            icon: 'success',
                            title: `<h5> ${data.message}</h5> `,
                            showConfirmButton: false,
                            timer: 2000
                        });


                        $('#btn_update_password').prop('disabled', false);


                        // Show the button
                        $('#btn_update_password').show();

                        // Remove the spinner
                        $('#btn_update_password').next('.spinner-border').remove();

                    },
                    error: function(data) {
                        $('#btn_update_password').prop('disabled', false);

                        // Show the button
                        $('#btn_update_password').show();

                        // Remove the spinner
                        $('#btn_update_password').next('.spinner-border').remove();
                        $('.error-message').text('');
                        var errors = data.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            var errorMessage = messages.join(', ');
                            $('#' + field + '_error').text(
                                errorMessage);
                        });
                    },
                });

            },
        });
    </script>
@endpush
