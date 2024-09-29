use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\CarController as FrontendCarController;
use App\Http\Controllers\Frontend\RentalController as FrontendRentalController;

// Admin routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::resource('cars', AdminCarController::class);
    Route::resource('rentals', AdminRentalController::class);
    Route::resource('customers', AdminCustomerController::class);
});

// Frontend routes
Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/rentals', [FrontendCarController::class, 'index']);
Route::post('/book-car', [FrontendRentalController::class, 'store']);
Route::get('/my-bookings', [FrontendRentalController::class, 'index'])->middleware('auth');
