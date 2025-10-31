<?php

use App\Http\Controllers\Auth\BookingController;
use App\Http\Controllers\Auth\CommentController;
use App\Http\Controllers\Auth\HomeController;
use Illuminate\Support\Facades\Route;




Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::middleware(['user.authenticated'])->group(function () {
        Route::get('/overview', [HomeController::class, 'dashboard'])->name('home');
        Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
        Route::put('/profile/edit/{id}', [HomeController::class, 'editProfile'])->name('edit.profile'); 
        Route::get('/change-password', [HomeController::class, 'changePasswordView'])->name('change.password');
        Route::post('/change-password/post', [HomeController::class, 'changePassword'])->name('change-password-post');  
        Route::put('/profile-picture-change/{id}', [HomeController::class, 'changeProfilePicture'])->name('profile-picture-change');             
        Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
        Route::get('/booking-history', [HomeController::class, 'bookingHistory'])->name('booking.history');
        Route::get('/bookings/export', [HomeController::class, 'exportBookings'])->name('bookings.export');
    });
       
    
    // OTP  Routes
    Route::post('/send/otp', [BookingController::class, 'sendOtp'])->name('booking.send.otp');

    Route::get('/booking/otp', [BookingController::class, 'showOtpForm'])->name('booking.otp.form');
    Route::post('/booking/otp/verify', [BookingController::class, 'verifyOtp'])->name('booking.otp.verify');
    Route::get('booking/otp/resend', [BookingController::class, 'resendOtp'])->name('booking.otp.resend');
    Route::get('/booking/otp-form', [BookingController::class, 'showOtpForm'])->name('booking.otp.form');


    // Booking routes
    Route::post('booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('booking/card-payment', [BookingController::class, 'showCardPaymentForm'])->name('booking.card.payment');
    Route::post('/booking/card-payment', [BookingController::class, 'processCardPayment'])->name('booking.card-payment');
    Route::get('/booking/success', [BookingController::class, 'showBookingSuccess'])->name('booking.success');
    Route::get('/booking/payment', [BookingController::class, 'showPaymentForm'])->name('booking.payment.form');
    Route::post('/booking/payment', [BookingController::class, 'processPayment'])->name('booking.payment.process');

    // Payment callback routes
    Route::post('/payment/callback', [BookingController::class, 'handlePaymentCallback'])->name('payment.callback');
    Route::get('/payment/return', [BookingController::class, 'handlePaymentReturn'])->name('payment.return');

});
