<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $this->call(BrandSeeder::class);
        $this->call(MarketSeeder::class);
        $this->call(FirmSeeder::class);
    }
}
