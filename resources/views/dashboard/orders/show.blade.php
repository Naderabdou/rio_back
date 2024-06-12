@extends('dashboard.layouts.app')

@section('title', transWord('طلبات المنتجات'))

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="invoice-preview-wrapper">

                    <div class="row invoice-preview">

                        <div class="col-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h4 class="card-title text-primary">{{ transWord('بيانات العميل') }}</h4>
                                    <hr>
                                    <ul class="list-unstyled">
                                        <li><b class="text-primary">{{ transWord('الاسم') }} : </b> {{ $order->name }}</li>
                                        <li><b class="text-primary">{{ transWord('الايميل') }} : </b> {{ $order->email }}</li>
                                        <li><b class="text-primary"> {{ transWord('رقم الجوال') }} : </b> {{ $order->phone }}</li>
                                        <li><b class="text-primary"> {{ transWord('العنوان') }} : </b> {{ $order->address }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h4 class="card-title text-primary">{{ transWord('تفاصيل الطلب') }}</h4>
                                    <hr>
                                    <ul class="list-unstyled">
                                        <li><b class="text-primary"> {{ transWord('رقم الطلب') }} : </b> {{ $order->order_number }}</li>
                                        <li><b class="text-primary"> {{transWord('تاريخ الطلب')}} : </b> {{ $order->date }}</li>
                                        <li><b class="text-primary">  {{transWord('حالة الطلب')}} : </b>
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
                                            @elseif ($order->status === 'declined')
                                            <span class="badge badge-warning">
                                                {{ transWord($order->status) }}
                                            </span>
                                        @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h4 class="card-title text-primary">{{ transWord('تفاصيل السعر') }}</h4>
                                    <hr>
                                    <ul class="list-unstyled">
                                        <li><b class="text-primary"> {{ transWord('السعر الكلي') }} : </b> {{ $order->total_price }}</li>
                                        <li><b class="text-primary"> {{transWord('الخصم')}} : </b> {{ $order->discount  }}</li>
                                        <li><b class="text-primary"> {{transWord('السعر السعر الكلي بعد الخصم')}} : </b> {{ $order->price_befor_discount }}</li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h4 class="card-title text-primary">{{ transWord('تفاصيل اخرى') }}</h4>
                                    <hr>
                                    <ul class="list-unstyled">
                                        <li><b class="text-primary"> {{ transWord('كود الكوبون') }} : </b> {{ $order->coupon_code ?? transWord('لايوجد ') }}</li>
                                        <li><b class="text-primary"> {{transWord('سعر الكوبون')}} : </b> {{ $order->coupon_price ?? transWord('لايوجد ') }}</li>
                                        <li><b class="text-primary"> {{transWord('وسيله الدفع')}} : </b> {{ $order->payment_method ?? transWord('لايوجد ')}}</li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row invoice-preview">
                        <!-- Invoice -->
                        <div class="col-xl-12 col-md-8 col-12">
                            <div class="card invoice-preview-card">


                                <div class="card-body invoice-padding pb-0">
                                    <!-- Invoice Description starts -->
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="py-1">#</th>
                                                    <th class="py-1">{{ transWord('الصورة') }}</th>
                                                    <th class="py-1">{{ transWord('اسم المنتج') }}</th>
                                                    <th class="py-1">{{ transWord('السعر') }}</th>
                                                    <th class="py-1">{{ transWord('الكميه') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->orderItems as $orderItem)
                                                    <tr>
                                                        <td class="py-1">
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td class="py-1">
                                                            <img src="{{ $orderItem->courses?->image_path }}"
                                                                width="100px" height="100px">
                                                        </td>
                                                        <td class="py-1">
                                                            {{ $orderItem->product_name }}
                                                        </td>
                                                        <td class="py-1">
                                                            {{ $orderItem->price }}
                                                        </td>

                                                        <td class="py-1">
                                                            {{ $orderItem->quantity }}
                                                        </td>





                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Invoice Description ends -->
                                </div>
                            </div>
                        </div>
                        <!-- /Invoice -->
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->
    @push('js')
        <script src="{{ asset('dashboard/app-assets/js/custom/custom-delete.js') }}"></script>
    @endpush
@endsection
