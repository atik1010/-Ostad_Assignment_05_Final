@extends('layouts.admin')

@section('content')
    <h1>Rental History for {{ $customer->name }}</h1>

    <table>
        <thead>
            <tr>
                <th>Car</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Cost</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentals as $rental)
                <tr>
                    <td>{{ $rental->car->name }}</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <td>${{ $rental->total_cost }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
