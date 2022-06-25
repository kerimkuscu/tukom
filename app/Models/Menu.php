<?php

namespace App\Models;

use Database\Factories\MenuFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Menu
 *
 * @property int         $id
 * @property string      $name
 * @property int|null    $parent_id
 * @property int         $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Menu[] $subMenus
 * @property-read int|null $sub_menus_count
 *
 * @method static MenuFactory factory(...$parameters)
 * @method static Builder|Menu newModelQuery()
 * @method static Builder|Menu newQuery()
 * @method static Builder|Menu query()
 * @method static Builder|Menu whereCreatedAt($value)
 * @method static Builder|Menu whereId($value)
 * @method static Builder|Menu whereName($value)
 * @method static Builder|Menu whereParentId($value)
 * @method static Builder|Menu whereStatus($value)
 * @method static Builder|Menu whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'status',
    ];

    /**
     * @return HasMany
     */
    public function subMenus(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')->with('subMenus');
    }
}
