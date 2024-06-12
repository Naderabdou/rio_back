<?php

namespace App\Http\Controllers\Dashboard;

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
        return view('dashboard.values.create');
    }

    public function store(OurValueRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('OurValue', 'public');
        }
        OurValue::create($data);
        return redirect()->route('admin.ourValues.index')->with('success', transWord('تم اضافة القيمة بنجاح'));
    }

    public function edit($id)
    {
        $OurValue = OurValue::findOrfail($id);
        return view('dashboard.values.edit', compact('OurValue'));
    }

    public function update(OurValueRequest $request , $id){

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


        return response()->json(['message' => transWord('OurValue deleted successfully')] , 200);
    }

    public function show($id){
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
