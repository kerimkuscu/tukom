<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandFormRequest extends FormRequest
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
        $brand = $this->route('brand');

        return [
            'name' => [
                'required',
                Rule::unique('brands')->ignore($brand),
            ],
            'image' => [
                $brand ? 'nullable' : 'required',
                'mimes:jpg,png',
                'max:2048',
            ],
        ];
    }
}
