@extends('layouts.admin')

@section('content')
    <h1>Add New Car</h1>

    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Car Name" required>
        <input type="text" name="brand" placeholder="Brand" required>
        <input type="text" name="model" placeholder="Model" required>
        <input type="number" name="year" placeholder="Year" required>
        <input type="text" name="car_type" placeholder="Car Type" required>
        <input type="number" name="daily_rent_price" placeholder="Daily Rent Price" required step="0.01">
        <select name="availability" required>
            <option value="1">Available</option>
            <option value="0">Not Available</option>
        </select>
        <input type="file" name="image">
        <button type="submit">Add Car</button>
    </form>
@endsection
