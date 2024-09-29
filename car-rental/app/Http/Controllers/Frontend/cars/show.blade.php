@extends('layouts.frontend')

@section('content')
    <h1>{{ $car->name }}</h1>
    <p>Brand: {{ $car->brand }}</p>
    <p>Model: {{ $car->model }}</p>
    <p>Year: {{ $car->year }}</p>
    <p>Type: {{ $car->car_type }}</p>
    <p>Daily Rent Price: ${{ $car->daily_rent_price }}</p>

    <form action="{{ route('frontend.cars.book', $car->id) }}" method="POST">
        @csrf
        <input type="date" name="start_date" required>
        <input type="date" name="end_date" required>
        <button type="submit">Book Car</button>
    </form>

    <a href="{{ route('frontend.cars.index') }}">Back to Available Cars</a>
@endsection
