<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
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

Route::get('/', [ClientController::class, 'index'])->name('beranda');
Route::get('/product', [ClientController::class, 'product'])->name('product');
Route::get('/client-voucher', [ClientController::class, 'client_voucher'])->name('client_voucher');
Route::get('/hubungi ', [ClientController::class, 'hubungi'])->name('hubungi');
Route::get('/product/{id}', [ClientController::class, 'detail_product'])->name('detail-product');


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
            'products' => ProductController::class,
            'metode' => MetodePembayaranController::class,
            'voucher' => VoucherController::class,
            'transaksis' => TransaksiController::class,
            'ulasan' => UlasanController::class,
        ]);
    });

    // route untuk user
    Route::middleware(['can:user'])->group(function () {
        Route::get('/client-profile', [ClientController::class, 'profile_client'])->name('client_profile');
        Route::post('/tukar-voucher', [ClientController::class, 'tukar_voucher'])->name('tukar_voucher');
        Route::get('/pembayaran/{id}', [ClientController::class, 'pembayaran'])->name('pembayaran');
        Route::post('/transaksi', [ClientController::class, 'transaksi'])->name('transaksi');
    });
});
