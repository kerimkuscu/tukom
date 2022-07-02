<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class MenuFormRequest extends FormRequest
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
        $menu = $this->route('menu');

        return [
            'name' => [
                'required',
                Rule::unique('menus')->ignore($menu),
            ],
            'parent_id' => [
                Rule::when(
                    $menu,
                    Rule::notIn([$menu?->id]),
                ),
            ],
        ];
    }

    public function messages()
    {
        return [
            'not_in' => 'Menu and parent menu cannot be same.',
        ];
    }
}
