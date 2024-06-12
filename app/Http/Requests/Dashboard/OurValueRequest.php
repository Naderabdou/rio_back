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
            'desc_en'  => 'required|min:3|string',
            'desc_ar'  => 'required|min:3|string',
            'title_ar' => request()->method() === 'POST' ? 'required|string|min:3|max:255|unique:our_values,title_ar' : 'required|string|min:3|max:255|unique:our_values,title_ar,' . $this->route('ourValue'),
            'title_en' =>  request()->method() === 'POST' ? 'required|string|min:3|max:255|unique:our_values,title_en' : 'required|string|min:3|max:255|unique:our_values,title_en,' . $this->route('ourValue'),
            'icon' => request()->method() === 'POST' ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
