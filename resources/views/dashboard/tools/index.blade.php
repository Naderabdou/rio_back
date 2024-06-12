@extends('dashboard.layouts.app')

@section('title', transWord('أدوات الربط'))

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
                                            href="{{ route('admin.tools.index') }}">{{ transWord('أدوات الربط') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                    href="{{ route('admin.banners.create') }}"><i class="mr-1"
                                        data-feather="circle"></i><span
                                        class="align-middle">{{ transWord('إضافة مقدمة جديدة') }}
                                    </span></a>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
                                            <th>{{ transWord('اسم الأداة') }}</th>
                                            <th>{{ transWord('معرف الأداة') }}</th>
                                            <th>{{ transWord('الحالة') }}</th>
                                            <th>{{ transWord('الإجراءات') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tools as $tool)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $tool->nickname }}</td>
                                                <td>{{ $tool->tool_id }}</td>
                                                <td>
                                                    @if ($tool->enabled)
                                                        <a href="{{ route('admin.tools.toggle', $tool->id) }}">
                                                            <span class="badge badge-success">
                                                                {{ transWord('مفعل') }}
                                                            </span>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('admin.tools.toggle', $tool->id) }}">
                                                            <span class="badge badge-danger">
                                                                {{ transWord('غير مفعل') }}
                                                            </span>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.tools.edit', $tool->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        {{-- <a href="{{ route('admin.tools.destroy', $tool->id) }}"
                                                            data-id="{{ $tool->id }}"
                                                            class="btn btn-sm btn-danger item-delete"><i
                                                                class="fa-solid fa-trash-can"></i></a> --}}
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
