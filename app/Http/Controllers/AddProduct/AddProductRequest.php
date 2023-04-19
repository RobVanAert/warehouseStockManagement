<?php

namespace App\Http\Controllers\AddProduct;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'data' => 'required',
            'data.name' => 'required',
            'data.price' => 'required',
            'data.description' => 'required',
        ];
    }

    /**
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }
}
