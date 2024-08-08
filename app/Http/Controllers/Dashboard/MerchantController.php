<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MerchantRequest;

class MerchantController extends Controller
{
    public function index()
    {
        $merchants = User::role('merchant')->latest()->get();
        return view('dashboard.merchants.index', compact('merchants'));
    }

    public function create()
    {
        return view('dashboard.merchants.create');
    }

    public function store(MerchantRequest $request)
    {
        $data = $request->validated();

        $merchant = User::create($data);
        $merchant->assignRole('merchant');

        return redirect()->route('admin.merchants.index')->with('success', transWord('تم اضافة التاجر بنجاح'));
    }

    public function edit($id)
    {
        $merchant = User::role('merchant')->findOrFail($id);
        return view('dashboard.merchants.edit', compact('merchant'));
    }

    public function update(MerchantRequest $request, $id)
    {
        $data = $request->validated();

        $merchant = User::role('merchant')->findOrFail($id);
        $merchant->update($data);

        return redirect()->route('admin.merchants.index')->with('success', transWord('تم تعديل التاجر بنجاح'));
    }
    public function password($id)
    {
        $user = User::role('merchant')->findOrFail($id);
        return view('dashboard.merchants.password', compact('user'));
    }


    public function passwordUpdate(Request $request){
        $request->validate([
            //'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
        ], [
            // 'old_password.required' => transWord('old_password_required'),
            // 'old_password.min' => transWord('old_password_min'),
            'password.required' => transWord('password_required'),
        ]);

        $user = User::role('merchant')->findOrFail($request->id);
        $user->update(['password' => $request->password]);

        return redirect()->route('admin.merchants.index')->with('success', transWord('تم تعديل كلمة المرور بنجاح'));
    }


    public function destroy($id)
    {
        $merchant = User::role('merchant')->findOrFail($id);
        $merchant->delete();

        return response()->json(['message' => transWord('تم حذف التاجر بنجاح')]);
    }

}
