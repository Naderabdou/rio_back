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
        $data = $request->except(['key_ar', 'key_en', 'value_ar', 'value_en']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $product = Product::create($data);

        if ($request->key_ar) {
            foreach ($request->key_ar as $key => $value) {
                $product->details()->create([
                    'key_ar' => $value,
                    'key_en' => $request->key_en[$key],
                    'value_ar' => $request->value_ar[$key],
                    'value_en' => $request->value_en[$key],
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', transWord('Product added successfully'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('dashboard.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(ProductRequest $request,$id){

        $product = Product::findOrFail($id);
        $data = $request->except(['key_ar', 'key_en', 'value_ar', 'value_en']);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $product->update($data);

        if ($request->key_ar) {
            $product->details()->delete();
            foreach ($request->key_ar as $key => $value) {
                $product->details()->create([
                    'key_ar' => $value,
                    'key_en' => $request->key_en[$key],
                    'value_ar' => $request->value_ar[$key],
                    'value_en' => $request->value_en[$key],
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', transWord('Product updated successfully'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {

            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return response()->json(['status' => 'success', 'message' => 'Product deleted successfully']);
    }

    public function Addimages($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.products.Addimages', compact('product'));
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
