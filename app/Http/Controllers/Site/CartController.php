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
        $price = auth()->user()->hasRole('merchant') ? $product->list_price : $product->total_price;

        $item = $cart->orderItems()->create([
            'product_id' => $product->id,
            'price' => $price,
            // 'price' => $product->totalPrice,
            'product_name' => $product->name,
            'quantity' => $request->quantity ?? 1,


        ]);

        // dd($request->quantity);
        //  $totalPrice = $cart->price_before_discount + ($product->totalPrice * $item->quantity); // 900.5
        $totalPrice = $cart->total_price + ($price * $item->quantity); // 900.5
        $cart->update([
            'total_price' => $totalPrice, //900.5
            // 'discount' => $cart->discount + $product->discount,

            'price_before_discount' => $totalPrice, //901

        ]);

        return view('site.components.addCart', compact('item'))->render();

        // return response()->json([
        //     'message' => transWord('تمت الاضافة بنجاح'),
        //     'type' => 'success',
        //     'item' => $item,
        //     'cart' => $cart->orderItems()->count()
        // ]);
    }

    public function update(Request $request)
    {



        //news
        // Ensure the requested quantity is at least 1
        $validatedQuantity = max(1, $request->quantity);

        // Retrieve the cart and the item
        $cart = auth()->user()->cart;
        $item = $cart->orderItems()->find($request->id);

        // Calculate the difference in quantity
        $quantityDifference = $validatedQuantity - $item->quantity;

        // Calculate the total price and discount price differences
        $totalPriceNew = $item->price * $quantityDifference;

        $totalDiscountPriceDifference = auth()->user()->hasRole('merchant') || $item->products->discount === null
            ? $totalPriceNew
            : $item->products->price_after_discount * $quantityDifference;

        // dd($totalDiscountPriceDifference);
        // Update the item quantity

        // Recalculate the cart's total price and price before discount
        $TotalPrice = $cart->total_price + $totalPriceNew;
        $PriceBeforeDiscount = $cart->price_before_discount + $totalDiscountPriceDifference;

        $item->update(['quantity' => $validatedQuantity]);
        // Update the cart
        $cart->update([
            'total_price' => $PriceBeforeDiscount,
            'price_before_discount' => $PriceBeforeDiscount,
        ]);

        // Prepare the response data
        $responseData = [
            'message' => transWord('تم التعديل بنجاح'),
            'type' => 'success',
            'id' => $item->id,
            'total_price' => $validatedQuantity * $item->price,
            'total_cart_price' => $TotalPrice,
            'total_cart_discount' => $PriceBeforeDiscount,
            'quantity' => $validatedQuantity,
        ];


        // Return the JSON response
        return response()->json($responseData);
    }

    public function destroy($id)
    {
        // Find the item in the user's cart
        $item = auth()->user()->cart->orderItems()->find($id);

        // Calculate the old total price of the item
        $oldTotalPrice = $item->price * $item->quantity;

        // Determine the price after discount if applicable
        $effectivePrice = $item->products->discount ? $item->products->price_after_discount : $item->products->price;

        // Calculate the total discount amount for the item
        $totalDiscountAmount = $effectivePrice * $item->quantity;

        // Retrieve the user's cart
        $cart = auth()->user()->cart;

        // Calculate the new total and price before discount for the cart
        $newTotalPrice = $cart->total_price - $oldTotalPrice;
        $newPriceBeforeDiscount = $cart->price_before_discount - $totalDiscountAmount;

        // Update the cart with the new totals
        $cart->update([
            'price_before_discount' => $newPriceBeforeDiscount,
            'total_price' => $newTotalPrice,
        ]);

        // Delete the item from the cart
        $item->delete();
        if ($cart->orderItems()->count() == 0) {

            $cart->delete();
        }
        //  return redirect()->back()->with('success', transWord('تم الحذف بنجاح'));

        return view('site.components.addCart', compact('item'))->render();
    }

    public function destroyIndex($id)
    {
        // Find the item in the user's cart
        $item = auth()->user()->cart->orderItems()->find($id);

        // Calculate the old total price of the item
        $oldTotalPrice = $item->price * $item->quantity;

        // Determine the price after discount if applicable
        $effectivePrice = $item->products->discount ? $item->products->price_after_discount : $item->products->price;

        // Calculate the total discount amount for the item
        $totalDiscountAmount = $effectivePrice * $item->quantity;

        // Retrieve the user's cart
        $cart = auth()->user()->cart;

        // Calculate the new total and price before discount for the cart
        $newTotalPrice = $cart->total_price - $oldTotalPrice;
        $newPriceBeforeDiscount = $cart->price_before_discount - $totalDiscountAmount;

        // Update the cart with the new totals
        $cart->update([
            'price_before_discount' => $newPriceBeforeDiscount,
            'total_price' => $newTotalPrice,
        ]);
        $item->delete();
        if ($cart->orderItems()->count() == 0) {

            $cart->delete();
        }
        // Delete the item from the cart


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
            // 'total_price' => $cart->total_price - $coupon->value,
            // 'price_before_discount' => $cart->price_before_discount - $coupon->value,

        ]);

        return response()->json([
            'message' => transWord('تم الخصم بنجاح بنجاح'),
            'type' => 'success',
            'coupon' => $coupon->value,
        ]);
    }
}
