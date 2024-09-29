@extends('layouts.admin')

@section('content')
    <h1>Create Customer</h1>

    <form action="{{ route('admin.customers.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <input type="text" name="phone" placeholder="Phone">
        <input type="text" name="address" placeholder="Address">
        <button type="submit">Create Customer</button>
    </form>
@endsection
