<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('frontend.rooms.index', compact('rooms'));
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('frontend.rooms.show', compact('room'));
    }

    public function checkAvailability(Request $request, $id)
    {
        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $room = Room::findOrFail($id);

        // Check for existing bookings in the specified date range
        $bookings = Booking::where('room_id', $room->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                      ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('check_in', '<=', $request->check_in)
                                ->where('check_out', '>=', $request->check_out);
                      });
            })
            ->exists();

        return response()->json(['available' => !$bookings]);
    }
}
