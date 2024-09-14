<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Seed the rooms table.
     */
    public function run()
    {
        Room::create([
            'hotel_id' => 1,
            'name' => 'Deluxe Room',
            'description' => 'A spacious room with a king-size bed and modern amenities.',
            'price' => 150.00,
            'image_url' => 'path-to-deluxe-room-image.jpg',
            'capacity' => 2,
        ]);

        Room::create([
            'hotel_id' => 1,
            'name' => 'Suite',
            'description' => 'A luxurious suite with a separate living area and stunning views.',
            'price' => 250.00,
            'image_url' => 'path-to-suite-image.jpg',
            'capacity' => 4,
        ]);
    }
}
