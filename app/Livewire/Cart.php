<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public function addToCart($productId, $quantity = 1)
    {
        $product = Product::findorFail($productId);


        $cart = auth()->user()->cart()->firstOrCreate(
            [
                'user_id' => auth()->id(),
                'status' => 'pending',
                'type' => 'cart'

            ],
            [
                'order_number' => '#' . rand(10000, 99999),
                'status' => 'pending',
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone,
                'address' => auth()->user()->address->first()->address ?? null,
                'city' => auth()->user()->address->first()->city->name ?? null,
                'country' => auth()->user()->address->first()->country->name ?? null,


            ]
        );


        if ($cart->orderItems()->where('product_id', $product->id)->exists()) {
            return response()->json([
                'message' => transWord('هذا المنتج موجودة بالفعل في سلة المشتريات'),
                'type' => 'error'
            ]);
        }

        $item = $cart->orderItems()->create([
            'product_id' => $product->id,
            'price' => $product->totalPrice,
            'product_name' => $product->name,
            'quantity' => $quantity ?? 1,


        ]);

        // dd($request->quantity);
        $totalPrice = $cart->price_before_discount + ($product->totalPrice * $item->quantity); // 900.5
        $cart->update([
            'total_price' => $totalPrice, //900.5
            // 'discount' => $cart->discount + $product->discount,

            'price_before_discount' => $totalPrice, //901

        ]);

        // return view('site.components.addCart', compact('item'))->render();

        // return response()->json([
        //     'message' => transWord('تمت الاضافة بنجاح'),
        //     'type' => 'success',
        //     'item' => $item,
        //     'cart' => $cart->orderItems()->count()
        // ]);
    }
    public function render()
    {
        return view('livewire.cart');
    }
}
