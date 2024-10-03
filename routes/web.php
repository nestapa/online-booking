<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.auth.login');
})->middleware(['guest']);

// matikan route ini jika .env email sudah di seting
Route::get('/forgot-password', function () {
    return redirect()->back();
})->name('password.request')->middleware(['guest']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/change-profile-avatar', [DashboardController::class, 'changeAvatar'])->name('change-profile-avatar');
    Route::delete('/remove-profile-avatar', [DashboardController::class, 'removeAvatar'])->name('remove-profile-avatar');

    // route untuk superadmin jika diperlukan
    // Route::middleware(['can:superadmin'])->group(function () {
    //     Route::resources([
    //         'user' => UserController::class,
    //     ]);
    // });

    // route untuk admin
    Route::middleware(['can:admin'])->group(function () {
        Route::resources([
            'user' => UserController::class,
        ]);
    });

    // route untuk user
    Route::middleware(['can:user'])->group(function () {
        //
    });
});
