<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ThrowJsonValidationErrorTrait
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'The given data was invalid',
            'errors' => $validator->errors()
        ], 422));
    }
}
