<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return BrandResource::collection(Brand::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BrandFormRequest $request
     *
     * @return BrandResource
     */
    public function store(BrandFormRequest $request)
    {
        $attributes = $request->toArray();

        $attributes = $this->uploadImage($request, $attributes);

        $model = Brand::create($attributes);

        return new BrandResource($model);
    }

    /**
     * Display the specified resource.
     *
     * @param Brand $brand
     *
     * @return BrandResource
     */
    public function show(Brand $brand)
    {
        return new BrandResource($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BrandFormRequest $request
     * @param Brand            $brand
     *
     * @return BrandResource
     */
    public function update(BrandFormRequest $request, Brand $brand)
    {
        $brand->update($request->all());

        return new BrandResource($brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     *
     * @return void
     */
    public function destroy(Brand $brand)
    {
        $image_path = 'images/' . $brand->image;

        $deleted = $brand->delete();

        if ($deleted) {
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
    }

    /**
     * @param BrandFormRequest $request
     * @param array            $attributes
     *
     * @return array
     */
    private function uploadImage(BrandFormRequest $request, array $attributes): array
    {
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();

            $img = Image::make($request->file('image'));

            $img->save(public_path('images/' . $imageName));

            $attributes['image'] = $imageName;
        }

        return $attributes;
    }
}
