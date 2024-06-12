<?php

namespace App\Http\Requests;

use App\Rules\YouTubeUrl;
use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
            'name_en' => 'required',
            'name_ar' => 'required',
            'desc_en' => 'required',
            'desc_ar' => 'required',
            'type'  => 'required|in:media,link',

            'media'   =>'required_if:type,media',

            'frame' => 'required|image',
            'link'    => [
                'required_if:type,link',
                'url',
                new YouTubeUrl()
          ],
            'category_id' => 'required'
        ];
    }
}
