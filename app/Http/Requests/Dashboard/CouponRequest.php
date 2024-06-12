<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
        // if type is percentage, value must be less than 100
            $valueRule = $this->type == 'percentage' ? 'max:100' : '';

        return [
            'code' => 'required|unique:coupons,code,'.$this->id,
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|'.$valueRule ,

        ];
    }
}
