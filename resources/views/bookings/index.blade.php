<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Horizon Hotel - Bookings</title>
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
            <h1 class="text-xl font-bold text-slate-800">Booking Management</h1>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-semibold text-sm">
                    A
                </div>
            </div>
        </header>

        <div class="p-8 max-w-6xl mx-auto space-y-8">
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-r-xl flex items-center gap-3 shadow-xs">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                    <p class="font-medium text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
                    <div class="p-4 bg-blue-50 text-blue-600 rounded-xl"><i class="fa-solid fa-calendar text-2xl"></i></div>
                    <div>
                        <span class="text-xs font-semibold text-slate-400 tracking-wider uppercase">Total Bookings</span>
                        <h3 class="text-2xl font-bold mt-1">{{ $bookings->count() }} Bookings</h3>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
                    <div class="p-4 bg-emerald-50 text-emerald-600 rounded-xl"><i class="fa-solid fa-check-circle text-2xl"></i></div>
                    <div>
                        <span class="text-xs font-semibold text-slate-400 tracking-wider uppercase">Confirmed</span>
                        <h3 class="text-2xl font-bold mt-1 text-emerald-600">{{ $bookings->where('status', 'Confirmed')->count() }}</h3>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
                    <div class="p-4 bg-amber-50 text-amber-600 rounded-xl"><i class="fa-solid fa-money-bill text-2xl"></i></div>
                    <div>
                        <span class="text-xs font-semibold text-slate-400 tracking-wider uppercase">Total Revenue</span>
                        <h3 class="text-2xl font-bold mt-1 text-amber-600">${{ number_format($bookings->sum('total_price'), 2) }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">All Bookings</h2>
                        <p class="text-xs text-slate-400 mt-0.5">View and manage all guest reservations.</p>
                    </div>
                    <a href="{{ route('bookings.create') }}" class="px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-medium text-sm rounded-xl flex items-center gap-2 transition shadow-sm">
                        <i class="fa-solid fa-plus text-xs"></i> Create New Booking
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                <th class="py-4 px-6">Booking ID</th>
                                <th class="py-4 px-6">Guest Name</th>
                                <th class="py-4 px-6">Room</th>
                                <th class="py-4 px-6">Check-in / Check-out</th>
                                <th class="py-4 px-6">Total Price</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm font-medium">
                            @forelse($bookings as $booking)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="py-4 px-6">
                                    <span class="text-slate-900 font-semibold">BKG-00{{ $booking->id }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold">
                                            {{ strtoupper(substr($booking->guest->name ?? 'N/A', 0, 1)) }}
                                        </div>
                                        <span>{{ $booking->guest->name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-slate-600">
                                    Room {{ $booking->room->room_number ?? 'N/A' }}
                                </td>
                                <td class="py-4 px-6 text-slate-600">
                                    {{ $booking->check_in->format('M d') }} - {{ $booking->check_out->format('M d, Y') }}
                                </td>
                                <td class="py-4 px-6 font-semibold text-slate-900">
                                    ${{ number_format($booking->total_price, 2) }}
                                </td>
                                <td class="py-4 px-6">
                                    @if($booking->status === 'Confirmed')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-xs font-semibold text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Confirmed
                                        </span>
                                    @elseif($booking->status === 'Pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-xs font-semibold text-amber-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-xs font-semibold text-red-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Cancelled
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <a href="{{ route('bookings.edit', $booking->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-blue-600 transition" title="Edit Booking">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to cancel this booking?')" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-200 text-slate-500 hover:bg-red-50 hover:text-red-600 hover:border-red-100 transition cursor-pointer" title="Delete Booking">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    <i class="fa-solid fa-calendar-check text-3xl block mb-3 text-slate-300"></i>
                                    No bookings available yet. Click the create button to add a new booking.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
