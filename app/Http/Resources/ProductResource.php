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
        ini_set('memory_limit', '-1');

        $attributes = parent::toArray($request);

        $attributes['show_price']        = (bool)setting('display_price');
        $attributes['show_fiili_stock']  = (bool)setting('display_fiili_stok');
        $attributes['show_actual_stock'] = (bool)setting('display_actual_stock');

        $attributes['menu']    = $this->menu?->name;
        $attributes['menu_id'] = $this->menu?->hashed_id;
        $attributes['id']      = $this->hashed_id;

        $images = $this->images->pluck('image')->toArray();

        $attributes['image'] = $images[0] ?? null;

        $finfo = new finfo(FILEINFO_MIME_TYPE);

        foreach ($images as $image) {
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

        try {
            $path = public_path('files/' . $this->file);

            $mimetype = $finfo->file($path);

            $source             = file_get_contents($path);
            $base64             = base64_encode($source);
            $blob               = 'data:' . $mimetype . ';base64,' . $base64;
            $attributes['file'] = [
                    $blob,
                    $this->file,
                    $mimetype,
                ];
        } catch (\Exception $e) {
            Log::info('Erro on creating blob image', [
                    'message' => $e->getMessage(),
                ]);
        }


        return $attributes;
    }
}
