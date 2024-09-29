@extends('layouts.admin')

@section('content')
    <h1>Create Rental</h1>

    <form action="{{ route('admin.rentals.store') }}" method="POST">
        @csrf
        <select name="user_id" required>
            <option value="">Select Customer</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>

        <select name="car_id" required>
            <option value="">Select Car</option>
            @foreach ($cars as $car)
                <option value="{{ $car->id }}">{{ $car->name }}</option>
            @endforeach
        </select>

        <input type="date" name="start_date" required>
        <input type="date" name="end_date" required>
        <button type="submit">Create Rental</button>
    </form>
@endsection
