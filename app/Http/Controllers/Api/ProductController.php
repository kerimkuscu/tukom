<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function __construct(public ProductRepository $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        //filtreleme

        return ProductResource::collection(Product::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductFormRequest $request
     *
     * @return ProductResource
     */
    public function store(ProductFormRequest $request)
    {
        $product = Product::query()->create($request->validated());

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     *
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductFormRequest $request
     * @param Product            $product
     *
     * @return ProductResource
     */
    public function update(ProductFormRequest $request, Product $product): ProductResource
    {
        $product->update($request->validated());

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     *
     * @return void
     */
    public function destroy(Product $product): void
    {
        $product->delete();
    }
}
