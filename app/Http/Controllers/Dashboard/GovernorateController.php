<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GovernorateController extends Controller
{
    public function index()
    {
        $governorates = Governorate::latest()->get();
        return view('dashboard.governorates.index', compact('governorates'));
    }

    public function edit($id){
        $governorate = Governorate::findorfail($id);
        return view('dashboard.governorates.edit', compact('governorate'));
    }

    public function update(Request $request,$id)
    {
        $governorate = Governorate::findorfail($id);
        // dd($request->all());
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'tax' => 'required|numeric',
        ]);

        $governorate->update($request->all());
        return redirect()->route('admin.governorates.index')->with('success', transWord('governorate updated successfully'));
    }

    public function destroy ($id)
    {
        $governorate = Governorate::findorfail($id);
        $governorate->delete();
        return response()->json(['message' => 'success']);


    }
}
