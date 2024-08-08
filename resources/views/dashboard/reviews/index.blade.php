@extends('dashboard.layouts.app')

@section('title', transWord('التقيمات'))

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
                                            href="{{ route('admin.reviews.index') }}">{{ transWord('التقيمات') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            {{-- <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    data-feather="grid"></i></button> --}}
                            {{-- <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                    href="{{ route('admin.reviews.create') }}"><i class="mr-1"
                                        data-feather="circle"></i><span class="align-middle">{{ transWord('اضافه تقيم') }}
                                    </span></a>
                            </div> --}}
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
                                            <th>{{ transWord('الاسم') }}</th>
                                            <th>{{ transWord('اسم المنتج') }}</th>
                                            <th>{{ transWord('التقيم') }}</th>
                                            <th>{{ transWord('التعليق') }}</th>
                                            <th>{{ transWord('تفعيل التعليق') }}</th>

                                            <th>{{ transWord('الإجراءات') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviews as $review)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $review->user->name }}</td>
                                                <td>{{ $review->product->name }}</td>
                                                <td>{{ $review->rating }}</td>
                                                <td>{{ $review->review }}</td>


                                                <td>

                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                            class="custom-control-input change_review_status"
                                                            data-id="{{ $review->id }}"
                                                            data-url="{{ route('admin.reviews.changeStatus') }}"
                                                            id="customSwitch1{{ $review->id }}"
                                                            {{ $review->is_active == '1' ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="customSwitch1{{ $review->id }}"></label>
                                                    </div>
                                                </td>


                                                </td>

                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        {{-- <a href="{{ route('admin.reviews.edit', $review->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a> --}}
                                                        <a href="{{ route('admin.reviews.destroy', $review->id) }}"
                                                            data-id="{{ $review->id }}"
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
            $(document).on('change', '.change_review_status', function(e) {

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
