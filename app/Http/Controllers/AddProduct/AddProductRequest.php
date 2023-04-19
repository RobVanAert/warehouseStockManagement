<?php

namespace App\Http\Controllers\AddProduct;

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
}
