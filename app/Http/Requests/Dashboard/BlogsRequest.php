<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class BlogsRequest extends FormRequest
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title_ar' => 'required|string|min:3|max:255',
            'title_en' => 'required|string|min:3|max:255',
            'desc_ar' => 'required|string|min:3',
            'desc_en' => 'required|string|min:3',
            'image' => request()->method() == 'POST' ? 'required|image|mimes:jpeg,png,jpg,svg|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ];
    }
}
