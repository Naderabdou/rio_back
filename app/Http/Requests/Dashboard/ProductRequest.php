<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     //   dd($this->all());
        return [
            'name_ar' => 'required|string|min:3|max:255',
            'name_en' => 'required|string|min:3|max:255',
            'sub_title_ar' => 'required|string|min:3|max:255',
            'sub_title_en' => 'required|string|min:3|max:255',
            'label_ar' => 'required|string|min:3|max:255',
            'label_en' => 'required|string|min:3|max:255',
            'label_color' => 'required|string|min:3|max:255',
            'price' => 'required|numeric',
            'list_price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'price_after_discount' => 'numeric|nullable',
            // 'stock' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'has_offer' => 'required|in:0,1',
            'desc_ar' => 'required|string|min:3',
            'desc_en' => 'required|string|min:3 ',
            'image' => request()->method() == 'POST' ? 'required||image|mimes:jpeg,png,jpg,gif,svg' : 'nullable||image|mimes:jpeg,png,jpg,gif,svg',

            // 'key_ar' => 'nullable|array',
            // 'key_ar.*' => 'required|string|min:2|max:255',
            // 'key_en' => 'nullable|array|min:1',
            // 'key_en.*' => 'required|string|min:2|max:255',
            // 'value_ar' => 'nullable|array|min:1',
            // 'value_ar.*' => 'required|string|max:255',
            // 'value_en' => 'nullable|array|min:1',
            // 'value_en.*' => 'required|string|max:255',

            'code_product' => request()->method() == 'POST' ? 'required|string|min:3|max:255|unique:products,code_product' : 'nullable|string|min:3|max:255|unique:products,code_product,' . $this->id,
            'dimensions_product' => 'required|string|min:3|max:255',
            'dimensions_carton' => 'required|string|min:3|max:255',
            'num_carton' => 'required',
            'size_carton' => 'required',
            'weight_carton' => 'required',
            'color' => 'required|array',
            'color.*' => 'required|string|min:3|max:255',

        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'key_ar.*.required' => transWord('The key Arabic field is required'),
            'key_en.*.required' => transWord('The key English field is required'),
            'value_ar.*.required' => transWord('The value Arabic field is required'),
            'value_en.*.required' => transWord('The value English field is required'),


        ];
    }
}
