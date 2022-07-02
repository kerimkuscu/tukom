<?php

namespace App\Models;

use App\Traits\HashId;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Setting
 *
 * @property-read string        $hashed_id
 *
 * @method static Builder|Setting newModelQuery()
 * @method static Builder|Setting newQuery()
 * @method static Builder|Setting query()
 * @mixin Eloquent
 */
class Setting extends Model
{
    use HasFactory, HashId;

    protected $fillable = [
        'name',
        'value',
    ];
}
