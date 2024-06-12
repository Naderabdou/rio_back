<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('site.cart');
    }

    public function store(Request $request)
    {

        $product = Product::findorFail($request->id);

        $cart = auth()->user()->cart()->firstOrCreate(
            [
                'user_id' => auth()->id(),
                'status' => 'pending',
                'type' => 'cart'

            ],
            [
                'order_number' => '#' . uniqid() ,
                'status' => 'pending',
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone,
                'address' => auth()->user()->address->first()->address ?? null,
                'city' => auth()->user()->address->first()->city ?? null,
                'country' => auth()->user()->address->first()->country ?? null,


                ]
            );
                if ($cart->orderItems()->where('product_id', $product->id)->exists()) {
            return response()->json(['message' => transWord('هذا المنتج موجودة بالفعل في سلة المشتريات'),
                'type' => 'error']);
        }

        $item =$cart->orderItems()->create([
            'product_id' => $product->id,
            'price' => $product->price,
            'product_name' => $product->name,
            'quantity' => $request->quantity ?? 1,


        ]);

    //    return view('site.components.addCart',compact('item'))->render();

        return response()->json(['message' => transWord('تمت الاضافة بنجاح'),
            'type' => 'success',
            'item' => $item,
            'cart' => $cart->orderItems()->count()]);

    }
}
