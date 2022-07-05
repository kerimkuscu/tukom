<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::updateOrCreate(
            ['name' => 'Airborn'],
            ['image' => 'brands/airborn.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Amphenol'],
            ['image' => 'brands/amphenol.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Astrol'],
            ['image' => 'brands/astro.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Cinch'],
            ['image' => 'brands/cinch.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Conesys'],
            ['image' => 'brands/conesys.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Corsair'],
            ['image' => 'brands/corsair.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Daniels'],
            ['image' => 'brands/daniels.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Ddk'],
            ['image' => 'brands/ddk.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Deutsch'],
            ['image' => 'brands/deutsch.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Glenair'],
            ['image' => 'brands/glenair.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Itt Cannon'],
            ['image' => 'brands/itt_cannon.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Kepco'],
            ['image' => 'brands/kepco.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Sensatab'],
            ['image' => 'brands/sensatab.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Souriau'],
            ['image' => 'brands/souriau.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Spi'],
            ['image' => 'brands/spi.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Telason'],
            ['image' => 'brands/telason.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Tristar'],
            ['image' => 'brands/tristar.png']
        );

        Brand::updateOrCreate(
            ['name' => 'Tyco'],
            ['image' => 'brands/tyco.png']
        );
    }
}
