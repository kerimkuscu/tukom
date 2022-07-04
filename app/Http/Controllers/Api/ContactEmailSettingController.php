<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingContactEmailFormRequest;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ContactEmailSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $seting = setting('contact_email');

        return response()->json([
            'data' => [
                'contact_email' => $seting,
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SettingContactEmailFormRequest $request
     *
     * @return JsonResponse
     */
    public function store(SettingContactEmailFormRequest $request): JsonResponse
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
