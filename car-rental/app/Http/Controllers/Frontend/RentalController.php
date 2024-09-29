namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    // Display user's current and past rentals
    public function index()
    {
        $rentals = Rental::with(['car'])->where('user_id', Auth::id())->get();
        return view('frontend.rentals.index', compact('rentals'));
    }

    // Store a new rental (if you want to allow users to book directly)
    public function store(Request $request)
    {
        // Similar to the admin store method, but you should verify the user context (Auth::id())
    }

    // Cancel a rental
    public function cancel(Rental $rental)
    {
        if ($rental->user_id !== Auth::id()) {
            return redirect()->route('frontend.rentals.index')->withErrors('Unauthorized action.');
        }

        // Check if the rental has started
        if (strtotime($rental->start_date) > time()) {
            $rental->delete();
            // Optionally, mark the car as available again
            $car = $rental->car;
            $car->availability = true;
            $car->save();

            return redirect()->route('frontend.rentals.index')->with('success', 'Rental canceled successfully.');
        }

        return redirect()->route('frontend.rentals.index')->withErrors('Cannot cancel a rental that has already started.');
    }
}
