@extends('layouts.admin')

@section('content')
    <h1>Edit Rental</h1>

    <form action="{{ route('admin.rentals.update', $rental->id) }}" method="POST">
        @csrf
        @method('PUT')

        <select name="user_id" required>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" {{ $customer->id == $rental->user_id ? 'selected' : '' }}>{{ $customer->name }}</option>
            @endforeach
        </select>

        <select name="car_id" required>
            @foreach ($cars as $car)
                <option value="{{ $car->id }}" {{ $car->id == $rental->car_id ? 'selected' : '' }}>{{ $car->name }}</option>
            @endforeach
        </select>

        <input type="date" name="start_date" value="{{ $rental->start_date }}" required>
        <input type="date" name="end_date" value="{{ $rental->end_date }}" required>
        <button type="submit">Update Rental</button>
    </form>
@endsection
