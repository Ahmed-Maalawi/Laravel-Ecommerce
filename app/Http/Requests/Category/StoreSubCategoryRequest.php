<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreSubCategoryRequest extends FormRequest
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
            'name' => 'required | string | min:2',
            'category_id' => 'required | numeric'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->json([
            'status' => 'error',
            'message' => 'validation error',
            'error' => $validator->errors(),
        ]));
    }
}
