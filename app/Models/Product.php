<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Product
 *
 * @property int         $id
 * @property int|null    $menu_id
 * @property string      $card_code
 * @property string      $description
 * @property string      $type
 * @property string|null $brand
 * @property int|null    $fiili_stok
 * @property int|null    $actual_stock
 * @property string|null $main_unit
 * @property string|null $price
 * @property string|null $currency
 * @property string|null $group_code
 * @property string|null $image
 * @property string|null $special_code_1
 * @property string|null $special_code_2
 * @property string|null $special_code_3
 * @property string|null $special_code_4
 * @property string|null $special_code_5
 * @property string|null $special_code_6
 * @property string|null $special_code_7
 * @property string|null $special_code_8
 * @property string|null $special_code_9
 * @property string|null $special_code_10
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Menu|null $menu
 *
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereActualStock($value)
 * @method static Builder|Product whereBrand($value)
 * @method static Builder|Product whereCardCode($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereCurrency($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereFiiliStok($value)
 * @method static Builder|Product whereGroupCode($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereImage($value)
 * @method static Builder|Product whereMainUnit($value)
 * @method static Builder|Product whereMenuId($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereSpecialCode1($value)
 * @method static Builder|Product whereSpecialCode10($value)
 * @method static Builder|Product whereSpecialCode2($value)
 * @method static Builder|Product whereSpecialCode3($value)
 * @method static Builder|Product whereSpecialCode4($value)
 * @method static Builder|Product whereSpecialCode5($value)
 * @method static Builder|Product whereSpecialCode6($value)
 * @method static Builder|Product whereSpecialCode7($value)
 * @method static Builder|Product whereSpecialCode8($value)
 * @method static Builder|Product whereSpecialCode9($value)
 * @method static Builder|Product whereType($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'card_code',
        'description',
        'type',
        'brand',
        'fiili_stok',
        'actual_stock',
        'main_unit',
        'price',
        'currency',
        'group_code',
        'image',
        'special_code_1',
        'special_code_2',
        'special_code_3',
        'special_code_4',
        'special_code_5',
        'special_code_6',
        'special_code_7',
        'special_code_8',
        'special_code_9',
        'special_code_10',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}
