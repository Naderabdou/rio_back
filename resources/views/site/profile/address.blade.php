@extends('site.layouts.app')
@section('title', transWord('العناوين'))

@title(getSetting('seo_title', app()->getLocale()))
@description(Str::limit(getSetting('desc_seo', app()->getLocale()), 160))
@keywords(implode(',', json_decode(getSetting('keyword', app()->getLocale()))))
@image(asset('storage/' . getSetting('logo')))
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css">
    <style>
        .pagination li {
            display: inline-block;
            padding: 5px;
        }

        <style>.custom-pagination {
            display: flex;
            list-style: none;
            padding: 0;
            justify-content: center;
            margin-top: 20px;
        }

        .custom-pagination li {
            margin: 0 5px;
        }

        .custom-pagination a {
            display: block;
            padding: 10px 15px;
            border: 1px solid #ddd;
            color: #333;
            text-decoration: none;
        }

        .custom-pagination a:hover,
        .custom-pagination .active a {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
    </style>
    </style>
@endpush
@section('sub-header')
    <div class="title-page">
        <div class="main-container">
            <h2>{{ transWord('العناوين') }}</h2>
            <div class="breadcrumb-header">



                <a href="{{ route('site.home') }}"> {{ transWord('الرئيسية') }} </a> <img
                src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
            <a href="{{  route('site.profile') }}"> {{ transWord('البروفايل') }} </a> <img
                src="{{ asset('site/images/icon/arrow.svg') }}" alt="">
            <span>{{ transWord('العناوين') }}</span>





            </div>
        </div>
    </div>
@endsection
@section('content')
    <main id="app">

        <section class="my-account mr-section">
            <div class="main-container">
                <div class="row">
                    <div class="col-lg-4">
                        {{-- <div class="user-accout">
                            <div class="title-user-account">
                                <img src="{{ $user->image !=null ? $user->image_path : asset('site/images/user2.png') }}" alt="">
                                <h2> {{ $user->name }}</h2>
                                <h3> {{ $user->email }} </h3>
                            </div>
                            <ul>
                                <li><a href="myacount.html"> <img src="images/icon/profile.svg" alt=""> {{ transWord('حسابي') }} </a>
                                </li>
                                <li><a href="myorders.html"> <img src="images/icon/task-square.svg" alt="">
                                        {{ trasnWord('طلباتي') }}</a></li>
                                <li><a href="address.html" class="active"> <img src="images/icon/house.svg" alt="">
                                        {{ transWord('العناوين') }} </a>
                                </li>
                                <li><a href="myacount.html"> <img src="images/icon/logout.svg" alt=""> تسجيل الخروج
                                    </a></li>
                            </ul>
                        </div> --}}
                        @include('site.components.user_profile')
                    </div>

                    <div class="col-lg-8">
                        <div class="main-form-my-account">
                            <div class="title-form-acount">
                                <h2>{{ transWord('تفاصيل العناوين') }}</h2>
                                <a href="" data-toggle="modal" data-target=".address-modal" class="ctm-btn2">
                                    {{ transWord('اضف عنوان جديد') }}</a>
                            </div>
                            <div id="address-list" class="address-order">

                                <div class="list">
                                    @forelse ($user as $address)
                                        <div class="main-address-order list">
                                            <div class="title-address-order">
                                                <h2 class="address-name">{{ transWord('Address') }} {{ $loop->iteration }}
                                                </h2>
                                                <div class="d-flex  btns-sm-col gap-5">
                                                    <a href="" data-toggle="modal"
                                                        data-target=".address-modal-update-{{ $address->id }}"
                                                        class="ctm-btn2 address-update"
                                                        data-governorate="{{ $address->governorate_id }}">
                                                        {{ transWord('تعديل') }}</a>
                                                    <form action="{{ route('site.address.destroy', $address->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="ctm-btn2">
                                                            {{ transWord('حذف') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <ul class="list">
                                                <li> {{ transWord('المحافظة') }} <span> {{ $address->governorate->name }}
                                                    </span></li>
                                                <li> {{ transWord('المدينة') }} <span> {{ $address->city->name }} </span>
                                                </li>
                                                <li> {{ transWord('العنوان') }} <span> {{ $address->street }}</span></li>
                                            </ul>
                                        </div>

                                        <div class="modal fade address-modal-update-{{ $address->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <div class="main-add-address m-auto">
                                                        <div class="img-add-address">
                                                            <img src="{{ asset('site/images/address.png') }}" alt="">
                                                        </div>
                                                        <div class="title-center mb-5">
                                                            <h2>{{ transWord('تعديل العنوان') }}</h2>
                                                        </div>
                                                        <form action="{{ route('site.address.update', $address->id) }}"
                                                            method="POST" class="address_update">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="input-form arrow-select">
                                                                <select class="form-select form-control governorate_id"
                                                                    name="governorate_id">
                                                                    <option value=""> {{ transWord('اختر المحافظه') }}
                                                                    </option>
                                                                    @foreach ($governorates as $governorate)
                                                                        <option
                                                                            {{ $address->governorate_id == $governorate->id ? 'selected' : '' }}
                                                                            value="{{ $governorate->id }}">
                                                                            {{ $governorate->name }} </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="input-form arrow-select">
                                                                <select class="form-select form-control city_id" name="city_id">
                                                                    <option value=""> {{ transWord('اختر المدينه') }}
                                                                    </option>

                                                                </select>
                                                            </div>
                                                            <div class="input-form">
                                                                <input type="text" name="street"
                                                                    placeholder="{{ transWord('العنوان') }}"
                                                                    class="form-control" value="{{ $address->street }}">
                                                            </div>

                                                            <div class="btn-add-address mt-4">
                                                                <button class="ctm-btn w-100"> {{ transWord('حفظ') }} </button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="notFound">
                                            <img src="{{ asset('site/images/not_address.png') }}">
                                            <h2>{{ transWord('لايوجد عناوين مضافة') }} </h2>
                                        </div>


                                    @endforelse
                                </div>
                                @if ($user->count() > 0)

                                <ul class="pagination custom-pagination"></ul>
                                @endif
                            </div>



                        </div>

                    </div>
                </div>
            </div>
        </section>





        <div class="modal fade address-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="main-add-address m-auto">
                        <div class="img-add-address">
                            <img src="{{ asset('site/images/address.png') }}" alt="">
                        </div>
                        <div class="title-center mb-5">
                            <h2>{{ transWord('إضافة عنوان جديد') }}</h2>
                        </div>
                        <form action="{{ route('site.address.store') }}" method="POST" id="address_store">
                            @csrf
                            <div class="input-form arrow-select">
                                <select class="form-select form-control governorate_id" name="governorate_id">
                                    <option value=""> {{ transWord('اختر المحافظه') }} </option>
                                    @foreach ($governorates as $governorate)
                                        <option value="{{ $governorate->id }}"> {{ $governorate->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-form arrow-select">
                                <select class="form-select form-control city_id" name="city_id">
                                    <option value=""> {{ transWord('اختر المدينه') }} </option>

                                </select>
                            </div>
                            <div class="input-form">
                                <input type="text" name="street" placeholder="{{ transWord('العنوان') }}"
                                    class="form-control">
                            </div>

                            <div class="btn-add-address mt-4">
                                <button class="ctm-btn w-100"> {{ transWord('حفظ') }} </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>






    </main>
@endsection
@push('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.governorate_id').change(function() {
                var governorate_id = $(this).val();
                if (governorate_id) {
                    $.ajax({
                        url: "{{ route('site.cities') }}",
                        type: "POST",
                        data: {
                            governorate_id: governorate_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            $('.city_id').empty();
                            $('.city_id').append(
                                '<option value="">{{ transWord('اختر المدينة') }}</option>'
                            );
                            $.each(data, function(key, value) {
                                @if (app()->getLocale() == 'ar')
                                    $('.city_id').append('<option value="' + value.id +
                                        '">' + value.name_ar + '</option>');
                                @else
                                $('.city_id').append('<option value="' + value.id +
                                '">' + value.name_en + '</option>');
                                @endif

                            });
                        }
                    });
                }
            });

            $(document).on('click', '.address-update', function() {
                var governorate_id = $(this).data('governorate');


                $.ajax({
                    url: "{{ route('site.address.index') }}",
                    type: "GET",
                    data: {
                        governorate_id: governorate_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {

                        @if ($user->count() > 0)
                            var oldCityId = data.adrees.city_id;
                        @else
                            var oldCityId = "{{ old('city_id') }}";
                        @endif

                        $('.city_id').empty();
                        $('.city_id').append(
                            '<option value="">{{ transWord('اختر المدينة') }}</option>');
                        $.each(data.cities, function(key, value) {

                            var isSelected = (value.id == oldCityId) ? ' selected' : '';
                            @if (app()->getLocale() == 'ar')
                                $('.city_id').append('<option value="' + value.id +
                                    '"' + isSelected + '>' + value.name_ar +
                                    '</option>');
                            @else
                            $('.city_id').append('<option value="' + value.id +
                                    '"' + isSelected + '>' + value.name_en +
                                    '</option>');
                            @endif
                        });

                    }
                });
            });



            // $('.detele_address').click(function(e) {
            //     e.preventDefault();
            //     var url = $(this).attr('href');
            //     Swal.fire({
            //         title: '{{ transWord('هل انت متأكد من الحذف') }}',
            //         text: "{{ transWord('لن تتمكن من استعادة العنوان بعد الحذف') }}",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: '{{ transWord('نعم') }}',
            //         cancelButtonText: '{{ transWord('لا') }}',
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             $.ajax({
            //                 url: url,
            //                 method: 'post',
            //                 data: {
            //                     _token: "{{ csrf_token() }}",
            //                     _method: "delete"
            //                 },
            //                 success: function(data) {
            //                     Swal.fire({
            //                         icon: 'success',
            //                         title: `<h5> ${data.message}</h5> `,
            //                         showConfirmButton: false,
            //                         timer: 2000
            //                     });
            //                     setTimeout(() => {
            //                         location.reload();
            //                     }, 500);
            //                 },
            //                 error: function(data) {
            //                     Swal.fire({
            //                         icon: 'error',
            //                         title: `<h5> ${data.responseJSON.message}</h5> `,
            //                         showConfirmButton: false,
            //                         timer: 2000
            //                     });
            //                 }
            //             });
            //         }
            //     });
            // });
            $("#address_store").validate({


                rules: {
                    // Define validation rules for your form fields here
                    street: {
                        required: true,
                        minlength: 2,

                    },

                    governorate_id: {
                        required: true,

                    },
                    city_id: {
                        required: true,

                    },

                    // Add more fields as needed
                },





                errorElement: "span",
                errorLabelContainer: ".errorTxt",


                submitHandler: function(form) {
                    $('.ctm-btn').prop('disabled', true);
                    // Hide the button
                    $('.ctm-btn').hide();

                    // Add a spinner
                    $('.ctm-btn').parent().append(
                        `<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="sr-only">Loading...</span>
                        </div>
                    `
                    );
                    form.submit();
                }
            })
            $("#address_update").validate({


                rules: {
                    // Define validation rules for your form fields here
                    street: {
                        required: true,
                        minlength: 2,

                    },

                    governorate_id: {
                        required: true,

                    },
                    city_id: {
                        required: true,

                    },

                    // Add more fields as needed
                },





                errorElement: "span",
                errorLabelContainer: ".errorTxt",


                submitHandler: function(form) {
                    $('.ctm-btn').prop('disabled', true);
                    // Hide the button
                    $('.ctm-btn').hide();

                    // Add a spinner
                    $('.ctm-btn').parent().append(
                        `<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>
                `
                    );
                    form.submit();
                }
            })

            var options = {
                valueNames: ['address-name'],
                page: 4, // عدد العناصر لكل صفحة
                pagination: true // تفعيل الترقيم
            };

            var addressList = new List('address-list', options);
        });
    </script>
@endpush
