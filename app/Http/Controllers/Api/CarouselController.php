<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarouselFormRequest;
use App\Http\Resources\CarouselResource;
use App\Models\Carousel;
use App\Traits\HasUploadImage;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class CarouselController extends Controller
{
    use HasUploadImage;

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return CarouselResource::collection(Carousel::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CarouselFormRequest $request
     *
     * @return CarouselResource
     */
    public function store(CarouselFormRequest $request): CarouselResource
    {
        $attributes = $request->toArray();

        if (!$request->file('image')) {
            unset($attributes['image']);
        }

        $attributes = $this->uploadImage($request, $attributes);

        $model = Carousel::create($attributes);

        return new CarouselResource($model);
    }

    /**
     * Display the specified resource.
     *
     * @param Carousel $carousel
     *
     * @return CarouselResource
     */
    public function show(Carousel $carousel): CarouselResource
    {
        return new CarouselResource($carousel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CarouselFormRequest $request
     * @param Carousel            $carousel
     *
     * @return CarouselResource
     */
    public function update(CarouselFormRequest $request, Carousel $carousel): CarouselResource
    {
        $attributes = $request->validated();

        if (!$request->file('image')) {
            unset($attributes['image']);
        }

        $attributes = $this->uploadImage($request, $attributes);

        $carousel->update($attributes);

        return new CarouselResource($carousel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Carousel $carousel
     *
     * @return Response
     */
    public function destroy(Carousel $carousel): Response
    {
        $image_path = 'images/' . $carousel?->image;

        $deleted = $carousel->delete();

        if ($deleted) {
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        return response()->noContent();
    }
}
