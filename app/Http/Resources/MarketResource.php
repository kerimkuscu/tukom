<?php

namespace App\Http\Resources;

use App\Models\Market;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @mixin Market
 */
class MarketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id'    => $this->hashed_id,
            'name'  => $this->name,
            'image' => $this->image,
        ];
    }
}
