<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('site.profile.index', compact('user'));
    }

    public function update(ProfileRequest $request)
    {

        $data = $request->validated();
        $user = auth()->user();
        $user->update($data);



        return response()->json(['message' => transWord('Profile updated successfully'), 'name' => $user->name, 'email' => $user->email, 'phone' => $user->phone]);



      //  $user->update($data);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();
        $user->update(['password' => bcrypt($request->password)]);

        return response()-> json(['message' => transWord('Password updated successfully')]);
    }

    public function changePassword()
    {
        $user = auth()->user();
        return view('site.profile.password', compact('user'));
    }
}
