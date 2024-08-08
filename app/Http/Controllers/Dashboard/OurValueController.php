<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\OurValue;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\OurValueRequest;

class OurValueController extends Controller
{
    public function index()
    {
        $OurValue = OurValue::all();
        return view('dashboard.values.index', compact('OurValue'));
    }


    public function create()
    {
        $products = Product::where('is_active', 1)->get();

        return view('dashboard.values.create', compact('products'));
    }

    public function store(OurValueRequest $request)
    {
        $data = $request->validated();

        // Check and store the icon once, if provided
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('OurValue', 'public');
        }

        // Ensure product_id is present in the request
        if (!empty($request->product_id)) {
            foreach ($request->product_id as $product) {
              //  dd($product);
                // Update product_id for each entry
                $data['product_id'] = (int)$product;


                // Create OurValue entry with the prepared data
                OurValue::create($data);
            }
        }

        return redirect()->route('admin.ourValues.index')->with('success', transWord('تم اضافة القيمة بنجاح'));
    }

    public function edit($id)
    {
        $products = Product::where('is_active', 1)->get();

        $OurValue = OurValue::findOrfail($id);
        return view('dashboard.values.edit', compact('OurValue', 'products'));
    }

    public function update(OurValueRequest $request, $id)
    {

        $data = $request->validated();
        $OurValue = OurValue::findOrfail($id);
        if ($request->hasFile('icon')) {
            $data['icon'] = $this->handleIconUpload($request, $OurValue);
        }
        $OurValue->update($data);
        return redirect()->route('admin.ourValues.index')->with('success', transWord('تم تحديث القيمة بنجاح'));
    }

    public function destroy($id)
    {
        $OurValue = OurValue::findOrfail($id);

        if ($OurValue->icon) {
            Storage::disk('public')->delete($OurValue->icon);
        }
        $OurValue->delete();


        return response()->json(['message' => transWord('OurValue deleted successfully')], 200);
    }

    public function show($id)
    {
        return redirect()->route('admin.ourValues.index');
    }


    private function handleIconUpload($request, $OurValue)
    {
        if ($OurValue->icon) {
            Storage::disk('public')->delete($OurValue->icon);
        }

        return $request->file('icon')->store('OurValue', 'public');
    }
}
