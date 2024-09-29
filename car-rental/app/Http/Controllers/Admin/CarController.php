namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // Display a list of cars
    public function index()
    {
        $cars = Car::all();
        return view('admin.cars.index', compact('cars'));
    }

    // Show the form for creating a new car
    public function create()
    {
        return view('admin.cars.create');
    }

    // Store a newly created car in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'car_type' => 'required|string|max:50',
            'daily_rent_price' => 'required|numeric',
            'availability' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $car = new Car($request->all());

        // Handle image upload
        if ($request->hasFile('image')) {
            $car->image = $request->file('image')->store('cars', 'public');
        }

        $car->save();

        return redirect()->route('admin.cars.index')->with('success', 'Car added successfully.');
    }

    // Show the form for editing a car
    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    // Update the specified car in storage
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'car_type' => 'required|string|max:50',
            'daily_rent_price' => 'required|numeric',
            'availability' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $car->fill($request->all());

        // Handle image upload
        if ($request->hasFile('image')) {
            // Optionally delete the old image if required
            $car->image = $request->file('image')->store('cars', 'public');
        }

        $car->save();

        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully.');
    }

    // Remove the specified car from storage
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully.');
    }
}
