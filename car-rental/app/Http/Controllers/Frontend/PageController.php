namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Display the home page
    public function home()
    {
        return view('frontend.home');
    }

    // Display the about page
    public function about()
    {
        return view('frontend.about');
    }

    // Display the contact page
    public function contact()
    {
        return view('frontend.contact');
    }

    // Display the rentals page (optional)
    public function rentals()
    {
        return view('frontend.rentals');
    }
}
