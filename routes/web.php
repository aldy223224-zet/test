<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Dashboard\DashboardHome;

// Home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication routes
//Auth::routes();

// DASHBOARD AUTH
Route::get('/dashboard/login', [UserAuthController::class, 'index'])->name('login');
Route::post('/dashboard/login', [UserAuthController::class, 'login']);
Route::get('/dashboard/logout', [UserAuthController::class, 'logout']);

// DASHBOARD PAGE
Route::group(['prefix'=> 'dashboard','middleware'=>['auth:user']], function(){
    Route::get('/', [DashboardHome::class, 'index']);
    Route::get('/home', [DashboardHome::class, 'index']);
    
    //Route::post('/probinmaba', [DashProbinmaba::class, 'postHandler']);
});

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
    });
});
