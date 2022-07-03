<?php

namespace App\Http\Resources;

use App\Models\Firm;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Firm
 */
class FirmResource extends JsonResource
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
        return [
            'id'    => $this->hashed_id,
            'name'  => $this->name,
            'image' => $this->image,
        ];
    }
}
