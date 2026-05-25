<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Horizon Hotel - Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
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
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-emerald-600 text-white rounded-lg font-medium shadow-sm">
                <i class="fa-solid fa-chart-pie w-5"></i> Dashboard
            </a>
            <a href="{{ route('rooms.index') }}" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition">
                <i class="fa-solid fa-bed w-5"></i> Rooms Inventory
            </a>
            <a href="{{ route('guests.index') }}" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition">
                <i class="fa-solid fa-users w-5"></i> Guests
            </a>
            <a href="{{ route('bookings.index') }}" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition">
                <i class="fa-solid fa-calendar-check w-5"></i> Bookings
            </a>
        </nav>
        <div class="p-4 border-t border-slate-800 text-xs text-slate-500 text-center">
            v1.0.0 &copy; 2026 Management
        </div>
    </aside>

    <main class="flex-1 pl-64">
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-8 sticky top-0 z-20">
            <h1 class="text-xl font-bold text-slate-800">Dashboard</h1>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-semibold text-sm">
                    A
                </div>
            </div>
        </header>

        <div class="p-8 max-w-7xl mx-auto space-y-8">
            <!-- Key Metrics Row 1 -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Rooms</p>
                            <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $totalRooms }}</h3>
                        </div>
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                            <i class="fa-solid fa-door-open text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">Overall property capacity</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Available Rooms</p>
                            <h3 class="text-3xl font-bold text-emerald-600 mt-2">{{ $availableRooms }}</h3>
                        </div>
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                            <i class="fa-solid fa-check-circle text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">Ready for booking</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Occupancy Rate</p>
                            <h3 class="text-3xl font-bold text-amber-600 mt-2">{{ $occupancyRate }}%</h3>
                        </div>
                        <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                            <i class="fa-solid fa-chart-pie text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">Current occupancy level</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Revenue</p>
                            <h3 class="text-3xl font-bold text-indigo-600 mt-2">${{ number_format($totalRevenue, 0) }}</h3>
                        </div>
                        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">
                            <i class="fa-solid fa-money-bill text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">All-time earnings</p>
                </div>
            </div>

            <!-- Key Metrics Row 2 -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Guests</p>
                            <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $totalGuests }}</h3>
                        </div>
                        <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
                            <i class="fa-solid fa-users text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">Registered guests</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Bookings</p>
                            <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $totalBookings }}</h3>
                        </div>
                        <div class="p-3 bg-pink-50 text-pink-600 rounded-lg">
                            <i class="fa-solid fa-calendar text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">Total reservations</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Confirmed</p>
                            <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $confirmedBookings }}</h3>
                        </div>
                        <div class="p-3 bg-green-50 text-green-600 rounded-lg">
                            <i class="fa-solid fa-circle-check text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">Confirmed bookings</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">This Month</p>
                            <h3 class="text-3xl font-bold text-cyan-600 mt-2">${{ number_format($revenueThisMonth, 0) }}</h3>
                        </div>
                        <div class="p-3 bg-cyan-50 text-cyan-600 rounded-lg">
                            <i class="fa-solid fa-calendar-days text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">Monthly revenue</p>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Room Status Chart -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <h3 class="text-lg font-bold text-slate-900 mb-6">Room Status Overview</h3>
                    <div class="relative h-64">
                        <canvas id="roomChart"></canvas>
                    </div>
                </div>

                <!-- Booking Status Chart -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <h3 class="text-lg font-bold text-slate-900 mb-6">Booking Status Distribution</h3>
                    <div class="relative h-64">
                        <canvas id="bookingChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings Table -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h2 class="text-lg font-bold text-slate-900">Recent Bookings</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Latest reservation activity</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                <th class="py-4 px-6">Booking ID</th>
                                <th class="py-4 px-6">Guest</th>
                                <th class="py-4 px-6">Room</th>
                                <th class="py-4 px-6">Dates</th>
                                <th class="py-4 px-6">Amount</th>
                                <th class="py-4 px-6">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($recentBookings as $booking)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="py-4 px-6 font-semibold text-slate-900">BKG-00{{ $booking->id }}</td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold">
                                            {{ strtoupper(substr($booking->guest->name ?? 'N/A', 0, 1)) }}
                                        </div>
                                        <span>{{ $booking->guest->name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-slate-600">Room {{ $booking->room->room_number ?? 'N/A' }}</td>
                                <td class="py-4 px-6 text-slate-600">
                                    {{ $booking->check_in->format('M d') }} - {{ $booking->check_out->format('M d') }}
                                </td>
                                <td class="py-4 px-6 font-semibold text-slate-900">${{ number_format($booking->total_price, 2) }}</td>
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
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-slate-400">
                                    <i class="fa-solid fa-inbox text-2xl block mb-2 text-slate-300"></i>
                                    No bookings yet
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Room Status Chart
        const roomCtx = document.getElementById('roomChart').getContext('2d');
        new Chart(roomCtx, {
            type: 'doughnut',
            data: {
                labels: ['Available', 'Occupied'],
                datasets: [{
                    data: [{{ $availableRooms }}, {{ $totalRooms - $availableRooms }}],
                    backgroundColor: ['#10b981', '#f59e0b'],
                    borderColor: ['#ffffff', '#ffffff'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 12 },
                            padding: 15,
                            usePointStyle: true
                        }
                    }
                }
            }
        });

        // Booking Status Chart
        const bookingCtx = document.getElementById('bookingChart').getContext('2d');
        const pendingCount = {{ \App\Models\Booking::where('status', 'Pending')->count() }};
        const cancelledCount = {{ \App\Models\Booking::where('status', 'Cancelled')->count() }};
        
        new Chart(bookingCtx, {
            type: 'doughnut',
            data: {
                labels: ['Confirmed', 'Pending', 'Cancelled'],
                datasets: [{
                    data: [{{ $confirmedBookings }}, pendingCount, cancelledCount],
                    backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                    borderColor: ['#ffffff', '#ffffff', '#ffffff'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 12 },
                            padding: 15,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>
