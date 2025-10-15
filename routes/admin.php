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


    // room listing
    Route::get('/room/listing', [RoomListingController::class,'index'])->name('roomListing.index');
    Route::get('/room/listing/create', [RoomListingController::class,'create'])->name('roomListing.create');
    Route::post('/room/listing', [RoomListingController::class,'store'])->name('roomListing.store');
    Route::get('/room/listing/{id}/edit', [RoomListingController::class,'edit'])->name('roomListing.edit');
    Route::put('/room/listing/{id}/update', [RoomListingController::class,'update'])->name('roomListing.update');
    Route::delete('/room/listing/{id}/delete', [RoomListingController::class,'destroy'])->name('roomListing.destroy');

    // booking 
    Route::get('/booking/list', [BookingController::class,'index'])->name('booking.index');
    Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
    Route::get('/booking/{id}/show', [BookingController::class, 'show'])->name('booking.show');
    Route::put('/booking/{id}/update', [BookingController::class, 'update'])->name('booking.update');
    Route::delete('/booking/{id}/delete', [BookingController::class,'destroy'])->name('booking.delete');

    Route::middleware(['role:super-admin'])->group(function () {
        Route::get('/bookings/create', [AdminBookingController::class, 'create'])->name('bookings.create');
        Route::post('/bookings', [AdminBookingController::class, 'store'])->name('bookings.store');

        // Blade Editor Routes
        Route::get('/blade-editor', [BladeEditorController::class, 'index'])->name('blade.editor.index');
        Route::get('/blade-editor/show', [BladeEditorController::class, 'show'])->name('blade.editor.show');
        Route::post('/blade-editor/update', [BladeEditorController::class, 'update'])->name('blade.editor.update');
    });

    // user customer 
    Route::get('/customer', [CustomerController::class,'index'])->name('customer.index');
    Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/{id}/update', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{id}/delete', [CustomerController::class, 'destroy'])->name('customer.destroy');

    


    
        //system clear
        //  Route::get('/system', [SystemController::class, 'index'])->name('system.index');
        // Route::post('/system/clear-all-cache', [SystemController::class, 'clearAllCache'])->name('system.clear-all-cache');
        // Route::post('/system/clear-app-cache', [SystemController::class, 'clearAppCache'])->name('system.clear-app-cache');
        // Route::post('/system/clear-config-cache', [SystemController::class, 'clearConfigCache'])->name('system.clear-config-cache');
        // Route::post('/system/clear-route-cache', [SystemController::class, 'clearRouteCache'])->name('system.clear-route-cache');
        // Route::post('/system/clear-view-cache', [SystemController::class, 'clearViewCache'])->name('system.clear-view-cache');
        // Route::post('/system/optimize', [SystemController::class, 'optimizeApp'])->name('system.optimize');
        // Route::post('/system/clear-logs', [SystemController::class, 'clearLogs'])->name('system.clear-logs');
        

        // Scan 
        // Route::get('scan', [HomeController::class, 'scanCode'])->name('scan.index');
        // Route::get('scan/result', [HomeController::class, 'scanCodeResult'])->name('scan.result.store');
        Route::get('/booking/scan', [HomeController::class, 'scanCode'])->name('booking.scan');
        Route::get('/booking/scan/result', [HomeController::class, 'scanCodeResult'])->name('scan.result.store');
        // Step 3: Verify QR code (AJAX endpoint)
        Route::post('/booking/verify-qr', [HomeController::class, 'verifyQRCode'])->name('booking.verify-qr');
        
        // Step 4: Show verified booking details
        Route::get('/booking/verified/{id}', [HomeController::class, 'showVerifiedBooking'])->name('booking.verified');
        
        // Amenities
        Route::get('amenities', [ RoomAmenityController::class, 'index'])->name('amenities.index');
        Route::get('amenities/create', [ RoomAmenityController::class, 'create'])->name('amenities.create');
        Route::post('amenities/store', [ RoomAmenityController::class, 'store'])->name('amenities.store');
        Route::get('amenities/edit/{id}', [ RoomAmenityController::class, 'edit'])->name('amenities.edit');
        Route::put('amenities/update/{id}', [ RoomAmenityController::class, 'update'])->name('amenities.update');
        Route::delete('amenities/delete/{id}', [ RoomAmenityController::class, 'destroy'])->name('amenities.destroy');


        // Route::get('booking', [BookingController::class, 'index'])->name('booking.index');
        // Route::delete('booking/delete', [BookingController::class, 'destroy'])->name('booking.destroy');


        // Route::resource('/categories', PostCategoryController::class);
        // Route::resource('/amenitie', RoomAmenitiesController::class);
        // Route::resource('/policy', RoomPolicyController::class);
       

        // update profile and change profile
        // Route::put('/profile/{id}/update', [HomeController::class, 'update'])->name('update.profile');
        // change password
        // Route::post('/change-password/update', [HomeController::class, 'updatePassword'])->name('change.password.update');

    });
    
});
