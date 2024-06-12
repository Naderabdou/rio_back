<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\FeatureRequest;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::latest()->get();
        return view('dashboard.features.index', compact('features'));
    }

    public function create()
    {
        return view('dashboard.features.create');
    }

    public function store(FeatureRequest $request)
    {


        $data = $request->validated();

        if ($request->hasFile('icon')) {
            // $file =  $request->file('icon');

            // $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
            // $fileName = $fileHash . '.' . $file->getClientOriginalExtension();




            // $path = Storage::disk('public')->putFileAs('feature', $file, $fileName);
            // $data['icon'] = $path;

            $data['icon'] = $request->file('icon')->store('features', 'public');
        }


        Feature::create($data);
        return redirect()->route('admin.features.index')->with('success', transWord('تم الاضافة بنجاح'));
    }

    public function edit($id)
    {
        $feature = Feature::findOrFail($id);
        return view('dashboard.features.edit', compact('feature'));
    }

    public function update(FeatureRequest $request, $id)
    {
        $feature = Feature::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            if ($feature->icon) {
                Storage::disk('public')->delete($feature->icon);
            }
            $data['icon'] = $request->file('icon')->store('features', 'public');
        }
        $feature->update($data);
        return redirect()->route('admin.features.index')->with('success', transWord('تم التعديل بنجاح'));
    }

    public function destroy($id)
    {

        $feature = Feature::findOrFail($id);
        if ($feature->icon) {
            Storage::disk('public')->delete($feature->icon);
        }
        $feature->delete();
        return response()->json(['message' => transWord('تم الحذف بنجاح')]);
    }

    public function show()
    {
        return redirect()->route('admin.features.index');
    }
}
