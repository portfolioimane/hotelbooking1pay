<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    /**
     * Seed the hotels table.
     */
    public function run()
    {
        Hotel::create([
            'name' => 'Luxury Hotel',
            'location' => 'City Center',
            'description' => 'A luxurious hotel in the heart of the city.',
            'image_url' => 'path-to-luxury-hotel-image.jpg',
        ]);
    }
}
