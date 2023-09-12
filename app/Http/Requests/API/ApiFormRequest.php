<?php

namespace App\Http\Requests\API;

use App\Exceptions\IlinxValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new IlinxValidationException(response()->json([
            'is_success' => false,
            'message'    => $validator->getMessageBag()->first(),
            'data'       => [],
        ], 200));
    }
}
