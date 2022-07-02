<?php

namespace App\Http\Resources;

use App\Models\Quote;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @mixin Quote
 */
class QuoteResource extends JsonResource
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
        $attributes       = parent::toArray($request);
        $attributes['id'] = $this->hashed_id;

        return $attributes;
    }
}
