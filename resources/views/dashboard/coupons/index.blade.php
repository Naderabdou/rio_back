@extends('dashboard.layouts.app')

@section('title', transWord('اكواد الخصم'))

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
                                            href="{{ route('admin.coupons.index') }}">{{ transWord('اكواد الخصم') }}</a>
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
                                    href="{{ route('admin.coupons.create') }}"><i class="mr-1"
                                        data-feather="circle"></i><span
                                        class="align-middle">{{ transWord('اضافه كود خصم جديد') }}
                                    </span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ transWord('كود الخصم') }}</th>
                                            <th>{{ transWord('الخصم') }}</th>
                                            <th>{{ transWord('نوع الخصم') }}</th>
                                            <th>{{ transWord('الحاله') }}</th>
                                            <th>{{ transWord('الإجراءات') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $coupon)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                </td>
                                                <td>{{ $coupon->code }}</td>
                                                <td>{{ $coupon->value }}</td>
                                                <td>{{ $coupon->type }}</td>
                                                <td>
                                                    {{-- @if ($coupon->status == 'active')
                              <span class="badge badge-success">{{__($coupon->status)}}</span>
                              @else
                              <span class="badge badge-warning">{{__($coupon->status)}}</span>
                              @endif --}}
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input change_status"
                                                            data-id="{{ $coupon->id }}"
                                                            data-url="{{ route('admin.coupon.status') }}"
                                                            id="customSwitch1{{ $coupon->id }}"
                                                            {{ $coupon->is_active == '1' ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="customSwitch1{{ $coupon->id }}"></label>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="{{ route('admin.coupons.destroy', $coupon->id) }}"
                                                            data-id="{{ $coupon->id }}"
                                                            class="btn btn-sm btn-danger item-delete"><i
                                                                class="fa-solid fa-trash-can"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
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
        <script>
            $(document).on('change', '.change_status', function(e) {

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
