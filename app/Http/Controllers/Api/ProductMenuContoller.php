<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductMenuContoller extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Product $product
     *
     * @return JsonResponse
     */
    public function store(Request $request, Product $product): JsonResponse
    {
        $menuId = $request->input('menu_id');
        $menu   = Menu::find($menuId);
        $status = false;

        if ($menu) {
            $product->update([
                'menu_id' => $menuId,
            ]);

            $status = true;
        }

        return response()->json([
            'status' => $status,
        ], $status ? 200 : 404);
    }
}
