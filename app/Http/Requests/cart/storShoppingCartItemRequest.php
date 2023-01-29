<?php

namespace App\Http\Requests\cart;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class storShoppingCartItemRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_id' => 'required | integer',
            'qty' => 'required | integer',
        ];
    }

    public function failedValidation(Validator $validator)
    {
       return response()->json([
           'status' => 'error',
           'message' => 'validation error',
           'errors' => $validator->errors()
       ]);
    }
}
