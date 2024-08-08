<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\BannerRequest;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('dashboard.banners.index', compact('banners'));
    }

    public function create()
    {
        $products = Product::where('is_active', 1)->get();
        return view('dashboard.banners.create', compact('products'));
    }

    public function store(BannerRequest $request)
    {

        $data = $request->except('color_title', 'color_btn', 'color_ground');


        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banner', 'public');
        }

        $data['color'] = [
            'color_title' => $request->color_title,
            'color_btn' => $request->color_btn,
            'color_ground' => $request->color_ground,
        ];


        Banner::create($data);

        return redirect()->route('admin.banners.index')->with('success', transWord('Banner created successfully'));
    }

    public function edit($id)
    {
        $products = Product::where('is_active', 1)->get();

        $banner = Banner::findOrFail($id);
        return view('dashboard.banners.edit', compact('banner', 'products'));
    }

    public function update(BannerRequest $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $data = $request->except('color_title', 'color_btn', 'color_ground');

        if ($request->hasFile('image')) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            $data['image'] = $request->file('image')->store('banner', 'public');
        }

        $data['color'] = [
            'color_title' => $request->color_title,
            'color_btn' => $request->color_btn,
            'color_ground' => $request->color_ground,
        ];

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', transWord('Banner updated successfully'));
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return response()->json(['message' => 'Banner deleted successfully']);
    }
}
