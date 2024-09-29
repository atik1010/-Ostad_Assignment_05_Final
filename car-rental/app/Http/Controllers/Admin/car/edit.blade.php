@extends('layouts.admin')

@section('content')
    <h1>Edit Car</h1>

    <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $car->name }}" required>
        <input type="text" name="brand" value="{{ $car->brand }}" required>
        <input type="text" name="model" value="{{ $car->model }}" required>
        <input type="number" name="year" value="{{ $car->year }}" required>
        <input type="text" name="car_type" value="{{ $car->car_type }}" required>
        <input type="number" name="daily_rent_price" value="{{ $car->daily_rent_price }}" required step="0.01">
        <select name="availability" required>
            <option value="1" {{ $car->availability ? 'selected' : '' }}>Available</option>
            <option value="0" {{ !$car->availability ? 'selected' : '' }}>Not Available</option>
        </select>
        <input type="file" name="image">
        <button type="submit">Update Car</button>
    </form>
@endsection
