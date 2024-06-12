<?php

namespace App\Http\Controllers\Site;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\AdderssRequest;

class AddressController extends Controller
{
    public function index()
    {

        $cities = City::all();
        $governorates = Governorate::all();
        $user = auth()->user();
        return view('site.profile.address', compact('cities', 'governorates', 'user'));
    }

    public function store(AdderssRequest $request){
        $user = auth()->user();
        
       $address= $user->address()->create($request->validated());
        return redirect()->back()->with('success', transWord('Address added successfully'));
    }

    public function update(AdderssRequest $request, $id){
        //dd($request->validated());
        $user = auth()->user();
        $user->address()->where('id', $id)->update($request->validated());
        return redirect()->back()->with('success', transWord('Address updated successfully'));
    }

    public function destroy($id){
        $user = auth()->user();
        $user->address()->where('id', $id)->delete();
        return response()->json(['message' => transWord('Address deleted successfully')]);
    }
    public function cities(Request $request)
    {
        $cities = City::where('governorate_id', $request->governorate_id)->get();
        return response()->json($cities);
    }
}
