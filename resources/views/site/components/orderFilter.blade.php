@forelse ($orders as $order)
<div class="orders-myacount">
    <div class="title-orders-myacount">
        <h2>{{ transWord('رقم الطلب') }} {{ $order->order_number }}</h2>
        <a href="{{ route('site.orders.show',$order->id) }}" class="ctm-btn2"> {{ transWord('تفاصيل الطلب') }}</a>
    </div>
    <ul>
        @foreach ($order->orderItems as $item )
        <li>
            <div class="img-order-myacount">
                <img src="{{ $item->products->image_path }}" alt="">
            </div>
            <div class="text-order-myacount">
                <h2>{{ $item->product_name }}</h2>
                <h3>EGP {{ $item->price }} </h3>
                <p>
                    {{ transWord('تم التوصيل في ') }} {{ transWord($order->address) }} , {{ $order->driving_at }}
                </p>
            </div>
        </li>
        @endforeach



    </ul>
</div>
@empty

<div class="orders-myacount">
    <div class="title-orders-myacount">
        <h2>{{ transWord('لا يوجد طلبات') }}</h2>
    </div>
</div>
@endforelse
