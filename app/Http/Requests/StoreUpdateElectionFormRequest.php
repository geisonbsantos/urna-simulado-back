<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUpdateElectionFormRequest extends FormRequest
{
    /**
     * Determine if the Election is authorized to make this request.
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
        $rules = [
            'address_id'       => 'required|exists:addresses,id',
            'election_type_id' => 'required|exists:election_types,id',
            'user_id'          => 'required|exists:users,id',
            'period'           => 'required|date',
        ];

        // if (in_array($this->method(), ['PUT', 'PATCH'])) {
        //     // $rules['period'] = "required|date";
        // }

        return $rules;
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = response()->json([
            'error' => 'Erro no envio de dados.',
            'details' => $errors->messages(),
        ], 422);
        throw new HttpResponseException($response);
    }
}
