<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminHome;
use App\Http\Controllers\Admin\DashboardAdmin;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Dashboard\DashboardHome;
use App\Http\Controllers\Dashboard\DashboardProduction;

// Home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication routes
//Auth::routes();

// DASHBOARD AUTH
Route::get('/login', [UserAuthController::class, 'index'])->name('login');
Route::post('/login', [UserAuthController::class, 'login']);
Route::get('/logout', [UserAuthController::class, 'logout']);

// DASHBOARD PAGE
Route::group(['prefix'=> 'dashboard','middleware'=>['auth:user']], function(){
    Route::get('/', [DashboardHome::class, 'index']);
    Route::get('/home', [DashboardHome::class, 'index']);
    Route::get('/hasil-produksi', [DashboardProduction::class, 'index']);
    
    Route::post('/hasil-produksi', [DashboardProduction::class, 'postHandler'])->name('production.store');
    Route::put('/production/update/{id}', [DashboardProduction::class, 'update'])->name('production.update');

});


// ADMIN AUTH
Route::get('/admin/login', [AdminAuthController::class, 'index']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::get('/admin/logout', [AdminAuthController::class, 'logout']);

// DASHBOARD PAGE
Route::group(['prefix'=> 'admin','middleware'=>['auth:admin']], function(){
    Route::get('/', [AdminHome::class, 'index']);
    Route::get('/home', [AdminHome::class, 'index']);
    
    //Route::post('/probinmaba', [DashProbinmaba::class, 'postHandler']);
});

// Admin Dashboard Routes
Route::group(['prefix'=> 'admin','middleware'=>['auth:admin']], function(){
    Route::get('/', [AdminHome::class, 'index']);
    Route::get('/home', [AdminHome::class, 'index']);
    Route::get('/hasil-admin', [DashboardAdmin::class, 'index'])->name('admin.production.index');
    Route::put('/admin/production/verify/{id}', [DashboardAdmin::class, 'verify'])->name('production.verify');
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

// API
Route::group(['prefix'=> 'api'], function(){
    Route::get('production/{production:id}', [APIController::class, 'Production']);
    Route::get('user/{user:id}', [APIController::class, 'User']);
});
