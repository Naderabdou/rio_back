<li>
    <div class="img-product-cart-header">
        <img src="{{ $item->products->image_path }}" alt="">
    </div>
    <div class="text-product-cart-header">
        <h2> <span> {{ $item->product_name }}</span>
            <button class="remove-cart-header"> <i class="bi bi-trash"></i></button>
        </h2>
        <div>
            <span> {{ $item->quantity }}</span>
            <div class="price-cart-header"> EGP {{ $item->price }} <span class="old-price"> {{ $item->products->price_after_discount ?? 0 }} EGP </span></div>
        </div>
    </div>
</li>
