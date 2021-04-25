<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ClientStoreRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'cpf' => 'required|string',
            'gender_id' => 'required|integer|exists:genders,id',
            'email' => 'required|unique:clients|email'
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
