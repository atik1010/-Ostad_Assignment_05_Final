@extends('layouts.admin')

@section('content')
    <h1>Edit Customer</h1>

    <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $customer->name }}" required>
        <input type="email" name="email" value="{{ $customer->email }}" required>
        <input type="text" name="phone" value="{{ $customer->phone }}">
        <input type="text" name="address" value="{{ $customer->address }}">
        <button type="submit">Update Customer</button>
    </form>
@endsection
