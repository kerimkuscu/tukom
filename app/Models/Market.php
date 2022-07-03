<?php

namespace App\Models;

use App\Traits\HashId;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Market
 *
 * @property int         $id
 * @property string|null $name
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $hashed_id
 *
 * @method static Builder|Market newModelQuery()
 * @method static Builder|Market newQuery()
 * @method static Builder|Market query()
 * @method static Builder|Market whereCreatedAt($value)
 * @method static Builder|Market whereId($value)
 * @method static Builder|Market whereImage($value)
 * @method static Builder|Market whereName($value)
 * @method static Builder|Market whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Market extends Model
{
    use HasFactory, HashId;

    protected $fillable = [
        'name',
        'image',
    ];
}
