<?php

namespace App\Traits;

use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\Facades\Image;

trait HasUploadImage
{
    /**
     * @param FormRequest $request
     * @param array       $attributes
     *
     * @return array
     */
    private function uploadImage(FormRequest $request, array $attributes): array
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
