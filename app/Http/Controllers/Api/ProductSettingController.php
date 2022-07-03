<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingProductFormRequest;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class ProductSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $seting1 = setting('display_price');
        $seting2 = setting('display_fiili_stok');
        $seting3 = setting('display_actual_stock');

        return response()->json([
            'data' => [
                'price'        => (bool)$seting1,
                'fiili_stok'   => (bool)$seting2,
                'actual_stock' => (bool)$seting3,
            ],
        ]);
    }

    /**
     * @param SettingProductFormRequest $request
     *
     * @return JsonResponse
     */
    public function update(SettingProductFormRequest $request): JsonResponse
    {
        $seting1 = Setting::query()
            ->updateOrCreate([
                'name' => 'display_price',
            ], [
                'value' => (bool)$request->input('price'),
            ]);

        $seting2 = Setting::query()
            ->updateOrCreate([
                'name' => 'display_fiili_stok',
            ], [
                'value' => (bool)$request->input('fiili_stok'),
            ]);

        $seting3 = Setting::query()
            ->updateOrCreate([
                'name' => 'display_actual_stock',
            ], [
                'value' => (bool)$request->input('actual_stock'),
            ]);

        return response()->json([
            'status' => ($seting1 && $seting2 && $seting3),
        ]);
    }
}
