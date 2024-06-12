<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    public function index()
    {

          $favorites = auth()->user()->favorites;
        return view('site.favorite.index', compact('favorites'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $product = Product::find($request->id);
        if ($product) {

            $check_favorite = $product->favorites->contains('user_id', $user->id);
            if ($check_favorite) {
                $product->favorites()->where([
                    'user_id' => $user->id,
                ])->delete();



                    return response()->json(['status' => true, 'message' => transWord('Remove Product From Favorite Successfully')]);


            } else {
                $product->favorites()->create([
                    'user_id' => $user->id,
                ]);
                return response()->json(['status' => true, 'message' => transWord('Product Add To Favorite Successfully')]);
            }
        } else {
            return response()->json(['status' => false, 'message' => transWord('Product Not Found')]);
        }

    }

    public function destroy($id)
    {
        $user = auth()->user();
        $product = Product::find($id);

        if ($product) {
            $product->favorites()->where([
                'user_id' => $user->id,
            ])->delete();
            return \redirect()->back()->with('success', transWord('Product Remove From Favorite Successfully'));
        } else {
            return response()->json(['status' => false, 'message' => transWord('Product Not Found')]);
        }
    }
}
