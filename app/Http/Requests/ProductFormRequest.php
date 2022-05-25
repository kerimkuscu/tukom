<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductFormRequest extends FormRequest
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
    public function rules()
    {
        $id = $this->route('product');

        return [
            'image' => [
                $id ? 'nullable' : 'required',
                'mimes:jpeg,png,jpg',
                'max:2048',
            ],
            'card_code' => [
                'required',
                'numeric',
            ],
            'description' => [
                'required',
            ],
            'type' => [
                'required',
            ],
        ];
    }
}
