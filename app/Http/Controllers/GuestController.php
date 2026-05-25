<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // READ: Display all guests
    public function index() {
        $guests = Guest::all();
        return view('guests.index', compact('guests'));
    }

    // CREATE: Show the add guest form
    public function create() {
        return view('guests.create');
    }

    // CREATE: Store data in DB
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:guests',
            'phone' => 'required|string'
        ]);

        Guest::create($request->all());
        return redirect()->route('guests.index')->with('success', 'Guest added successfully!');
    }

    // UPDATE: Show edit form
    public function edit(Guest $guest) {
        return view('guests.edit', compact('guest'));
    }

    // UPDATE: Update data in DB
    public function update(Request $request, Guest $guest) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:guests,email,'.$guest->id,
            'phone' => 'required|string'
        ]);

        $guest->update($request->all());
        return redirect()->route('guests.index')->with('success', 'Guest updated successfully!');
    }

    // DELETE: Remove guest from DB
    public function destroy(Guest $guest) {
        $guest->delete();
        return redirect()->route('guests.index')->with('success', 'Guest deleted successfully!');
    }
}
