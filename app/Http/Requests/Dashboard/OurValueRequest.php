<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class OurValueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'required|integer|exists:products,id',
            'title_ar' =>  'required|string|min:3|max:255',
            'title_en' =>  'required|string|min:3|max:255',
            'icon' => request()->method() === 'POST' ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
