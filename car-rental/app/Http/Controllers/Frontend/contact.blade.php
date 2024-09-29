@extends('layouts.frontend')

@section('content')
    <h1>Contact Us</h1>
    <p>If you have any questions, feel free to reach out to us!</p>
    <form action="{{ route('frontend.contact.submit') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
    </form>
@endsection
