<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\ImagesRequest;
use App\Http\Requests\Dashboard\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('dashboard.products.create', compact('categories', 'brands'));
    }



    public function store(ProductRequest $request)
    {
        $data = $request->except(['color', 'dimensions_product', 'dimensions_carton', 'num_carton', 'size_carton', 'weight_carton']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $product = Product::create($data);

        $product->details()->create([
            'color' => $request->color,
            'dimensions_product' => $request->dimensions_product,
            'dimensions_carton' => $request->dimensions_carton,
            'num_carton' => $request->num_carton,
            'size_carton' => $request->size_carton,
            'weight_carton' => $request->weight_carton,

        ]);

        return redirect()->route('admin.products.index')->with('success', transWord('Product added successfully'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::all();
        $brands = Brand::all();
        return view('dashboard.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->except(['color', 'dimensions_product', 'dimensions_carton', 'num_carton', 'size_carton', 'weight_carton']);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $product->update($data);

        $product->details()->update([
            'color' => $request->color,
            'dimensions_product' => $request->dimensions_product,
            'dimensions_carton' => $request->dimensions_carton,
            'num_carton' => $request->num_carton,
            'size_carton' => $request->size_carton,
            'weight_carton' => $request->weight_carton,

        ]);

        return redirect()->route('admin.products.index')->with('success', transWord('Product updated successfully'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {

            Storage::disk('public')->delete($product->image);
        }
        if ($product->orderItems()->count() > 0) {
            foreach ($product->orderItems as $orderItem) {
                // Calculate the old total price of the item
                $oldTotalPrice = $orderItem->price * $orderItem->quantity;

                // Determine the price after discount if applicable
                $effectivePrice = $product->discount ? $product->price_after_discount : $product->price;

                // Calculate the total discount amount for the item
                $totalDiscountAmount = $effectivePrice * $orderItem->quantity;

                // Retrieve the user's cart

                $order = $orderItem->order;
                // Calculate the new total and price before discount for the cart
                $newTotalPrice = $order->total_price - $oldTotalPrice;
                $newPriceBeforeDiscount = $order->price_before_discount - $totalDiscountAmount;

                // Update the cart with the new totals
                $order->update([
                    'price_before_discount' => $newPriceBeforeDiscount,
                    'total_price' => $newTotalPrice,
                ]);
            }
            $product->orderItems()->delete();
        }
        $product->delete();


        return response()->json(['status' => 'success', 'message' => 'Product deleted successfully']);
    }

    public function Addimages($id)
    {

        $product = Product::findOrFail($id);
        return view('dashboard.products.Addimage', compact('product'));
    }

    public function StoreImage(Request $request)
    {


        $data = $request->except('file');

        $data['image'] = $request->file('file')->store('product_images', 'public');

        $id =  ProductImages::create($data);


        return response()->json(
            [
                'message' => 'Image added successfully',
                'status' => 200,
                'data' => $data['image'],
                'id' => $id->id
            ]
        );
    }

    public function DestroryImage($id)
    {
        $ProductImage = ProductImages::find($id);
        Storage::disk('public')->delete($ProductImage->image);

        $ProductImage->delete();
        return redirect()->back()->with('success', transWord('Image deleted successfully'));
    }

    public function DestroryImageFile(Request $request)
    {


        Storage::disk('public')->delete($request->filename);
        ProductImages::where('image', $request->filename)->delete();
        return response()->json();
    }

    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->update(['is_active' => !$product->is_active]);
        return response()->json(['status' => 'success', 'message' => 'Status updated successfully']);
    }
}
