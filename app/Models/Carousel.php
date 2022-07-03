<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Carousel
 *
 * @property int         $id
 * @property string|null $name
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $hashed_id
 *
 * @method static Builder|Carousel newModelQuery()
 * @method static Builder|Carousel newQuery()
 * @method static Builder|Carousel query()
 * @method static Builder|Carousel whereCreatedAt($value)
 * @method static Builder|Carousel whereId($value)
 * @method static Builder|Carousel whereImage($value)
 * @method static Builder|Carousel whereName($value)
 * @method static Builder|Carousel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Carousel extends Model
{
    use HasFactory, HashId;

    protected $fillable = [
        'name',
        'image',
    ];
}
