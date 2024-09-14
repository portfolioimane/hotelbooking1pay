<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            HotelSeeder::class,
            RoomSeeder::class,
        //    BookingSeeder::class,
            UserSeeder::class,
            SettingsSeeder::class,
        ]);
    }
}

