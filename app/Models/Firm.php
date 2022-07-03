<?php

namespace App\Models;

use App\Traits\HashId;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Firm
 *
 * @property int         $id
 * @property string|null $name
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $hashed_id
 *
 * @method static Builder|Firm newModelQuery()
 * @method static Builder|Firm newQuery()
 * @method static Builder|Firm query()
 * @method static Builder|Firm whereCreatedAt($value)
 * @method static Builder|Firm whereId($value)
 * @method static Builder|Firm whereImage($value)
 * @method static Builder|Firm whereName($value)
 * @method static Builder|Firm whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Firm extends Model
{
    use HasFactory, HashId;

    protected $fillable = [
        'name',
        'image',
    ];
}
