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
        return ProductResource::collection(Product::paginate(15));
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
        $attributes = $request->toArray();

        $attributes = $this->uploadImage($request, $attributes);

        $product = Product::query()->create($attributes);

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
        $attributes = $request->toArray();

        if (!$request->file('image')) {
            unset($attributes['image']);
        }

        $attributes = $this->uploadImage($request, $attributes);

        $product->update($attributes);

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

    /**
     * @param ProductFormRequest $request
     * @param array              $attributes
     *
     * @return array
     */
    private function uploadImage(ProductFormRequest $request, array $attributes): array
    {
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $fullPath  = $request->file('image')->storeAs(
                'images',
                $imageName,
                'public'
            );

            $fullPath = str_replace('images/', '', $fullPath);

            $attributes['image'] = $fullPath;
        }

        return $attributes;
    }
}
