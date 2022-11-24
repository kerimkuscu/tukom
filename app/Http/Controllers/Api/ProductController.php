<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Http\Resources\ProductResource;
use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductImage;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
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
        $columns       = ['card_code', 'description', 'type', 'brand'];
        $sortValue     = $request->input('sort') ?? '';
        $sortColumn    = in_array($sortValue, $columns) ? $sortValue : 'id';
        $sortDirection = $request->input('sortOrder', '1') === '1' ? 'ASC' : 'DESC';

        $products = Product::query()
            ->with('menu')
            ->when($request->input('card_code'), fn($query, $value) => $query->where('card_code', 'like', '%' . $value . '%'))
            ->when($request->input('description'), fn($query, $value) => $query->where('description', 'like', '%' . $value . '%'))
            ->when($request->input('description'), fn($query, $value) => $query->where('description', 'like', '%' . $value . '%'))
            ->when($request->input('product_id'), fn($query, $value) => $query->where('description', 'like', '%' . $value . '%'))
            ->when($request->input('type'), fn($query, $value) => $query->where('type', 'like', '%' . $value . '%'))
            ->when($request->input('brand'), fn($query, $value) => $query->where('brand', 'like', '%' . $value . '%'))
            ->when($request->input('menu_id'), fn($query, $value) => $query->whereIn('menu_id', $this->getMenuIdList(hashids_decode($value))))
            ->orderBy($sortColumn, $sortDirection)
            ->when(
                $request->input('search'),
                fn($query) => $query->whereNotNull('menu_id')->get(),
                fn($query) => $query->paginate($request->input('per_page', '15'))
            );
        //->when(!$request->input('search'), fn($query) => $query->paginate($request->input('per_page', '15')));

        return ProductResource::collection($products);
    }

    public function getMenuIdList(?int $id)
    {
        $idList = [];

        $this->fillMenuIdList($id, $idList);

        return $idList;
    }

    public function fillMenuIdList(int $id, array &$idList): void
    {
        /** @var Menu $menu */
        $menu = Menu::with('subMenus')->find($id);

        if (isset($menu)) {
            $idList[] = $menu->id;

            foreach ($menu->subMenus as $subMenu) {
                $this->fillMenuIdList($subMenu->id, $idList);
            }
        }
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

        $attributes['menu_id'] = hashids_decode($attributes['menu_id']);

        if (isset($attributes['file'][0])) {
            $attributes['file'] = $this->uploadFile($attributes['file'][0]);
        } else {
            unset($attributes['file']);
        }

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

        $attributes['menu_id'] = hashids_decode($attributes['menu_id']);

        if (!$request->file('image')) {
            unset($attributes['image']);
        }

        if (isset($attributes['file'][0])) {
            $attributes['file'] = $this->uploadFile($attributes['file'][0], $product->file);
        } else {
            if (isset($product->file)) {
                $path = public_path('files') . '/' . $product->file;
                if (File::exists($path)) {
                    File::delete($path);
                }
            }

            $attributes['file'] = '';
        }

        $this->uploadImages($request, $product->id);

        $product->update($attributes);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     *
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $status     = false;
        $image_path = 'images/' . $product->image;
        $file_path  = 'files/' . $product->file;

        $productId = $product->id;
        $deleted   = $product->delete();

        if ($deleted) {
            if (File::exists($image_path)) {
                File::delete($image_path);

                ProductImage::query()
                    ->where('product_id', $productId)
                    ->delete();
            }

            if (File::exists($file_path)) {
                File::delete($file_path);
            }

            $status = true;
        }

        return response()->json([
            'status' => $status,
        ]);
    }

    /**
     * @param ProductFormRequest $request
     * @param int                $productId
     *
     * @return void
     */
    private function uploadImages(ProductFormRequest $request, int $productId): void
    {
        $images = $request->file('images') ?? [];

        $imagesInRequest = [];

        foreach ($images as $image) {
            $imagesInRequest[] = $image->getClientOriginalName();

            $count = ProductImage::query()
                ->where('image', $image->getClientOriginalName())
                ->get()
                ->count();

            if ($count > 0) {
                continue;
            }

            /** @var UploadedFile $image */
            $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image);
            $img->resize(522, 522);

            $img->insert(public_path('fligram.png'), 'center');
            $img->encode('png');
            $img->save(public_path('images/' . $imageName));

            ProductImage::query()
                ->create([
                        'product_id' => $productId,
                        'image'      => $imageName,
                    ]);

            $imagesInRequest[] = $imageName;
        }

        $imagesInDb = ProductImage::query()
            ->where('product_id', $productId)
            ->pluck('image')
            ->toArray();

        $diff = array_diff($imagesInDb, $imagesInRequest);

        ProductImage::query()
            ->whereIn('image', $diff)
            ->delete();

        foreach ($diff as $file) {
            $path = public_path('images') . '/' . $file;

            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }

    /**
     * @param UploadedFile $file
     * @param string|null  $old
     *
     * @return string
     */
    public function uploadFile(UploadedFile $file, ?string $old = null): string
    {
        if ($file->getClientOriginalName() === $old) {
            return $old;
        }

        $path = public_path('files') . '/' . $old;
        if (File::exists($path)) {
            File::delete($path);
        }

        $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $path     = public_path('files');
        $file->move($path, $fileName);

        return $fileName;
    }
}
