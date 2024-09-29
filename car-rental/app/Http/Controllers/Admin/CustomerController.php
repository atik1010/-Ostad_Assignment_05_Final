namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Display a list of all customers
    public function index()
    {
        $customers = User::where('role', 'customer')->get();
        return view('admin.customers.index', compact('customers'));
    }

    // Show the form for creating a new customer
    public function create()
    {
        return view('admin.customers.create');
    }

    // Store a newly created customer
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'customer',
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully.');
    }

    // Show the form for editing a customer
    public function edit(User $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    // Update the specified customer
    public function update(Request $request, User $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        $customer->update($request->all());

        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully.');
    }

    // Remove the specified customer
    public function destroy(User $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully.');
    }

    // View rental history of a specific customer
    public function rentalHistory(User $customer)
    {
        $rentals = $customer->rentals()->with('car')->get();
        return view('admin.customers.rental_history', compact('customer', 'rentals'));
    }
}
