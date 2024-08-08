<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
                    'type'=>'required|in:image,video',
                    'image'    => 'required_if:type,image|image',
                    'video'    => 'required_if:type,video|file',
                    'image_video'   => 'required_if:type,video|file',
                ];
                break;

            case 'PUT':


                return [

                    'type'=>'required|in:image,video',
                    'image'    => 'nullable|image',
                    'video'    => 'nullable|file',
                    'image_video'   => 'nullable|file',

                ];
                break;
        }
    }
}
