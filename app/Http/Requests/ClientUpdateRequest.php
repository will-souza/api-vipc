<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ClientUpdateRequest extends FormRequest
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
            'name' => 'string',
            'cpf' => 'string',
            'gender_id' => 'integer|exists:genders,id',
            'email' => 'email'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse(['errors' => $validator->errors(),
            'data' => [],
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
