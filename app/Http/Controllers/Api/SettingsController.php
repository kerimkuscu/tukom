<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingContactEmailFormRequest;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function priceDisplay(Request $request): JsonResponse
    {
        $created = Setting::query()
            ->updateOrCreate([
                'name' => 'price_display',
            ], [
                'value' => (int)$request->input('price_display'),
            ]);

        return response()->json([
            'status' => (bool)$created,
        ]);
    }

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
