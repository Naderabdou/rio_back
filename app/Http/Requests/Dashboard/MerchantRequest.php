<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class MerchantRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:3',
            'email' => request()->method() == 'post' ? 'nullable|string|email|max:255|unique:users,email' : 'nullable|string|email|max:255|unique:users,email,' . $this->id,
            'password' => request()->method() == 'post' ? 'required|string|min:8' : '',
            'phone' => request()->method() == 'post' ? 'required|string|max:255|unique:users,phone' : 'required|string|max:255|unique:users,phone,' . $this->id,



        ];
    }
}
