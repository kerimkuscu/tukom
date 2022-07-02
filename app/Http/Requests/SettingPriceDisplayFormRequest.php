<?php

namespace App\Http\Requests;

use App\Enums\Price;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingPriceDisplayFormRequest extends FormRequest
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
            'price_display' => [
                Rule::in([Price::NOT_SHOW, Price::SHOW]),
            ],
        ];
    }
}
