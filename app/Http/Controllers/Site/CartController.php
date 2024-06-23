<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart()->wherehas('orderItems')->first();

        return view('site.cart.index', compact('cart'));
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
            'quantity' => 1,


        ]);
        // dd($request->quantity);
        $totalPrice = $cart->price_before_discount + $product->totalPrice ;
        $cart->update([
            'total_price' => $cart->total_price + $product->totalPrice,
            'discount' => $cart->discount + $product->discount,

            'price_before_discount' => $totalPrice,

        ]);

            return view('site.components.addCart',compact('item'))->render();

        // return response()->json([
        //     'message' => transWord('تمت الاضافة بنجاح'),
        //     'type' => 'success',
        //     'item' => $item,
        //     'cart' => $cart->orderItems()->count()
        // ]);
    }

    public function update(Request $request)
    {

        $item = auth()->user()->cart->orderItems()->find($request->id);
        $oldprice = $item->price; //50
        $oldQuentity = $item->quantity; //2
        $totalOldPrice = $oldprice * $oldQuentity; //100
        $totalNewPrice = $oldprice * $request->quantity; //150
        $totalcart = auth()->user()->cart->price_before_discount; //200
        $total =  $totalcart - $totalOldPrice + $totalNewPrice;

        $item->update([
            'quantity' => $request->quantity
        ]);

        $cart = auth()->user()->cart->update([
            'total_price' => $totalNewPrice,
            // 'price_before_discount' => $total,
        ]);
       return response()->json([
            'message' => transWord('تم التعديل بنجاح'),
            'type' => 'success',
            'id' => $item->id,
            'total' => $item->quantity * $item->price,
            'quantity' => $item->quantity,
            'price' => $item->price * ($request->quantity - $oldQuentity),
        ]);



        // if($request->quantity <=0){
        //     $request->quantity = 1;

        // }
        // $item->update([
        //     'quantity' => $request->quantity
        // ]);
        // $cart = auth()->user()->cart->update([
        //     'price_before_discount' =>$total,
        // ]);

        // return response()->json([
        //     'message' => transWord('تم التعديل بنجاح'),
        //     'type' => 'success',
        //     'id' => $item->id,
        //     'total' => $item->quantity * $item->price,
        //     'quantity' => $item->quantity,
        //     'price' => $item->price * ($request->quantity - $old),
        // ]);
    }

    public function destroy($id)
    {
        $item = auth()->user()->cart->orderItems()->find($id);

        $total = auth()->user()->cart->price_before_discount - ($item->price * $item->quantity);
        auth()->user()->cart->update([
            'price_before_discount' => $total,
        ]);
        $item->delete();

      //  return redirect()->back()->with('success', transWord('تم الحذف بنجاح'));

      return view('site.components.addCart',compact('item'))->render();

    }

    public function destroyIndex($id)
    {
        $item = auth()->user()->cart->orderItems()->find($id);

        $total = auth()->user()->cart->price_before_discount - ($item->price * $item->quantity);
        auth()->user()->cart->update([
            'price_before_discount' => $total,
        ]);
        $item->delete();

       return redirect()->back()->with('success', transWord('تم الحذف بنجاح'));

    //   return view('site.components.addCart',compact('item'))->render();

    }

    public function coupon(Request $request)
    {

        $coupon = Coupon::where('code', $request->code)->where('is_active', 1)->first();

        if (!$coupon) {
            return response()->json([
                'message' => transWord('الكوبون غير صالح'),
                'type' => 'error',
            ]);
        }



        $cart = auth()->user()->cart;
        if ($cart->coupon_code) {
            return response()->json([
                'message' => transWord('لا يمكن استخدام اكثر من كوبون'),
                'type' => 'error',
            ]);
        }

        $cart->update([
            'coupon_code' => $request->code,
            'coupon_value' => $coupon->value,

        ]);

        return response()->json([
            'message' => transWord('تم الخصم بنجاح بنجاح'),
            'type' => 'success',
            'coupon' => $coupon->value,
        ]);
    }
}
