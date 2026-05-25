<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Management - Rooms</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f7f6; }
        .container { max-width: 900px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #2c3e50; color: white; }
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; color: white; display: inline-block; }
        .btn-add { background: #27ae60; margin-bottom: 15px; }
        .btn-edit { background: #2980b9; margin-right: 5px; }
        .btn-delete { background: #c0392b; border: none; cursor: pointer; padding: 8px 12px; border-radius: 4px; color: white; }
        .alert { padding: 10px; background: #d4edda; color: #155724; margin-bottom: 15px; border-radius: 4px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Hotel Room Management Dashboard</h2>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <a href="{{ route('rooms.create') }}" class="btn btn-add">+ Add New Room</a>

    <table>
        <thead>
            <tr>
                <th>Room #</th>
                <th>Type</th>
                <th>Price / Night</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
            <tr>
                <td>{{ $room->room_number }}</td>
                <td>{{ $room->type }}</td>
                <td>${{ number_format($room->price, 2) }}</td>
                <td>{{ $room->is_available ? 'Available' : 'Occupied' }}</td>
                <td>
                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-edit">Edit</a>
                    
                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>