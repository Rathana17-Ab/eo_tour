<?php

use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
 use App\Http\Controllers\SearchController;
 use App\Http\Controllers\ProfileController;
 use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC / AUTH ROUTES ---
Route::resource('users', UserController::class);
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('signin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
 Route::resource('users', UserController::class);
 Route::resource('permissions', PermissionController::class);

// --- PROTECTED ROUTES (Requires Login) ---
Route::middleware('auth')->group(function () {

    // Everyone who is logged in can see the Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::resource('permissions', PermissionController::class);
    // --- ADMIN ONLY ROUTES ---
    // Only users with the 'admin' role can access these
    // Route::middleware(['role:admin'])->group(function () {
    //     Route::resource('users', UserController::class);
    //     Route::resource('permissions', PermissionController::class);
    // });

    // --- TOUR MANAGEMENT ---
    // Anyone logged in can view the list
    Route::get('/tours', [TourController::class, 'index'])->name('tour.index');

    // Only users with 'manage tours' permission can Create/Edit
    Route::middleware(['permission:manage tours'])->group(function () {
        Route::get('/tours/create', [TourController::class, 'create'])->name('tour.create');
        Route::post('/tours', [TourController::class, 'store'])->name('tour.store');
        Route::get('/tours/{id}/edit', [TourController::class, 'edit'])->name('tour.edit');
        Route::put('/tours/{id}', [TourController::class, 'update'])->name('tour.update');
    });

    // Only users with 'delete tours' permission can Delete
    Route::middleware(['permission:delete tours'])->group(function () {
        Route::get('/tours/{id}/delete', [TourController::class, 'delete'])->name('tour.delete');
        Route::delete('/tours/{id}', [TourController::class, 'destroy'])->name('tour.destroy');
    });
        Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');

    // --- BOOKING MANAGEMENT ---
    // Only users with 'view bookings' permission can access these
    Route::middleware(['permission:view bookings'])->group(function () {
        // Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');
        Route::get('/bookings/create', [BookingController::class, 'create'])->name('booking.create');
        Route::post('/bookings/store', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
        Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('booking.update');
        Route::get('/bookings/{id}/delete', [BookingController::class, 'delete'])->name('booking.delete');
        Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    });

   

Route::middleware(['auth'])->group(function () {

    // Search
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    // Profile (if using Breeze/Jetstream adjust accordingly)
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

});


Route::middleware(['auth'])->group(function () {
    Route::resource('role', RoleController::class);
    // Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);
});
});
