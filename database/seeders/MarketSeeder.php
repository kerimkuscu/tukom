<?php

namespace Database\Seeders;

use App\Models\Market;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Market::updateOrCreate(
            ['name' => 'Aerospace'],
            ['image' => 'markets/aerospace.jpeg']
        );

        Market::updateOrCreate(
            ['name' => 'Automative'],
            ['image' => 'markets/automotive.jpeg']
        );

        Market::updateOrCreate(
            ['name' => 'Data'],
            ['image' => 'markets/data.jpeg']
        );

        Market::updateOrCreate(
            ['name' => 'Electrical'],
            ['image' => 'markets/electrical.jpeg']
        );

        Market::updateOrCreate(
            ['name' => 'Industrial'],
            ['image' => 'markets/industrial.jpeg']
        );

        Market::updateOrCreate(
            ['name' => 'Military'],
            ['image' => 'markets/military.jpeg']
        );

        Market::updateOrCreate(
            ['name' => 'Railway'],
            ['image' => 'markets/railway.jpeg']
        );

        Market::updateOrCreate(
            ['name' => 'Solar'],
            ['image' => 'markets/solar.jpeg']
        );
    }
}
