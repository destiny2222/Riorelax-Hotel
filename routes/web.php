<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\BookingController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/check-availability', [PageController::class, 'checkAvailability'])->name('check-availability');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/rooms', [PageController::class, 'rooms'])->name('rooms');
Route::get('/room/{roomListing}', [PageController::class, 'roomDetails'])->name('room.show');
// Route::get('/service', [PageController::class, 'service'])->name('service');
// Route::get('/team', [PageController::class, 'team'])->name('team');
// Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');
// Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 

Route::post('booking', [PageController::class, 'bookingStore'])->name('booking');
Route::post('contact/store', [PageController::class, 'contactStore'])->name('contact.store');


Route::get('logout', [AuthController::class, 'logout'])->name('logout');
// require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
