<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        Setting::create([
            'site_name' => 'My Website',
            'contact_email' => 'contact@mywebsite.com',
            'address' => '123 Main St, Anytown, AT 12345',
            'phone_number' => '+1234567890',
        ]);
    }
}
