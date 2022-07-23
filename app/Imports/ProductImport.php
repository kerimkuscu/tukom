<?php

namespace App\Imports;

use App\Models\Menu;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $product = Product::query()->updateOrCreate(
            [
                'card_code' => $row['kart_kodu'],
            ],
            [
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
            ]
        );

        if (!empty($row['parent_menu'])) {
            $parent = Menu::firstOrCreate(
                [
                    'name' => $row['parent_menu'],
                ],
                [
                    'parent_id' => null,
                ]
            );

            $this->createSubMenus($parent->id, $row);
        }

        return $product;
    }

    public function createSubMenus(int $parentId, array $row)
    {
        for ($i = 1; $i <= 5; $i++) {
            if (empty($row["sub_menu_$i"])) {
                continue;
            }

            $sub = Menu::query()
                ->where('name', $row["sub_menu_$i"])
                ->first();

            if ($sub?->id === $parentId) {
                continue;
            }

            if (!is_null($sub)) {
                $sub->update([
                    'parent_id' => $parentId,
                ]);

                continue;
            }

            Menu::query()->create([
                'name'      => $row["sub_menu_$i"],
                'parent_id' => $parentId,
            ]);
        }
    }
}
