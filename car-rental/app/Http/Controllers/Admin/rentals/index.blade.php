@extends('layouts.admin')

@section('content')
    <h1>Rentals</h1>
    <a href="{{ route('admin.rentals.create') }}">Create New Rental</a>

    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
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
                    <td>{{ $rental->user->name }}</td>
                    <td>{{ $rental->car->name }}</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <td>${{ $rental->total_cost }}</td>
                    <td>Ongoing</td> <!-- Adjust status based on actual rental state -->
                    <td>
                        <a href="{{ route('admin.rentals.edit', $rental->id) }}">Edit</a>
                        <form action="{{ route('admin.rentals.destroy', $rental->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
