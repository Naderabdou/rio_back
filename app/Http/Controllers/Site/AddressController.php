<?php

namespace App\Http\Controllers\Site;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\AdderssRequest;
use App\Models\Address;

class AddressController extends Controller
{
    public function index()
    {
        if(request()->ajax()){
            $cities = City::where('governorate_id', request()->governorate_id)->get();
            $adrees = auth()->user()->address->where('governorate_id', request()->governorate_id)->first();
            return response()->json(['cities' => $cities, 'adrees' => $adrees]);
        }else{
            $cities = City::all();
        }

        $governorates = Governorate::all();
        $user = auth()->user()->address()->get();
        return view('site.profile.address', compact('cities', 'governorates', 'user'));
    }

    public function store(AdderssRequest $request){
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        Address::create($data);


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
        return redirect()->back()->with('success', transWord('Address deleted successfully'));
    }
    public function cities(Request $request)
    {

        $cities = City::where('governorate_id', $request->governorate_id)->get();
       // dd($cities);
        return response()->json($cities);

    }
}
