<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name_ar' => 'required|string|min:4',
            'name_en' => 'required|string|min:4',
            'image' => request()->method() == 'POST' ? 'required|image|mimes:jpeg,png,jpg,svg|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
        ];
    }
}
