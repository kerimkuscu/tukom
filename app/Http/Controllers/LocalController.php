<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class LocalController extends Controller
{
    public function test()
    {
//        $a =Menu::factory()->create([
//            'parent_id' =>   Menu::find(1)->id
//        ]);


//        $q = Menu::find(1)->subMenus;
//        dd($q->first()->subMenus);

        $a = Menu::with('subMenus')->get();

        $data = [];

        foreach ($a as $key => $menu) {
            $data[] = $this->recursive($key, $menu);
        }

        dd($data);

        return 'OK';
    }

    public function recursive($key, $menu): array
    {

        //dump($menu);

        $c = [
            'key'  => $key,
            'data' => [
                'id'   => $menu->id,
                'name' => $menu->name,
            ],
        ];

        if (!$menu->submenus->isEmpty()) {
            foreach ($menu->submenus as $key2 => $menu2) {
                $childrens[] = $this->recursive("{$key}-{$key2}", $menu2);

//                $childrens = [
//                    'key'  => "{$key}-{$key2}",
//                    'data' => [
//                        'id'   => $menu2->id,
//                        'name' => $menu2->name,
//                    ],
//                ];
            }

            if (isset($childrens)) {
                $c['children'] = $childrens;
            }
        }

        return $c;
    }
}
