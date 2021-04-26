<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class OrderUpdateRequest extends FormRequest
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
            'observation' => 'string',
            'client_id' => 'integer|exists:clients,id',
            'payment_method_id' => 'integer|exists:payment_methods,id',
            'products' => 'array|size:1',
            'products.*.product_id' => 'integer|exists:products,id',
            'products.*.quantity' => 'integer',
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
