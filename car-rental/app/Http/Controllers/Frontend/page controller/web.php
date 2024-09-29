use App\Http\Controllers\Frontend\PageController;

// Frontend routes
Route::get('/', [PageController::class, 'home'])->name('frontend.home');
Route::get('/about', [PageController::class, 'about'])->name('frontend.about');
Route::get('/contact', [PageController::class, 'contact'])->name('frontend.contact');
Route::get('/rentals', [PageController::class, 'rentals'])->name('frontend.rentals');
