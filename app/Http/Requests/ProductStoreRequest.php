<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'color' => 'string',
            'size' => 'required|integer',
            'price' => 'required|integer'
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
