<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Intervention\Image\Facades\Image;
use Ramsey\Collection\Collection;

class TestController extends Controller
{
    public function test()
    {
//        App::setLocale('tr');
//dd(App::currentLocale());
        dd(public_path('images'));

        app(MenuRepository::class)->getMegaMenuList();


//        $a =Menu::factory()->create([
//            'parent_id' =>   Menu::find(1)->id
//        ]);


//        $q = Menu::find(1)->subMenus;
//        dd($q->first()->subMenus);

//        $a = Menu::with('subMenus')->get();
//
//        $data = [];
//
//        foreach ($a as $key => $menu) {
//            $data[] = $this->recursive($key, $menu);
//        }
//
//        dd($data);

        return 'OK';
    }

    public function fligram()
    {
        return view('fligram');
    }

    public function fligramStore(Request $request)
    {
        //dd($request->toArray());

        $img = Image::make($request->file('file'));

        /* insert watermark at bottom-right corner with 10px offset */
        $img->insert(public_path('fligram.png'), 'bottom-right', 5, 5);
        $img->encode('png');

        $img->save(public_path('images/new-image.png'));
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
