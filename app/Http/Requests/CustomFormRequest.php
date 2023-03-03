<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Your request has a validation error.',
                ],
                422
            )
        );
    }
}
