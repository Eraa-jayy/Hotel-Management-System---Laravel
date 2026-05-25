<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Room</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .form-card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 350px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-submit { background: #27ae60; color: white; border: none; padding: 10px; width: 100%; border-radius: 4px; cursor: pointer; font-size: 16px; }
        .back-link { display: block; margin-top: 15px; text-align: center; color: #7f8c8d; text-decoration: none; }
    </style>
</head>
<body>

<div class="form-card">
    <h3>Add New Room</h3>
    <form action="{{ route('rooms.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Room Number</label>
            <input type="text" name="room_number" required placeholder="e.g. 101">
        </div>
        <div class="form-group">
            <label>Room Type</label>
            <select name="type">
                <option value="Single">Single</option>
                <option value="Double">Double</option>
                <option value="Suite">Suite</option>
            </select>
        </div>
        <div class="form-group">
            <label>Price per Night</label>
            <input type="number" step="0.01" name="price" required placeholder="e.g. 150.00">
        </div>
        <button type="submit" class="btn-submit">Save Room</button>
    </form>
    <a href="{{ route('rooms.index') }}" class="back-link">← Cancel and Go Back</a>
</div>

</body>
</html>