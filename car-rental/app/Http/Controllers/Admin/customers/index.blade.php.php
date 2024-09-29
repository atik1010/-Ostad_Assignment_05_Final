@extends('layouts.admin')

@section('content')
    <h1>Customers</h1>
    <a href="{{ route('admin.customers.create') }}">Create New Customer</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>
                        <a href="{{ route('admin.customers.edit', $customer->id) }}">Edit</a>
                        <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        <a href="{{ route('admin.customers.rentalHistory', $customer->id) }}">View Rentals</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
