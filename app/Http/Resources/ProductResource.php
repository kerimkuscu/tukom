<?php

namespace App\Http\Resources;

use App\Models\Product;
use finfo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

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


        foreach ($images as $image) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);

            try {
                $path = public_path('images/' . $image);

                $mimetype = $finfo->file($path);
            } catch (\Exception $e) {
                Log::info('Erro on creating blob image', [
                        'message' => $e->getMessage(),
                    ]);

                continue;
            }
            $source                 = file_get_contents($path);
            $base64                 = base64_encode($source);
            $blob                   = 'data:' . $mimetype . ';base64,' . $base64;
            $attributes['images'][] = [
                    $blob,
                    $image,
                    $mimetype,
                ];
        }



        return $attributes;
    }
}
