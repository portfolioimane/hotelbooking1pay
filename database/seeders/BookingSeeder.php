<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;

class BookingSeeder extends Seeder
{
    /**
     * Seed the bookings table.
     */
    public function run()
    {
        Booking::create([
            'room_id' => 1,
            'user_id' => User::first()->id,
            'check_in' => '2024-09-20',
            'check_out' => '2024-09-25',
        ]);
    }
}
