<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('dashboard.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('dashboard.sliders.create');
    }

    public function store(SliderRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        Slider::create($data);

        return redirect()->route('admin.sliders.index')->with('success', transWord('Slider Created Successfully'));
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('dashboard.sliders.edit', compact('slider'));
    }

    public function update(SliderRequest $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        $slider->update($data);

        return redirect()->route('admin.sliders.index')->with('success', transWord('Slider Updated Successfully'));
    }

    public function destroy($id)
    {

        $slider = Slider::findOrFail($id);
        if ($slider->icon) {
            Storage::disk('public')->delete($slider->icon);
        }
        $slider->delete();
        return response()->json(['message' => transWord('تم الحذف بنجاح')]);
    }

    public function show()
    {
        return redirect()->route('admin.sliders.index');
    }
}
