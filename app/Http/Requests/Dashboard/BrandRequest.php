<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'name_ar' => request()->method() == 'post' ? 'required|string|max:255|min:3|unique:brands,name_ar' : 'required|string|max:255|min:3|unique:brands,name_ar,' . $this->id,
            'name_en' => request()->method() == 'post' ? 'required|string|max:255|min:3|unique:brands,name_en' : 'required|string|max:255|min:3|unique:brands,name_en,' . $this->id,
        ];
    }
}
