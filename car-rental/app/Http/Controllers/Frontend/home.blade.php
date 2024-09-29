@extends('layouts.frontend')

@section('content')
    <h1>Welcome to Our Car Rental Service</h1>
    <p>Browse our collection of cars available for rental.</p>
    <a href="{{ route('frontend.cars.index') }}">View Cars</a>
@endsection
