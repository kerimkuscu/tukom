<?php

namespace Database\Seeders;

use App\Models\Firm;
use Illuminate\Database\Seeder;

class FirmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Firm::updateOrCreate(
            ['name' => 'BMC'],
            ['image' => 'firms/bmc.png']
        );

        Firm::updateOrCreate(
            ['name' => 'Havelsan'],
            ['image' => 'firms/havelsan.png']
        );

        Firm::updateOrCreate(
            ['name' => 'Otokar'],
            ['image' => 'firms/otokar.png']
        );

        Firm::updateOrCreate(
            ['name' => 'Tubitak'],
            ['image' => 'firms/tubitak.png']
        );

        Firm::updateOrCreate(
            ['name' => 'Turkish Technic'],
            ['image' => 'firms/turkishTechnic.png']
        );
    }
}
