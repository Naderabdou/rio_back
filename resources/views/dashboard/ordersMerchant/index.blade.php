@extends('dashboard.layouts.app')

@section('title', transWord('طلبات المنتجات التجار'))

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
                                            href="{{ route('admin.order-merchants.index') }}">{{ transWord('طلبات المنتجات التجار') }}</a>
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
                                    href="{{ route('admin.ads.create') }}"><i class="mr-1"
                                        data-feather="circle"></i><span class="align-middle">{{ __('models.item') }}
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
                                            <th>{{ transWord('رقم الطلب') }}</th>
                                            <th>{{ transWord('اسم المستخدم') }}</th>
                                            <th>{{ transWord('البريد الإلكترونى') }}</th>
                                            <th>{{ transWord('رقم الجوال') }}</th>
                                            <th>{{ transWord('حالة الطلب') }}</th>
                                            <th>{{ transWord('الخصم') }}</th>
                                            <th>{{ transWord('الإجراءات') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order->order_number }}</td>
                                                <td>{{ $order->name }}</td>
                                                <td>
                                                    <a href="mailto:{{ $order->email }}">{{ $order->email }}</a>
                                                </td>
                                                <td>
                                                    <a href="tel:{{ $order->phone }}">{{ $order->phone }}</a>
                                                </td>
                                                <td>
                                                    @if ($order->status === 'pending')
                                                        <span class="badge badge-primary">
                                                            {{ transWord($order->status) }}
                                                        </span>
                                                    @elseif ($order->status === 'pocessing')
                                                        <span class="badge badge-secondary">
                                                            {{ transWord($order->status) }}
                                                        </span>
                                                    @elseif ($order->status === 'driving')
                                                        <span class="badge badge-dark">
                                                            {{ transWord($order->status) }}
                                                        </span>
                                                    @elseif ($order->status === 'completed')
                                                        <span class="badge badge-success">
                                                            {{ transWord($order->status) }}
                                                        </span>
                                                    @elseif ($order->status === 'shipped')
                                                        <span class="badge badge-success">
                                                            {{ transWord($order->status) }}
                                                        </span>
                                                        {{-- @elseif ($order->status === 'declined')
                                                        <span class="badge badge-danger">
                                                            {{ transWord($order->status) }}
                                                        </span> --}}
                                                    @endif
                                                </td>
                                                <td>{{ $order->discount ?? 0 }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">

                                                        <a href="{{ route('admin.order-merchants.show', $order->id) }}"
                                                            class="btn btn-sm btn-warning"><i class="far fa-eye"></i>
                                                        </a>

                                                        <a href="#" class="btn btn-info btn-circle btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#exampleModalLong{{ $order->id }}">
                                                            <i class="fas fa-tag"></i>
                                                        </a>

                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-sm btn-primary dropdown-toggle"
                                                                data-toggle="dropdown">
                                                                {{ transWord('تغير الحالة') }}
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                {{-- <a class="dropdown-item"
                                                                    href="{{ route('admin.orders.changeStatus', ['id' => $order->id, 'status' => 'pending']) }}">{{ transWord('Pending') }}</a> --}}
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.order-merchants.changeStatus', ['id' => $order->id, 'status' => 'pocessing']) }}">{{ transWord('Processing') }}</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.order-merchants.changeStatus', ['id' => $order->id, 'status' => 'shipped']) }}">{{ transWord('shipped') }}</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.order-merchants.changeStatus', ['id' => $order->id, 'status' => 'driving']) }}">{{ transWord('Driving') }}</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.order-merchants.changeStatus', ['id' => $order->id, 'status' => 'completed']) }}">{{ transWord('Completed') }}</a>
                                                                {{-- <a class="dropdown-item"
                                                                    href="{{ route('admin.orders.changeStatus', ['id' => $order->id, 'status' => 'declined']) }}">{{ transWord('Declined') }}</a> --}}
                                                            </div>
                                                        </div>


                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="exampleModalLong{{ $order->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                                {{ transWord('اضافه خصم') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="disscount_form"
                                                            action="{{ route('admin.order-merchants.update', $order->id) }}"
                                                            method="POST">
                                                            <div class="modal-body">


                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group ">
                                                                    <label for="discount">{{ transWord('الخصم') }}</label>
                                                                    <input type="number" name="discount" id="discount"
                                                                        required class="form-control"
                                                                        value="{{ $order->discount }}">
                                                                </div>



                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-primary">{{ transWord('save') }}</button>
                                                                <button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">{{ __('إغلاق') }}</button>
                                                            </div>
                                                        </form>
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
    @endpush
@endsection
