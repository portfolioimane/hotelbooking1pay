<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return view('frontend.hotels.index', compact('hotels'));
    }

    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('frontend.hotels.show', compact('hotel'));
    }
}
