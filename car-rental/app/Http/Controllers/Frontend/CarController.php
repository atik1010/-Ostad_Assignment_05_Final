namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // Display available cars
    public function index(Request $request)
    {
        $query = Car::where('availability', true);

        // Filter cars based on query parameters (if any)
        if ($request->has('car_type')) {
            $query->where('car_type', $request->input('car_type'));
        }

        if ($request->has('brand')) {
            $query->where('brand', $request->input('brand'));
        }

        if ($request->has('max_price')) {
            $query->where('daily_rent_price', '<=', $request->input('max_price'));
        }

        $cars = $query->get();

        return view('frontend.cars.index', compact('cars'));
    }
}
