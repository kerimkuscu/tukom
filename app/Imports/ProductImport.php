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
        $attributes = [
            'description'     => $row['aciklama'],
            'type'            => $row['turu'],
            'brand'           => $row['marka'],
            'fiili_stok'      => $row['fiili_stok'],
            'actual_stock'    => $row['gercek_stok'],
            'main_unit'       => $row['ana_birim'],
            'price'           => $row['fiyat_1'],
            'currency'        => $row['doviz_1'],
            'group_code'      => $row['grup_kodu'],
            'special_code_1'  => $row['ozel_kod_1'] ?? '',
            'special_code_2'  => $row['ozel_kod_2'] ?? '',
            'special_code_3'  => $row['ozel_kod_3'] ?? '',
            'special_code_4'  => $row['ozel_kod_4'] ?? '',
            'special_code_5'  => $row['ozel_kod_5'] ?? '',
            'special_code_6'  => $row['ozel_kod_6'] ?? '',
            'special_code_7'  => $row['ozel_kod_7'] ?? '',
            'special_code_8'  => $row['ozel_kod_8'] ?? '',
            'special_code_9'  => $row['ozel_kod_9'] ?? '',
            'special_code_10' => $row['ozel_kod_10'] ?? '',
        ];

        $counter = 1;

        if (!empty($row['parent_menu'])) {
            $parent = Menu::firstOrCreate(
                [
                    'name' => $row['parent_menu'],
                ],
                [
                    'parent_id' => null,
                ]
            );

            $menudId = $this->createSubMenu($parent->id, $row, $counter);
        }

        $attributes['menu_id'] = $menudId ?? null;

        return Product::query()->updateOrCreate(
            [
                'card_code' => $row['kart_kodu'],
            ],
            $attributes
        );
    }

    /**
     * @param int   $parentId
     * @param array $row
     * @param int   $counter
     *
     * @return int
     */
    public function createSubMenu(int $parentId, array $row, int $counter): int
    {
        if (!empty($row["sub_menu_$counter"])) {
            $menu = Menu::query()
                ->where('name', $row["sub_menu_$counter"])
                ->first();

            if ($menu?->id !== $parentId) {
                if (!is_null($menu)) {
                    $menu->update([
                        'parent_id' => $parentId,
                    ]);
                } else {

                    $menu = Menu::query()->create([
                        'name'      => $row["sub_menu_$counter"],
                        'parent_id' => $parentId,
                    ]);
                }
            }
        }

        $counter++;

        $id = $menu->id ?? $parentId;

        return $counter === 8
            ? $id
            : $this->createSubMenu($id, $row, $counter);
    }
}
