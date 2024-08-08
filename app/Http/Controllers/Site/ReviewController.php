<?php

namespace App\Http\Controllers\site;

use Illuminate\Http\Request;
use App\Models\ProductReviews;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ReviewRequest;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request){
        // if(!auth()->check()){
        //     return response()->json(['error'=>transWord('يجب تسجيل الدخول اولا')], 401);

        // }
        if(ProductReviews::where('user_id',auth()->user()->id)->where('product_id',$request->product_id)->exists()){
            return redirect()->back()->with('error',transWord('لقد قمت بتقيم هذا المنتج مسبقا'));
        }
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $review = ProductReviews::create($data);
        return redirect()->back()->with('success',transWord('جاري مراجعة تقيمك'));
        // return response()->json(['success'=>transWord('تم اضافة تقيمك بنجاح'),'rating' => $review->rating , 'review'=>$review->review,'name'=>auth()->user()->name,'image'=>auth()->user()->image_path], 201);


    }
}
