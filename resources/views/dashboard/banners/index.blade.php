@extends('dashboard.layouts.app')

@section('title', transWord('الاعلانات'))

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
                                            href="{{ route('admin.banners.index') }}">{{ transWord('الاعلانات') }}</a>
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
                                    href="{{ route('admin.banners.create') }}"><i class="mr-1"
                                        data-feather="circle"></i><span
                                        class="align-middle">{{ transWord('اضافه اعلان جديد') }}
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
                                            <th>{{ transWord('الاسم') }}</th>
                                            <th>{{ transWord('العنوان') }}</th>
                                            <th>{{ transWord('الالوان') }}</th>
                                            <th>{{ transWord('الصوره') }}</th>
                                            {{-- <th>{{ transWord(' صورة') }}</th> --}}

                                            <th>{{ transWord('الإجراءات') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($banners as $banner)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $banner->title }}</td>
                                                <td>{{ $banner->sub_title }}</td>

                                                {{-- <td>{{ $banner->color }}</td> --}}
                                                <td>
                                                    <span class="badge badge-pill badge-light"
                                                        style="color: {{ $banner->color['color_title'] }}">
                                                        {{ transWord('لون الاسم') }}
                                                    </span>

                                                    <span class="badge badge-pill badge-light"
                                                        style="color: {{ $banner->color['color_ground'] }}">
                                                        {{ transWord('لون الخلفية') }}
                                                    </span>

                                                    <span class="badge badge-pill badge-light"
                                                        style="color: {{ $banner->color['color_btn'] }}">
                                                        {{ transWord('لون الزر') }}
                                                    </span>
                                                    {{-- @foreach ($banner->color as $key => $color)
                                                        <span class="badge badge-pill badge-light" style="color: {{ $color }}">
                                                            dsfdsfsd
                                                        </span>

                                                    @endforeach --}}

                                                </td>




                                                <td><img src="{{ $banner->image_path }}" width="50px" height="50px">
                                                </td>

                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.banners.edit', $banner->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="{{ route('admin.banners.destroy', $banner->id) }}"
                                                            data-id="{{ $banner->id }}"
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
    @endpush
@endsection
