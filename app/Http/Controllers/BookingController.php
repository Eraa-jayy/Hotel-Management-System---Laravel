<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\Guest;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // READ: Display all bookings
    public function index() {
        $bookings = Booking::with(['room', 'guest'])->get();
        return view('bookings.index', compact('bookings'));
    }

    // CREATE: Show the add booking form
    public function create() {
        $rooms = Room::all();
        $guests = Guest::all();
        return view('bookings.create', compact('rooms', 'guests'));
    }

    // CREATE: Store data in DB
    public function store(Request $request) {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'guest_id' => 'required|exists:guests,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'total_price' => 'required|numeric',
            'status' => 'required|string'
        ]);

        Booking::create($request->all());
        return redirect()->route('bookings.index')->with('success', 'Booking added successfully!');
    }

    // UPDATE: Show edit form
    public function edit(Booking $booking) {
        $rooms = Room::all();
        $guests = Guest::all();
        return view('bookings.edit', compact('booking', 'rooms', 'guests'));
    }

    // UPDATE: Update data in DB
    public function update(Request $request, Booking $booking) {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'guest_id' => 'required|exists:guests,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'total_price' => 'required|numeric',
            'status' => 'required|string'
        ]);

        $booking->update($request->all());
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }

    // DELETE: Remove booking from DB
    public function destroy(Booking $booking) {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully!');
    }
}
