<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductBulkDeleteController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function bulkDelete(Request $request): JsonResponse
    {
        $count = $this->deleteMany($request->input('hashedIdList'));

        return response()->json([
            'count' => $count,
        ]);
    }

    /**
     * @param array $hashedIdList
     *
     * @return int
     */
    public function deleteMany(array $hashedIdList): int
    {
        $count = 0;

        foreach ($hashedIdList as $hashedId) {
            $product    = Product::query()->find(hashids_decode($hashedId));
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

                $count++;
            }
        }

        return $count;
    }
}
