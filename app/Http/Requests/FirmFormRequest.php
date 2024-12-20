<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FirmFormRequest extends FormRequest
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
        $firm = $this->route('firm');

        return [
            'name' => [
                'required',
                Rule::unique('firms')->ignore($firm),
            ],
            'image' => [
                $firm ? 'nullable' : 'required',
                'mimes:jpg,png',
                'max:2048',
            ],
        ];
    }
}
