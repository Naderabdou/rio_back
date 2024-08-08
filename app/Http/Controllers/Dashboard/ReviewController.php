<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\ProductReviews;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductReviews::latest()->get();
        return view('dashboard.reviews.index', compact('reviews'));
    }

    public function destroy($id)
    {
        $review = ProductReviews::findOrFail($id);
        $review->delete();

        return response()->json(['message' => transWord('تم حذف التقييم بنجاح')]);
    }

    public function changeStatus(Request $request)
    {
        $review = ProductReviews::find($request->id);
        $review->update([
            'is_active' => ! $review->is_active
        ]);
        return response()-> json(['message' => transWord('Status changed successfully')]);
    }
}
