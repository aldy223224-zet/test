<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// Home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication routes
Auth::routes();

// Middleware for authenticated users
Route::middleware(['auth'])->group(function () {
    // Admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // User dashboard
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    
    // Default route for other authenticated users
    Route::get('/home', function () {
        $user = Auth::user();
        if ($user && $user->user_type === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user && $user->user_type === 'user') {
            return redirect()->route('user.dashboard');
        }

        return redirect('/'); // Redirect to home or another default route
    })->name('home');
});
