<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\ImageValidation;
use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
        $method = $this->method();

        return [
            'name_ar'        => 'required|string|min:4|max:255',
            'name_en'        => 'required|string|min:4|max:255',
            'desc_ar'        => 'required|string|min:4',
            'desc_en'        => 'required|string|min:4',
            'category_ids'   => 'required|array',
            'category_ids.*' => ['required', 'min:1', 'exists:categories,id'],
            'image'          => $method === 'PATCH' ? ['nullable', new ImageValidation] : ['required', new ImageValidation],
        ];
    }
}
