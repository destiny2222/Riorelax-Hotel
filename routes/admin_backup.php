<?php


use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\RoomAmenityController;
use App\Http\Controllers\Admin\RoomListingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SystemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\BladeEditorController;
use App\Http\Controllers\Admin\AdminController; // Add this line

Route::prefix('admin')->name('admin.')->group(function (){ 

    Route::middleware('admin.logged_out')->group(function () {
        Route::controller(LoginController::class)->group(function (){
            Route::get('login','showLoginForm')->name('login.form');
            Route::post('login-post', 'login')->name('login');
            Route::post('logout','logout')->name('logout');
        });
    });

    Route::middleware('admin.logged_in')->group(function () { 
    Route::get('/dashboard', [ HomeController::class,'index' ])->name('home');
    Route::get('/setting', [ HomeController::class,'settings' ])->name('settings.index');


    // room listing - Super Admin only
    Route::middleware(['role:super-admin'])->group(function () {
        Route::get('/room/listing', [RoomListingController::class,'index'])->name('roomListing.index');
        Route::get('/room/listing/create', [RoomListingController::class,'create'])->name('roomListing.create');
        Route::post('/room/listing', [RoomListingController::class,'store'])->name('roomListing.store');
        Route::get('/room/listing/{id}/edit', [RoomListingController::class,'edit'])->name('roomListing.edit');
        Route::put('/room/listing/{id}/update', [RoomListingController::class,'update'])->name('roomListing.update');
        Route::delete('/room/listing/{id}/delete', [RoomListingController::class,'destroy'])->name('roomListing.destroy');
    });

    // booking
    // All roles can view bookings
    Route::middleware(['role:super-admin,supervisor,front-desk'])->group(function () {
        Route::get('/booking/list', [BookingController::class,'index'])->name('booking.index');
        Route::get('/booking/{id}/show', [BookingController::class, 'show'])->name('booking.show');
    });

    // Front Desk can initiate edits, Supervisor/Super Admin can edit directly
    Route::middleware(['role:super-admin,supervisor,front-desk'])->group(function () {
        Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
        Route::put('/booking/{id}/update', [BookingController::class, 'update'])->name('booking.update');
    });

    // Only Super Admin can delete bookings
    Route::middleware(['role:super-admin'])->group(function () {
        Route::delete('/booking/{id}/delete', [BookingController::class,'destroy'])->name('booking.delete');
    });

    // Supervisor and Super Admin can approve/reject booking edits
    Route::middleware(['role:super-admin,supervisor'])->group(function () {
        Route::put('/booking/{id}/approve', [BookingController::class, 'approve'])->name('booking.approve');
        Route::put('/booking/{id}/reject', [BookingController::class, 'reject'])->name('booking.reject');
    });

    // Super Admin can create bookings directly with amount/discount edits
    Route::middleware(['role:super-admin'])->group(function () {
        Route::get('/bookings/create', [AdminBookingController::class, 'create'])->name('bookings.create');
        Route::post('/bookings', [AdminBookingController::class, 'store'])->name('bookings.store');
    });

    // Blade Editor Routes - Super Admin only
    Route::middleware(['role:super-admin'])->group(function () {
        Route::get('/blade-editor', [BladeEditorController::class, 'index'])->name('blade.editor.index');
        Route::get('/blade-editor/show', [BladeEditorController::class, 'show'])->name('blade.editor.show');
        Route::post('/blade-editor/update', [BladeEditorController::class, 'update'])->name('blade.editor.update');
    });

    // user customer
    // All roles can view the customer list
    Route::middleware(['role:super-admin,supervisor,front-desk'])->group(function () {
        Route::get('/customer', [CustomerController::class,'index'])->name('customer.index');
    });
    // Only Super Admin can edit/delete customers
    Route::middleware(['role:super-admin'])->group(function () {
        Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::put('/customer/{id}/update', [CustomerController::class, 'update'])->name('customer.update');
        Route::delete('/customer/{id}/delete', [CustomerController::class, 'destroy'])->name('customer.destroy');
    });

    
        // Scan - All roles can validate bookings via QR scan
        Route::middleware(['role:super-admin,supervisor,front-desk'])->group(function () {
            Route::get('/booking/scan', [HomeController::class, 'scanCode'])->name('booking.scan');
            Route::get('/booking/scan/result', [HomeController::class, 'scanCodeResult'])->name('scan.result.store');
            Route::post('/booking/verify-qr', [HomeController::class, 'verifyQRCode'])->name('booking.verify-qr');
            Route::get('/booking/verified/{id}', [HomeController::class, 'showVerifiedBooking'])->name('booking.verified');
        });
        
        // Amenities - Super Admin only
        Route::middleware(['role:super-admin'])->group(function () {
            Route::get('amenities', [ RoomAmenityController::class, 'index'])->name('amenities.index');
            Route::get('amenities/create', [ RoomAmenityController::class, 'create'])->name('amenities.create');
            Route::post('amenities/store', [ RoomAmenityController::class, 'store'])->name('amenities.store');
            Route::get('amenities/edit/{id}', [ RoomAmenityController::class, 'edit'])->name('amenities.edit');
            Route::put('amenities/update/{id}', [ RoomAmenityController::class, 'update'])->name('amenities.update');
            Route::delete('amenities/delete/{id}', [ RoomAmenityController::class, 'destroy'])->name('amenities.destroy');
        });


        // Admin Profile and Password - All roles can manage their own profile
        Route::get('/profile/edit', [AdminController::class, 'showProfileForm'])->name('profile.edit');
        Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::get('/password/change', [AdminController::class, 'showChangePasswordForm'])->name('password.form');
        Route::post('/password/change', [AdminController::class, 'changePassword'])->name('password.change');

    });
    
});