<?php

namespace App\Http\Requests;

use App\Enums\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingProductFormRequest extends FormRequest
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
            'price' => [
                Rule::in([Setting::NOT_SHOW, Setting::SHOW]),
            ],
            'fiili_stok' => [
                Rule::in([Setting::NOT_SHOW, Setting::SHOW]),
            ],
            'actual_stock' => [
                Rule::in([Setting::NOT_SHOW, Setting::SHOW]),
            ],
        ];
    }
}
