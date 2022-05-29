<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([
            'card_code'      => $row['kart_kodu'],
            'description'    => $row['aciklama'],
            'type'           => $row['turu'],
            'brand'          => $row['marka'],
            'fiili_stok'     => $row['fiili_stok'],
            'actual_stock'   => $row['gercek_stok'],
            'main_unit'      => $row['ana_birim'],
            'price'          => $row['fiyat_1'],
            'currency'       => $row['doviz_1'],
            'group_code'     => $row['grup_kodu'],
            'special_code_1' => $row['ozel_kod_1'],
            'special_code_2' => $row['ozel_kod_2'],
            'special_code_3' => $row['ozel_kod_3'],
            'special_code_4' => $row['ozel_kod_4'],
            'special_code_5' => $row['ozel_kod_5'],
        ]);
    }
}
