<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('backend.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $hotels = Hotel::all();
        return view('backend.rooms.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image_url' => 'nullable|string',
            'capacity' => 'required|integer',
        ]);

        Room::create($request->all());

        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully.');
    }

    public function show(Room $room)
    {
        return view('backend.rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        $hotels = Hotel::all();
        return view('backend.rooms.edit', compact('room', 'hotels'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image_url' => 'nullable|string',
            'capacity' => 'required|integer',
        ]);

        $room->update($request->all());

        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully.');
    }
}
