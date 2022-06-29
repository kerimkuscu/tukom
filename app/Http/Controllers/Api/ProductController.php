<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct(public ProductRepository $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $columns       = ['card_code', 'description', 'type'];
        $sortValue     = $request->input('sort') ?? '';
        $sortColumn    = in_array($sortValue, $columns) ? $sortValue : 'id';
        $sortDirection = $request->input('sortOrder', '1') === '1' ? 'ASC' : 'DESC';

        $products = Product::query()
            ->with('menu')
            ->when($request->input('card_code'), fn($query, $value) => $query->where('card_code', 'like', '%' . $value . '%'))
            ->when($request->input('description'), fn($query, $value) => $query->where('description', 'like', '%' . $value . '%'))
            ->when($request->input('type'), fn($query, $value) => $query->where('type', 'like', '%' . $value . '%'))
            ->when($request->input('menu_id'), fn($query, $value) => $query->where('menu_id', $value))
            ->orderBy($sortColumn, $sortDirection)
            ->paginate($request->input('per_page', '15'));

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductFormRequest $request
     *
     * @return ProductResource
     */
    public function store(ProductFormRequest $request): ProductResource
    {
        $attributes = $request->toArray();

        $product = Product::query()->create($attributes);

        $this->uploadImages($request, $product->id);

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

//        $attributes = $this->uploadImages($request, $product->id);

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
        $image_path = 'images/' . $product->image;

        $deleted = $product->delete();

        if ($deleted) {
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
    }

    /**
     * @param ProductFormRequest $request
     * @param int                $productId
     *
     * @return void
     */
    private function uploadImages(ProductFormRequest $request, int $productId): void
    {
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {

                /** @var UploadedFile $image */
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                $img = Image::make($image);
                $img->resize(1024, 800);

                $img->insert(public_path('fligram.png'), 'center');
                $img->encode('png');
                $img->save(public_path('images/' . $imageName));

                ProductImage::query()
                    ->create([
                        'product_id' => $productId,
                        'image'      => $imageName,
                    ]);

                // $attributes['image'] = $imageName;
            }
        }

//        return $attributes;
    }
}
