<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'color' => 'string',
            'size' => 'integer',
            'price' => 'integer'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response(['errors' => $validator->errors(),
            'data' => [],
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
