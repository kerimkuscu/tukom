<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductListController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     *
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $products = Product::query()
            ->whereHas('menu')
            ->whereHas('images')
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return ProductResource::collection($products);
    }
}
