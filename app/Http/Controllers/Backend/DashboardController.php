<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index()
    {
        // Here, you can fetch data from the database if needed
        // Example: $stats = $this->getDashboardStats();

        return view('backend.dashboard.index');
    }

    // Optional method to fetch data for the dashboard
    // private function getDashboardStats()
    // {
    //     // Example of fetching data
    //     return [
    //         'hotels' => Hotel::count(),
    //         'rooms' => Room::count(),
    //         'bookings' => Booking::count(),
    //         'users' => User::count(),
    //     ];
    // }
}
