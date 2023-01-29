<?php

namespace App\Http\Requests\shipping;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class storeShippingMethodRequest extends FormRequest
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
            'method_name' => 'required | min:3',
            'method_name' => 'numeric',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return response()->json([
            'message' => 'error',
            'errors' => $validator->errors(),
        ]);
    }
}
