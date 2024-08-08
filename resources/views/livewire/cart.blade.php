<div>

    <div class="title-cart-header" data-count="{{ auth()->user()?->cart?->orderItems?->count() ?? 0 }}">
        <h2> {{ transWord('عربة التسوق ') }}</h2>
        <div class="close-cart-header"><i class="bi bi-x-circle"></i></div>
    </div>

    <div class="product-cart-header">
        <ul>
            @if (auth()->user() && auth()->user()->cart)
                @php
                    $orderItems = auth()->user()->cart;
                @endphp
                @forelse ($orderItems->orderItems as $item)
                    <li>
                        <div class="img-product-cart-header">
                            <img src="{{ $item?->products?->image_path }}" alt="">
                        </div>
                        <div class="text-product-cart-header">
                            <h2> <span> {{ $item->product_name }}</span>
                                <button class="remove-cart-header"
                                    data-url="{{ route('site.cart.destroy', $item->id) }}"> <i
                                        class="bi bi-trash"></i></button>
                            </h2>
                            <div>
                                <span> {{ $item->quantity }}</span>
                                <div class="price-cart-header"> {{ $item->price }} جنية

                                    {{-- <span class="old-price">  {{ $item->products->price_after_discount ?? $item->price }} جنية </span> --}}

                                </div>
                            </div>
                        </div>
                    </li>
                @empty

                    <h3 id="order_emty">
                        {{ transWord('لا يوجد منتجات في العربة') }}
                    </h3>
                @endforelse
            @else
                <h3 id="order_emty">
                    {{ transWord('لا يوجد منتجات في العربة') }}
                </h3>


            @endif



        </ul>
    </div>
    @if (auth()->user() && auth()->user()->cart)
        @if ($orderItems->orderItems->count() > 0)
            <div class="btns-cart-header">
                <div class="total-cart-header pb-3">
                    <h2> {{ transWord('المجموع') }} <span> {{ $orderItems->price_before_discount }} جنية
                        </span>
                    </h2>
                </div>
                <a href="{{ route('site.cart') }}" class="w-100 mt-2 ctm-btn2">
                    {{ transWord('مشاهدة عربة التسوق') }}</a>
                <a href="{{ route('site.checkout') }}"
                    class="w-100 mt-2 ctm-btn">{{ transWord('اتمام عملية الشراء') }}</a>
            </div>
        @endif
    @endif

</div>
