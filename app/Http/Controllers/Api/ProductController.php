<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Intervention\Image\Facades\Image;

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
        $columns       = ['card_code', 'description'];
        $sortValue     = $request->input('sort') ?? '';
        $sortColumn    = in_array($sortValue, $columns) ? $sortValue : 'id';
        $sortDirection = $request->input('sortOrder', '1') === '1' ? 'ASC' : 'DESC';

        $products = Product::query()
            ->when($request->input('card_code'), fn($query, $value) => $query->where('card_code', 'like', '%' . $value . '%'))
            ->when($request->input('description'), fn($query, $value) => $query->where('description', 'like', '%' . $value . '%'))
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(15);

        return ProductResource::collection($products);
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

            $img = Image::make($request->file('image'));
            $img->insert(public_path('fligram.png'), 'bottom-right', 5, 5);
            $img->encode('png');
            $img->save(public_path('images/' . $imageName));

            $attributes['image'] = $imageName;
        }

        return $attributes;
    }
}
