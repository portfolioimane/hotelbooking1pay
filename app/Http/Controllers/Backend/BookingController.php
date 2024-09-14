<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('room', 'user')->get();
        return view('backend.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::all();
        $users = User::all();
        return view('backend.bookings.create', compact('rooms', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required|exists:users,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        Booking::create($request->all());

        return redirect()->route('admin.bookings.index')->with('success', 'Booking created successfully.');
    }

    public function show(Booking $booking)
    {
        return view('backend.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $rooms = Room::all();
        $users = User::all();
        return view('backend.bookings.edit', compact('booking', 'rooms', 'users'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required|exists:users,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $booking->update($request->all());

        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
