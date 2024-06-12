<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class FeatureRequest extends FormRequest
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
        switch (request()->method()) {
            case 'POST':

                return [
                    'icon'    => 'required|image',
                    'title_en'  => 'required|min:3|string',
                    'title_ar'  => 'required|min:3|string',
                    'desc_en'  => 'required|min:3|string',
                    'desc_ar'  => 'required|min:3|string',
                ];
                break;

            case 'PUT':


                return [
                    'icon'    => 'nullable|image',
                    'title_en'  => 'required|min:3|string',
                    'title_ar'  => 'required|min:3|string',
                    'desc_en'  => 'required|min:3|string',
                    'desc_ar'  => 'required|min:3|string',
                ];
                break;
        }
    }
}
