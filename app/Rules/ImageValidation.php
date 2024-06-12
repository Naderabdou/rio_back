<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ImageValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $extensions = ['png', 'jpg', 'jpeg','PNG', 'JPG', 'JPEG'];

        $fileExtension = pathinfo($value->getClientOriginalName(), PATHINFO_EXTENSION);

        if (!in_array($fileExtension, $extensions)) {
            $fail(transWord('الملف غير مدعوم'));
        }
    }
}
