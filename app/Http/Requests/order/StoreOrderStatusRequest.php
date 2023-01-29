<?php

namespace App\Http\Requests\order;

use http\Env\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderStatusRequest extends FormRequest
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
            'status' => 'required | min:3'
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
