<?php

namespace App\Http\Resources;

use App\Models\Product;
use finfo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\UploadedFile;

/**
 * @mixin Product
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        $attributes = parent::toArray($request);

        if ((int)setting('price_display')) {
            unset($attributes['price']);
        }

        $attributes['menu'] = $this->menu?->name;

        $images = $this->images->pluck('image')->toArray();

//        $attributes['images'] = $images;

                foreach ($images as $image) {
                    $finfo = new finfo(FILEINFO_MIME_TYPE);
                    $path = public_path('images/' . $image);

                    $mimetype = $finfo->file($path);

                    $source = file_get_contents($path);
                    $base64 = base64_encode($source);
                    $blob = 'data:'.$mimetype.';base64,'.$base64;
                    $attributes['images'][] = [
                        $blob,
                        $image,
                        $mimetype
                    ];
                }

//        $finfo = new finfo(FILEINFO_MIME_TYPE);
//
//        foreach ($images as $image) {
//            $path                   = public_path('images/' . $image);
//            $attributes['images'][] = new UploadedFile(
//                $path,
//                $image,
//                $finfo->file($path),
//                filesize($path),
//                0,
//                false
//            );
//        }
//dd($attributes);
        return $attributes;
    }
}
