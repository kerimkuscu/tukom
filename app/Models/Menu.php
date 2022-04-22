<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
