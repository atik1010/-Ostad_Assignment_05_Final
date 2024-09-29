@extends('layouts.frontend')

@section('content')
    <h1>Your Rentals</h1>

    <table>
        <thead>
            <tr>
                <th>Car</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Cost</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentals as $rental)
                <tr>
                    <td>{{ $rental->car->name }}</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <td>${{ $rental->total_cost }}</td>
                    <td>Ongoing</td> <!-- Adjust status based on actual rental state -->
                    <td>
                        @if (strtotime($rental->start_date) > time())
                            <form action="{{ route('frontend.rentals.cancel', $rental->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit">Cancel</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
