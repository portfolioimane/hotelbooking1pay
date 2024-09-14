<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Room;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch featured hotels and top deals
        $featuredHotels = Hotel::take(5)->get(); // Adjust as needed
        $rooms = Room::inRandomOrder()->take(10)->get(); // Top rooms for showcasing

        return view('frontend.home', compact('featuredHotels', 'rooms'));
    }
}
