<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Horizon Hotel - Create Booking</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 flex min-h-screen">

    <aside class="w-64 bg-slate-900 text-white flex flex-col fixed h-full z-10">
        <div class="p-6 border-b border-slate-800 flex items-center gap-3">
            <i class="fa-solid fa-hotel text-emerald-400 text-2xl"></i>
            <span class="font-bold text-lg tracking-wide">Grand Horizon</span>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition">
                <i class="fa-solid fa-chart-pie w-5"></i> Dashboard
            </a>
            <a href="{{ route('rooms.index') }}" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition">
                <i class="fa-solid fa-bed w-5"></i> Rooms Inventory
            </a>
            <a href="{{ route('guests.index') }}" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition">
                <i class="fa-solid fa-users w-5"></i> Guests
            </a>
            <a href="{{ route('bookings.index') }}" class="flex items-center gap-3 px-4 py-3 bg-emerald-600 text-white rounded-lg font-medium shadow-sm">
                <i class="fa-solid fa-calendar-check w-5"></i> Bookings
            </a>
        </nav>
        <div class="p-4 border-t border-slate-800 text-xs text-slate-500 text-center">
            v1.0.0 &copy; 2026 Management
        </div>
    </aside>

    <main class="flex-1 pl-64">
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-8 sticky top-0 z-20">
            <h1 class="text-xl font-bold text-slate-800">Create New Booking</h1>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-semibold text-sm">
                    A
                </div>
            </div>
        </header>

        <div class="p-8 max-w-2xl mx-auto">
            <div class="bg-white border border-slate-200 rounded-2xl shadow-xs p-6">
                <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="guest_id" class="block text-sm font-semibold text-slate-900 mb-2">Select Guest</label>
                        <select 
                            id="guest_id" 
                            name="guest_id" 
                            required
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition"
                        >
                            <option value="">Choose a guest...</option>
                            @foreach($guests as $guest)
                                <option value="{{ $guest->id }}">{{ $guest->name }} ({{ $guest->email }})</option>
                            @endforeach
                        </select>
                        @error('guest_id')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="room_id" class="block text-sm font-semibold text-slate-900 mb-2">Select Room</label>
                        <select 
                            id="room_id" 
                            name="room_id" 
                            required
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition"
                        >
                            <option value="">Choose a room...</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}">Room {{ $room->room_number }} - {{ $room->type }} (${{ $room->price }}/night)</option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="check_in" class="block text-sm font-semibold text-slate-900 mb-2">Check-in Date</label>
                            <input 
                                type="date" 
                                id="check_in" 
                                name="check_in" 
                                value="{{ old('check_in') }}"
                                required
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition"
                            >
                            @error('check_in')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="check_out" class="block text-sm font-semibold text-slate-900 mb-2">Check-out Date</label>
                            <input 
                                type="date" 
                                id="check_out" 
                                name="check_out" 
                                value="{{ old('check_out') }}"
                                required
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition"
                            >
                            @error('check_out')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="total_price" class="block text-sm font-semibold text-slate-900 mb-2">Total Price</label>
                            <input 
                                type="number" 
                                id="total_price" 
                                name="total_price" 
                                value="{{ old('total_price') }}"
                                step="0.01"
                                required
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition"
                                placeholder="0.00"
                            >
                            @error('total_price')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-slate-900 mb-2">Status</label>
                            <select 
                                id="status" 
                                name="status" 
                                required
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition"
                            >
                                <option value="Confirmed">Confirmed</option>
                                <option value="Pending">Pending</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                            @error('status')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button 
                            type="submit" 
                            class="flex-1 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm rounded-lg transition shadow-sm"
                        >
                            <i class="fa-solid fa-check mr-2"></i>Create Booking
                        </button>
                        <a 
                            href="{{ route('bookings.index') }}" 
                            class="flex-1 px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-900 font-medium text-sm rounded-lg transition shadow-sm text-center"
                        >
                            <i class="fa-solid fa-times mr-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>
</html>
