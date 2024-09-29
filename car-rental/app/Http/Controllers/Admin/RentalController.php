namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    // Display a list of all rentals
    public function index()
    {
        $rentals = Rental::with(['car', 'user'])->get();
        return view('admin.rentals.index', compact('rentals'));
    }

    // Show the form for creating a new rental
    public function create()
    {
        $cars = Car::where('availability', true)->get();
        $customers = User::where('role', 'customer')->get();
        return view('admin.rentals.create', compact('cars', 'customers'));
    }

    // Store a newly created rental
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $car = Car::find($request->car_id);

        // Check availability
        $isAvailable = Rental::where('car_id', $car->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                      ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
            })
            ->doesntExist();

        if (!$isAvailable) {
            return back()->withErrors(['car_id' => 'The selected car is not available for the chosen dates.']);
        }

        $totalCost = $car->daily_rent_price * (strtotime($request->end_date) - strtotime($request->start_date)) / (60 * 60 * 24);

        Rental::create([
            'user_id' => $request->user_id,
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $totalCost,
        ]);

        // Update car availability
        $car->availability = false;
        $car->save();

        // Optionally, send notification emails to the customer and admin

        return redirect()->route('admin.rentals.index')->with('success', 'Rental created successfully.');
    }

    // Show the form for editing a rental
    public function edit(Rental $rental)
    {
        $cars = Car::all();
        $customers = User::where('role', 'customer')->get();
        return view('admin.rentals.edit', compact('rental', 'cars', 'customers'));
    }

    // Update the specified rental
    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Check availability
        $isAvailable = Rental::where('car_id', $request->car_id)
            ->where('id', '!=', $rental->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                      ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
            })
            ->doesntExist();

        if (!$isAvailable) {
            return back()->withErrors(['car_id' => 'The selected car is not available for the chosen dates.']);
        }

        $rental->update($request->all());

        return redirect()->route('admin.rentals.index')->with('success', 'Rental updated successfully.');
    }

    // Remove the specified rental
    public function destroy(Rental $rental)
    {
        // Optionally, update car availability if necessary
        $car = $rental->car;
        $car->availability = true; // Mark the car as available again
        $car->save();

        $rental->delete();
        return redirect()->route('admin.rentals.index')->with('success', 'Rental deleted successfully.');
    }
}
