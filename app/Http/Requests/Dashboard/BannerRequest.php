<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\ImageValidation;
use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'title_ar' => 'required',
            'title_en' => 'required',
            'sub_title_ar' => 'required',
            'sub_title_en' => 'required',
            'image' => request()->method() === 'POST' ? ['required', 'image', new ImageValidation()] : ['nullable', new ImageValidation()],
            'color_title' => 'required',
            'color_btn' => 'required',
            'color_ground' => 'required',


        ];
    }
}
