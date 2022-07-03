<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FirmFormRequest;
use App\Http\Resources\FirmResource;
use App\Models\Firm;
use App\Traits\HasUploadImage;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class FirmController extends Controller
{
    use HasUploadImage;

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return FirmResource::collection(Firm::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FirmFormRequest $request
     *
     * @return FirmResource
     */
    public function store(FirmFormRequest $request): FirmResource
    {
        $attributes = $request->validated();

        $attributes = $this->uploadImage($request, $attributes);

        $model = Firm::create($attributes);

        return new FirmResource($model);
    }

    /**
     * Display the specified resource.
     *
     * @param Firm $firm
     *
     * @return FirmResource
     */
    public function show(Firm $firm): FirmResource
    {
        return new FirmResource($firm);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FirmFormRequest $request
     * @param Firm            $firm
     *
     * @return FirmResource
     */
    public function update(FirmFormRequest $request, Firm $firm): FirmResource
    {
        $attributes = $request->validated();

        if (!$request->file('image')) {
            unset($attributes['image']);
        }

        $attributes = $this->uploadImage($request, $attributes);

        $firm->update($attributes);

        return new FirmResource($firm);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Firm $firm
     *
     * @return Response
     */
    public function destroy(Firm $firm): Response
    {
        $image_path = 'images/' . $firm?->image;

        $deleted = $firm->delete();

        if ($deleted) {
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        return response()->noContent();
    }
}
