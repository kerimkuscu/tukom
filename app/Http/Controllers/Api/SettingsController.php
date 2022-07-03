<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingContactEmailFormRequest;
use App\Http\Requests\SettingProductFormRequest;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * @param SettingContactEmailFormRequest $request
     *
     * @return JsonResponse
     */
    public function contactEmail(SettingContactEmailFormRequest $request): JsonResponse
    {
        $created = Setting::query()
            ->updateOrCreate([
                'name' => 'contact_email',
            ], [
                'value' => $request->input('contact_email'),
            ]);

        return response()->json([
            'status' => (bool)$created,
        ]);
    }
}
