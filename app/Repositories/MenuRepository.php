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

    public function getMenuList(): array
    {
        /** @var Collection $menus */
        return Menu::with('subMenus')
            ->get()
            ->map(function($item) {
                return [
                   'text'  => $item->name,
                   'value' => $item->id,
               ];
            })
            ->toArray();

//        $data = [];
//        $maxDeep = 0;
//        $deep = 0;
//
//        foreach ($menus as $menu) {
//            $data[] = $this->getTreeForMenuList($menu, $deep);
//
//            if($deep > $maxDeep){
//                $maxDeep = $deep;
//            }
//        }
//
//        return [
//            'data' => $data,
//            'meta' => [
//                'deep' => $maxDeep
//            ]
//        ];
    }

    /**
     * @param Menu $menu
     *
     * @return array
     */
    public function getTreeForMenuList(Menu $menu, &$deep): array
    {
        $data = [
            'name'      => $menu->name,
            'childrens' => [],
        ];

        if (!$menu->submenus->isEmpty()) {
            foreach ($menu->submenus as $menu2) {
                $childrens[] = $this->getTreeForMenuList($menu2, $deep);
            }

            if (isset($childrens)) {
                $data['childrens'] = $childrens;
                $deep++;
            }
        }

        return $data;
    }

    public function getMegaMenuList(): array
    {
        /** @var Collection $menus */
        $menus = Menu::with('subMenus')
            ->whereNull('parent_id')
            ->get();

        $items = [];

        foreach ($menus as $key => $menu) {
            $items[$key] = [
                'label' => $menu->name,
                'items' => [],
            ];

            $items2 = [];
            $items3 = [];

            foreach ($menu->submenus as $key2 => $menu2) {
                $items2[$key][$key2] = [
                    'label' => $menu2->name,
                    'items' => [],
                ];

                foreach ($menu2->submenus as $key3 => $menu3) {
                    $items3[$key3] = [
                        'label' => $menu3->name,
                    ];
                }

                $items2[$key][$key2]['items'] = $items3;
                $items3                       = [];
            }

            $items[$key]['items'] = $items2;
        }

        return $items;
    }
}
