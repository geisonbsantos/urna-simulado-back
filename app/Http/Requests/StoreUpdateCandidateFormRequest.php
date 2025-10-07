<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUpdateCandidateFormRequest extends FormRequest
{
    /**
     * Determine if the Candidate is authorized to make this request.
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
            'name' => 'required|max:255|string',
            'number' => 'required|max:255|integer',
            'acronym' => 'required|max:255|string',
            'candidate_type_id' => 'required|exists:candidate_types,id',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['name'] = "required|string";
        }

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
