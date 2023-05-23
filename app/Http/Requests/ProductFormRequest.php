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

        $rules = [
            'card_code' => [
                $id ? 'nullable' : 'required',
                'numeric',
                Rule::unique('products')->ignore($id),
            ],
            'description' => [
                'required',
            ],
            'type' => [
                'required',
            ],
        ];

        $images = $this->file('images') ?? [];

        foreach ($images as $key => $image) {
            $rules["images.{$key}"] = 'required|image|max:2048';
        }

        return $rules;
    }
}
