<?php
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\HotelController;
use App\Http\Controllers\Frontend\RoomController;
use App\Http\Controllers\Frontend\BookingController;

use App\Http\Controllers\Backend\HotelController as BackendHotelController;
use App\Http\Controllers\Backend\RoomController as BackendRoomController;
use App\Http\Controllers\Backend\BookingController as BackendBookingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingsController;

use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Hotels
    Route::resource('hotels', BackendHotelController::class);
    
    // Rooms
    Route::resource('rooms', BackendRoomController::class);
    
    // Bookings
    Route::resource('bookings', BackendBookingController::class);
    
    // Users
    Route::resource('users', UserController::class);
      Route::get('settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
});



// Frontend Home Route
Route::get('/', [HomeController::class, 'index'])->name('frontend.home');

// Frontend Hotel Routes
Route::get('/hotels', [HotelController::class, 'index'])->name('frontend.hotels.index');
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('frontend.hotels.show');

// Frontend Room Routes
Route::get('/rooms', [RoomController::class, 'index'])->name('frontend.rooms.index');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('frontend.rooms.show');
Route::get('/rooms/{id}/check-availability', [RoomController::class, 'checkAvailability'])->name('frontend.rooms.checkAvailability');

// Frontend Booking Routes
Route::get('/bookings', [BookingController::class, 'index'])->name('frontend.bookings.index')->middleware('auth');
Route::get('/bookings/create/{roomId}', [BookingController::class, 'create'])->name('frontend.bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('frontend.bookings.store');
Route::get('/bookings/paypal/callback', [BookingController::class, 'paypalCallback'])->name('frontend.bookings.paypal.callback');


// Add this route to your routes/web.php
Route::post('/update-password', [BookingController::class, 'updatePassword'])->name('frontend.updatePassword')->middleware('auth');






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
