public function submitContact(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    // Here you can send an email or store the message as needed

    return redirect()->route('frontend.contact')->with('success', 'Your message has been sent successfully!');
}
