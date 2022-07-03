<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $about = setting('about');

        return response()->json([
            'data' => $about,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $created = Setting::query()
            ->updateOrCreate([
                'name' => 'about',
            ], [
                'value' => $request->input('about'),
            ]);

        return response()->json([
            'status' => (bool)$created,
        ]);
    }
}
