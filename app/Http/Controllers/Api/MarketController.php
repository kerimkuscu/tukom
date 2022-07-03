<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarketFormRequest;
use App\Http\Resources\MarketResource;
use App\Models\Market;
use App\Traits\HasUploadImage;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class MarketController extends Controller
{
    use HasUploadImage;

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return MarketResource::collection(Market::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MarketFormRequest $request
     *
     * @return MarketResource
     */
    public function store(MarketFormRequest $request): MarketResource
    {
        $attributes = $request->validated();

        $attributes = $this->uploadImage($request, $attributes);

        $model = Market::create($attributes);

        return new MarketResource($model);
    }

    /**
     * Display the specified resource.
     *
     * @param Market $market
     *
     * @return MarketResource
     */
    public function show(Market $market): MarketResource
    {
        return new MarketResource($market);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MarketFormRequest $request
     * @param Market            $market
     *
     * @return MarketResource
     */
    public function update(MarketFormRequest $request, Market $market): MarketResource
    {
        $attributes = $request->validated();

        if (!$request->file('image')) {
            unset($attributes['image']);
        }

        $attributes = $this->uploadImage($request, $attributes);

        $market->update($attributes);

        return new MarketResource($market);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(Market $market)
    {
        $image_path = 'images/' . $market?->image;

        $deleted = $market->delete();

        if ($deleted) {
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        return response()->noContent();
    }
}
