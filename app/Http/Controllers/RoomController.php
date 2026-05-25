<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    // READ: Display all rooms
    public function index() {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    // CREATE: Show the add room form
    public function create() {
        return view('rooms.create');
    }

    // CREATE: Store data in DB
    public function store(Request $request) {
        $request->validate([
            'room_number' => 'required|unique:rooms',
            'type' => 'required',
            'price' => 'required|numeric'
        ]);

        Room::create($request->all());
        return redirect()->route('rooms.index')->with('success', 'Room added successfully!');
    }

    // UPDATE: Show edit form
    public function edit(Room $room) {
        return view('rooms.edit', compact('room'));
    }

    // UPDATE: Update data in DB
    public function update(Request $request, Room $room) {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number,'.$room->id,
            'type' => 'required',
            'price' => 'required|numeric'
        ]);

        $room->update($request->all());
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully!');
    }

    // DELETE: Remove room from DB
    public function destroy(Room $room) {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully!');
    }
}
