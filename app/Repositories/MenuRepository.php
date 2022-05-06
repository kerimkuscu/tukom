<?php

namespace App\Repositories;

use App\Models\Menu;
use Ramsey\Collection\Collection;

class MenuRepository
{
    /**
     * @return array
     */
    public function getTreeData(): array
    {
        /** @var Collection $menus */
        $menus = Menu::with('subMenus')
            ->whereNull('parent_id')
            ->get();

        $data = [];

        foreach ($menus as $key => $menu) {
            $data[] = $this->getFullTree($key, $menu);
        }

        return $data;
    }

    /**
     * @param string $key
     * @param Menu   $menu
     *
     * @return array
     */
    public function getFullTree(string $key, Menu $menu): array
    {
        $data = [
            'key'  => $key,
            'data' => [
                'id'   => $menu->id,
                'name' => $menu->name,
            ],
        ];

        if (!$menu->submenus->isEmpty()) {
            foreach ($menu->submenus as $key2 => $menu2) {
                $childrens[] = $this->getFullTree("{$key}-{$key2}", $menu2);
            }

            if (isset($childrens)) {
                $data['children'] = $childrens;
            }
        }

        return $data;
    }
}
