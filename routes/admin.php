<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\RoomAmenityController;
use App\Http\Controllers\Admin\RoomListingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\BladeEditorController;
use App\Http\Controllers\Admin\AdminController;

Route::prefix('admin')->name('admin.')->group(function (){ 

    Route::middleware('admin.logged_out')->group(function () {
        Route::controller(LoginController::class)->group(function (){
            Route::get('login','showLoginForm')->name('login.form');
            Route::post('login-post', 'login')->name('login');
        });
    });
    
    // Logout route should be accessible when logged in
    Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('admin.logged_in');

    Route::middleware('admin.logged_in')->group(function () { 
        Route::get('/dashboard', [ HomeController::class,'index' ])->name('home');
        Route::get('/setting', [ HomeController::class,'settings' ])->name('settings.index');
        
        // Debug route to check role
        Route::get('/check-role', function() {
            return view('admin.check-role');
        })->name('check-role');

        // ========================================
        // ROOM LISTING ROUTES
        // ========================================
        
        // Super Admin: Full access (view, create, edit, delete)
        Route::middleware(['role:super-admin'])->group(function () {
            Route::get('/room/listing', [RoomListingController::class,'index'])->name('roomListing.index');
            Route::get('/room/listing/create', [RoomListingController::class,'create'])->name('roomListing.create');
            Route::post('/room/listing', [RoomListingController::class,'store'])->name('roomListing.store');
            Route::get('/room/listing/{id}/edit', [RoomListingController::class,'edit'])->name('roomListing.edit');
            Route::put('/room/listing/{id}/update', [RoomListingController::class,'update'])->name('roomListing.update');
            Route::delete('/room/listing/{id}/delete', [RoomListingController::class,'destroy'])->name('roomListing.destroy');
        });

        // Supervisor: View rooms only (read-only access)
        Route::middleware(['role:supervisor'])->group(function () {
            Route::get('/room/listing/view', [RoomListingController::class,'index'])->name('roomListing.view');
            Route::get('/room/listing', [RoomListingController::class,'index'])->name('roomListing.index');
            Route::get('/room/listing/{id}/edit', [RoomListingController::class,'edit'])->name('roomListing.edit');
            Route::put('/room/listing/{id}/update', [RoomListingController::class,'update'])->name('roomListing.update');
        });

        // ========================================
        // BOOKING ROUTES
        // ========================================
        
        // All roles can view bookings
        Route::middleware(['role:super-admin,supervisor,front-desk'])->group(function () {
            Route::get('/booking/list', [BookingController::class,'index'])->name('booking.index');
            Route::get('/booking/{id}/show', [BookingController::class, 'show'])->name('booking.show');
            Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
            Route::put('/booking/{id}/update', [BookingController::class, 'update'])->name('booking.update');
        });

        // Supervisor and Super Admin: Approve/Reject booking edit requests
        Route::middleware(['role:super-admin,supervisor'])->group(function () {
            Route::get('/booking/pending-edits', [BookingController::class, 'pendingEditRequests'])->name('booking.pending-edits');
            Route::get('/booking/acknowledged-requests', [BookingController::class, 'acknowledgedRequests'])->name('booking.acknowledged-requests');
            Route::put('/booking/edit-request/{id}/approve', [BookingController::class, 'approveEditRequest'])->name('booking.edit-request.approve');
            Route::put('/booking/edit-request/{id}/reject', [BookingController::class, 'rejectEditRequest'])->name('booking.edit-request.reject');
            
            // Family and Friends Management
            Route::get('/family-friends', [\App\Http\Controllers\Admin\FamilyAndFriendController::class, 'index'])->name('family-friends.index');
            Route::get('/family-friends/create', [\App\Http\Controllers\Admin\FamilyAndFriendController::class, 'create'])->name('family-friends.create');
            Route::post('/family-friends', [\App\Http\Controllers\Admin\FamilyAndFriendController::class, 'store'])->name('family-friends.store');
            Route::get('/family-friends/{id}/edit', [\App\Http\Controllers\Admin\FamilyAndFriendController::class, 'edit'])->name('family-friends.edit');
            Route::put('/family-friends/{id}', [\App\Http\Controllers\Admin\FamilyAndFriendController::class, 'update'])->name('family-friends.update');
            Route::delete('/family-friends/{id}', [\App\Http\Controllers\Admin\FamilyAndFriendController::class, 'destroy'])->name('family-friends.destroy');
        });

        // Super Admin only routes
        Route::middleware(['role:super-admin'])->group(function () {
            Route::post('/family-friends/generate-codes', [\App\Http\Controllers\Admin\FamilyAndFriendController::class, 'generateCodesForExistingUsers'])->name('family-friends.generate-codes');
            
            // Role Management
            Route::get('/roles', [\App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles.index');
            Route::get('/roles/create', [\App\Http\Controllers\Admin\RoleController::class, 'create'])->name('roles.create');
            Route::post('/roles', [\App\Http\Controllers\Admin\RoleController::class, 'store'])->name('roles.store');
            Route::get('/roles/{id}', [\App\Http\Controllers\Admin\RoleController::class, 'show'])->name('roles.show');
            Route::get('/roles/{id}/edit', [\App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('roles.edit');
            Route::put('/roles/{id}', [\App\Http\Controllers\Admin\RoleController::class, 'update'])->name('roles.update');
            Route::delete('/roles/{id}', [\App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('roles.destroy');
        });

        // Only Super Admin can delete bookings
        Route::middleware(['role:super-admin'])->group(function () {
            Route::delete('/booking/{id}/delete', [BookingController::class,'destroy'])->name('booking.delete');
        });

        // Super Admin can create bookings directly with amount/discount edits
        Route::middleware(['role:super-admin'])->group(function () {
            Route::post('/bookings', [AdminBookingController::class, 'store'])->name('bookings.store');
        });

        Route::middleware(['role:super-admin,front-desk'])->group(function () {
            Route::get('/bookings/create', [AdminBookingController::class, 'create'])->name('bookings.create');
        });

        // ========================================
        // BLADE EDITOR ROUTES - Super Admin only
        // ========================================
        Route::middleware(['role:super-admin'])->group(function () {
            Route::get('/blade-editor', [BladeEditorController::class, 'index'])->name('blade.editor.index');
            Route::get('/blade-editor/show', [BladeEditorController::class, 'show'])->name('blade.editor.show');
            Route::post('/blade-editor/update', [BladeEditorController::class, 'update'])->name('blade.editor.update');
        });

        // ========================================
        // CUSTOMER ROUTES
        // ========================================
        
        // All roles can view customer lists (registered and guests)
        Route::middleware(['role:super-admin,supervisor,front-desk'])->group(function () {
            Route::get('/customer', [CustomerController::class,'index'])->name('customer.index');
            Route::get('/customer/guests', [CustomerController::class,'guests'])->name('customer.guests');
        });
        
        // Only Super Admin can export, edit, and delete customers
        Route::middleware(['role:super-admin'])->group(function () {
            Route::get('/customer/export', [CustomerController::class, 'export'])->name('customer.export');
            Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
            Route::put('/customer/{id}/update', [CustomerController::class, 'update'])->name('customer.update');
            Route::delete('/customer/{id}/delete', [CustomerController::class, 'destroy'])->name('customer.destroy');
        });

        // ========================================
        // QR CODE SCANNING - All roles can validate bookings
        // ========================================
        Route::middleware(['role:super-admin,supervisor,front-desk'])->group(function () {
            Route::get('/booking/scan', [HomeController::class, 'scanCode'])->name('booking.scan');
            Route::get('/booking/scan/result', [HomeController::class, 'scanCodeResult'])->name('scan.result.store');
            Route::post('/booking/verify-qr', [HomeController::class, 'verifyQRCode'])->name('booking.verify-qr');
            Route::get('/booking/verified/{id}', [HomeController::class, 'showVerifiedBooking'])->name('booking.verified');
        });
        
        // ========================================
        // AMENITIES - Super Admin only
        // ========================================
        Route::middleware(['role:super-admin'])->group(function () {
            Route::get('amenities', [ RoomAmenityController::class, 'index'])->name('amenities.index');
            Route::get('amenities/create', [ RoomAmenityController::class, 'create'])->name('amenities.create');
            Route::post('amenities/store', [ RoomAmenityController::class, 'store'])->name('amenities.store');
            Route::get('amenities/edit/{id}', [ RoomAmenityController::class, 'edit'])->name('amenities.edit');
            Route::put('amenities/update/{id}', [ RoomAmenityController::class, 'update'])->name('amenities.update');
            Route::delete('amenities/delete/{id}', [ RoomAmenityController::class, 'destroy'])->name('amenities.destroy');
        });

        // ========================================
        // ADMIN PROFILE AND PASSWORD - All roles
        // ========================================
        Route::get('/profile/edit', [AdminController::class, 'showProfileForm'])->name('profile.edit');
        Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::get('/password/change', [AdminController::class, 'showChangePasswordForm'])->name('password.form');
        Route::post('/password/change', [AdminController::class, 'changePassword'])->name('password.change');
        
        // Routes for Front Desk to see their rejected requests
        Route::middleware(['role:front-desk'])->group(function () {
            Route::get('/booking/my-rejected-requests', [BookingController::class, 'myRejectedRequests'])->name('booking.my-rejected-requests');
            Route::put('/booking/edit-request/{id}/acknowledge', [BookingController::class, 'acknowledgeEditRequest'])->name('booking.edit-request.acknowledge');
        });
    });
});
