@extends('layouts.frontend')

@section('content')
    <h1>Available Cars</h1>

    <form method="GET" action="{{ route('frontend.cars.index') }}">
        <select name="car_type">
            <option value="">All Types</option>
            <option value="SUV">SUV</option>
            <option value="Sedan">Sedan</option>
            <!-- Add more types as needed -->
        </select>

        <select name="brand">
            <option value="">All Brands</option>
            <option value="Toyota">Toyota</option>
            <option value="Ford">Ford</option>
            <!-- Add more brands as needed -->
        </select>

        <input type="number" name="max_price" placeholder="Max Price">

        <button type="submit">Filter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Car Name</th>
                <th>Brand</th>
                <th>Daily Rent Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr>
                    <td>{{ $car->name }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>${{ $car->daily_rent_price }}</td>
                    <td>
                        <a href="{{ route('frontend.cars.show', $car->id) }}">Book Now</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
