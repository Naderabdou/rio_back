@forelse ($products as $product)
<div class="col-lg-6">
    <div class="sub-product">
        <a href="{{ route('site.products.show', $product->id) }}">
            <div class="img-sub-product">
                <img src="{{ $product->image_path }}" alt="">
            </div>

            <div class="text-sub-product">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->sub_title }}</p>
                <div class="product-price">
                    <h3>{{ $product->price }} </h3>
                    <h4> {{ $product->price_after_discount }} </h4>
                </div>
            </div>
            <div style="background-color: {{ $product->label_color }}"
                class="discount sub-tools"> {{ $product->label }} </div>
        </a>
        <div class="btns-product">
            <a href="{{ route('site.products.show', $product->id) }}"
                class="ctm-btn3 w-100">{{ transWord('مشاهدة المنتج') }}</a>
            <a href=""  class="{{ auth()->user() ? 'btn-cart' : 'auth_login' }}">
                <svg width="32" height="33" viewBox="0 0 32 33" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2.6665 3.16665H4.98651C6.42651 3.16665 7.55984 4.40665 7.43984 5.83332L6.33317 19.1133C6.1465 21.2866 7.86649 23.1533 10.0532 23.1533H24.2532C26.1732 23.1533 27.8532 21.58 27.9998 19.6733L28.7198 9.67332C28.8798 7.45999 27.1998 5.65998 24.9732 5.65998H7.75985"
                        stroke="#333333" stroke-width="1.8" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M21.6667 29.8333C22.5871 29.8333 23.3333 29.0871 23.3333 28.1667C23.3333 27.2462 22.5871 26.5 21.6667 26.5C20.7462 26.5 20 27.2462 20 28.1667C20 29.0871 20.7462 29.8333 21.6667 29.8333Z"
                        stroke="#333333" stroke-width="1.8" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M11.0002 29.8333C11.9206 29.8333 12.6668 29.0871 12.6668 28.1667C12.6668 27.2462 11.9206 26.5 11.0002 26.5C10.0797 26.5 9.3335 27.2462 9.3335 28.1667C9.3335 29.0871 10.0797 29.8333 11.0002 29.8333Z"
                        stroke="#333333" stroke-width="1.8" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12 11.1667H28" stroke="#333333" stroke-width="1.8"
                        stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </div>
</div>
@empty
@endforelse
