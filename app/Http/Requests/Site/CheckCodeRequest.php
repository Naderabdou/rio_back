<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class CheckCodeRequest extends FormRequest
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
            'code.*' => 'required|numeric',
            'code' => 'required|size:4',
            'email' => 'required|email|exists:users,email',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => transWord('The code field is required.'),
            'code.size' => transWord('The code must be 4 digits.'),
            'code' => transWord('The code must be 4 digits.'),
        ];
    }
}
