<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Room Properties</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white border border-slate-200 shadow-xl rounded-2xl max-w-md w-full overflow-hidden">
        <div class="bg-slate-900 text-white p-6 flex items-center gap-3">
            <div class="p-2.5 bg-slate-800 rounded-lg text-blue-400"><i class="fa-solid fa-pen-to-square"></i></div>
            <div>
                <h3 class="font-bold text-lg">Modify Room Record</h3>
                <p class="text-xs text-slate-400">Updating inventory metrics for Room #{{ $room->room_number }}</p>
            </div>
        </div>

        <form action="{{ route('rooms.update', $room->id) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-1.5">Room Code / Number</label>
                <div class="relative">
                    <i class="fa-solid fa-hashtag absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
                    <input type="text" name="room_number" value="{{ $room->room_number }}" required class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white rounded-xl text-sm font-medium outline-hidden transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-1.5">Architectural Specification</label>
                <div class="relative">
                    <i class="fa-solid fa-bed absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
                    <select name="type" class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white rounded-xl text-sm font-medium outline-hidden transition appearance-none">
                        <option value="Single" {{ $room->type == 'Single' ? 'selected' : '' }}>Single Deluxe Room</option>
                        <option value="Double" {{ $room->type == 'Double' ? 'selected' : '' }}>Double Executive Room</option>
                        <option value="Suite" {{ $room->type == 'Suite' ? 'selected' : '' }}>Presidential Suite</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-1.5">Nightly Standard Rate (USD)</label>
                <div class="relative">
                    <i class="fa-solid fa-dollar-sign absolute left-4 top-3.5 text-slate-400 text-xs"></i>
                    <input type="number" step="0.01" name="price" value="{{ $room->price }}" required class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white rounded-xl text-sm font-medium outline-hidden transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-1.5">Operational Status</label>
                <div class="relative">
                    <i class="fa-solid fa-circle-info absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
                    <select name="is_available" class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white rounded-xl text-sm font-medium outline-hidden transition appearance-none">
                        <option value="1" {{ $room->is_available ? 'selected' : '' }}>Available / Open</option>
                        <option value="0" {{ !$room->is_available ? 'selected' : '' }}>Occupied / Under Maintenance</option>
                    </select>
                </div>
            </div>

            <div class="pt-2 space-y-2">
                <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-500 text-white font-semibold text-sm rounded-xl shadow-md shadow-blue-600/10 transition cursor-pointer">
                    Apply Modifications
                </button>
                <a href="{{ route('rooms.index') }}" class="block w-full text-center py-2.5 text-xs font-semibold text-slate-400 hover:text-slate-600 transition">
                    Discard Changes
                </a>
            </div>
        </form>
    </div>

</body>
</html>