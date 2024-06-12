@extends('dashboard.layouts.app')

@section('title', transWord('المنتجات'))

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
                                            href="{{ route('admin.products.index') }}">{{ transWord('المنتجات') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                    href="{{ route('admin.products.create') }}"><i class="mr-1"
                                        data-feather="circle"></i><span class="align-middle">{{ transWord('اضافه منتج') }}
                                    </span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                {{-- <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">{{ transWord('اضافة منتجات من خلال ملف excel') }}</h2>
                    </div>
                    <div class="card-body">
                        <form class="form form-vertical" id="excelForm" action="{{ route('admin.import-products') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row" id="append">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">{{ transWord('الصورة') }}</label>
                                        <input class="form-control" type="file" id="formFile" name="file"
                                            accept=".xlsx,.csv" required>
                                        @error('file')
                                            <span class="alert alert-danger">
                                                <small class="errorTxt">{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1">{{ __('models.save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}

                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ transWord('اسم المنتج') }}</th>
                                            <th>{{ transWord('وصف المنتج') }}</th>
                                            <th>{{ transWord('اسم الماركه') }}</th>
                                            <th>{{ transWord('اسم القسم') }}</th>
                                            <th>{{ transWord('صور') }}</th>
                                            <th>{{ transWord('الحاله') }}</th>
                                            <th>{{ __('models.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>

                                                <td>{{ $product?->id }}</td>
                                                <td>{{ $product?->name }}</td>
                                                <td>{{ Str::limit(strip_tags($product?->desc), 15) }}</td>
                                                <td>{{ $product->brand?->name }}</td>
                                                <td>{{ $product?->category?->name }}</td>
                                                <td><a href="{{ route('admin.product_images.create', $product?->id) }}">
                                                        <img src="{{ $product->image_path }}" width="100px"
                                                            height="100px">
                                                    </a>
                                                </td>
                                                <td>
                                                    {{-- @if ($coupon->status == 'active')
                              <span class="badge badge-success">{{__($coupon->status)}}</span>
                              @else
                              <span class="badge badge-warning">{{__($coupon->status)}}</span>
                              @endif --}}
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                            class="custom-control-input change_statusProduct"
                                                            data-id="{{ $product->id }}"
                                                            data-url="{{ route('admin.product.status') }}"
                                                            id="customSwitch1{{ $product->id }}"
                                                            {{ $product->is_active == '1' ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="customSwitch1{{ $product->id }}"></label>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.product_images.create', $product?->id) }}"
                                                            class="btn btn-sm btn-secondary"><i
                                                                class="fa-regular fa-images"></i></a>
                                                        <a href="{{ route('admin.products.edit', $product?->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="{{ route('admin.products.destroy', $product->id) }}"
                                                            data-id="{{ $product->id }}"
                                                            class="btn btn-sm btn-danger item-delete"><i
                                                                class="fa-solid fa-trash-can"></i></a>
                                                        <a href="#" class="btn btn-info btn-circle btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#exampleModalLong{{ $product->id }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                    </div>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="exampleModalLong{{ $product->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                                {{ transWord('تفاصيل الطالب') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('اسم المنتج') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $product->name }}

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('العنوان الفرعي') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $product->sub_title }}

                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('الملصق') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $product->label }}

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('لون الملصق') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            <span
                                                                                style="color:{{ $product->label_color }}">{{ $product->label_color }}</span>

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('هل من العروض او الخصومات') }}
                                                                            </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            @if ($product->is_offer)
                                                                                <span
                                                                                    class="badge badge-primary">{{ transWord('نعم') }}</span>
                                                                            @else
                                                                                <span
                                                                                    class="badge badge-danger">{{ transWord('لا') }}</span>
                                                                            @endif

                                                                        </div>
                                                                    </div>



                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('وصف') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ strip_tags($product->desc) }}
                                                                        </div>

                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('اسم الماركه') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $product->brand?->name }}
                                                                        </div>

                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('القسم') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $product->category?->name }}
                                                                        </div>

                                                                    </div>





                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('السعر') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $product->price }}
                                                                        </div>

                                                                    </div>



                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('الخصم') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $product->discount ?? 0 }}
                                                                        </div>

                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('السعر بعد الخصم') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $product->price_after_discount ?? 0 }}
                                                                        </div>

                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('الكميه') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $product->stock ?? 1 }}
                                                                        </div>

                                                                    </div>






                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('تفاصيل المنتج') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            @foreach ($product->details as $detail)
                                                                                <span
                                                                                    class="badge badge-primary">{{ $detail->key }}</span>
                                                                                :
                                                                                <span
                                                                                    class="badge badge-success">{{ $detail->value }}</span>
                                                                            @endforeach

                                                                        </div>

                                                                    </div>











                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">{{ __('إغلاق') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Basic table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
    @push('js')
        <script src="{{ asset('dashboard/app-assets/js/custom/custom-delete.js') }}"></script>

        <script src="{{ asset('dashboard/assets/js/custom/validation/excelForm.js') }}"></script>

        <script>
            $(document).on('change', '.change_statusProduct', function(e) {

                e.preventDefault();
                var id = $(this).data('id');
                var url = $(this).data('url');
                var This = $(this);
                const Toast2 = Swal.mixin({

                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                const Toast = Swal.mixin({

                    showCancelButton: true,
                    showConfirmButton: true,
                    cancelButtonColor: '#888',
                    confirmButtonColor: '#d6210f',
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(result) {

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-start',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: "تم تغيير الحالة بنجاح"
                        })



                    } // end of success

                }); // end of ajax

            });
        </script>
    @endpush
@endsection
