<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
