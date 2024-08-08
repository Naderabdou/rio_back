<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('dashboard.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('dashboard.brands.create');
    }

    public function store(BrandRequest $request)
    {
        $data = $request->validated();


        Brand::create($data);
        return redirect()->route('admin.brands.index')->with('success', trans('تم اضافه ماده التصنيع بنجاح'));
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('dashboard.brands.edit', compact('brand'));
    }

    public function update(BrandRequest $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $data = $request->validated();

        $brand->update($data);
        return redirect()->route('admin.brands.index')->with('success', transWord('تم تعديل  ماده التصنيع  بنجاح'));
    }

    public function destroy($id)
    {
        $Brand = Brand::findOrFail($id);

        $Brand->delete();
        return response()->json(['message' => 'success']);
    }
}
