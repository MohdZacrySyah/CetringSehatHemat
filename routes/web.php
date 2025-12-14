<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Menu; // Tambahkan ini untuk akses DB di closure
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderArchiveController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OrderController;

// Rating/Review
Route::get('/rating', [ReviewController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('rating');



Route::middleware(['auth', 'verified'])->group(function () {
     Route::get('/order/struktur', [OrderController::class, 'struktur'])->name('order.struktur');
    Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::get('/order/{order}/payment-method', [OrderController::class, 'paymentMethod'])->name('order.payment.method');
    Route::post('/order/{order}/select-payment', [OrderController::class, 'selectPaymentMethod'])->name('order.payment.select');
    Route::get('/order/{order}/payment', [OrderController::class, 'showPayment'])->name('order.payment.show');
    Route::post('/order/{order}/confirm-payment', [OrderController::class, 'confirmPayment'])->name('order.payment.confirm');
    Route::get('/order/{order}/success', [OrderController::class, 'success'])->name('order.success');

    // Profil (view)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    
    // Edit profil (form)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Update profil
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});



// Arsip pesanan (list pesanan cancel)
Route::get('/arsip-pesanan', [OrderArchiveController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('arsip.index');

// Detail pembatalan
Route::get('/arsip-pesanan/{id}/rincian', [OrderArchiveController::class, 'detail'])
    ->middleware(['auth', 'verified'])
    ->name('arsip.detail');

// Beli lagi
Route::get('/arsip-pesanan/{id}/beli-lagi', [OrderArchiveController::class, 'buyAgain'])
    ->middleware(['auth', 'verified'])
    ->name('arsip.buy-again');

// Hapus arsip
Route::delete('/arsip-pesanan/{id}', [OrderArchiveController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('arsip.destroy');

// Hapus semua arsip
Route::delete('/arsip-pesanan', [OrderArchiveController::class, 'clearAll'])
    ->middleware(['auth', 'verified'])
    ->name('arsip.clear-all');



// List notifikasi
Route::get('/notifikasi', [NotificationController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('notifikasi');

// Detail notifikasi
Route::get('/notifikasi/{id}', [NotificationController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('notifikasi.detail');

// Tandai semua sebagai dibaca
Route::post('/notifikasi/mark-all-read', [NotificationController::class, 'markAllRead'])
    ->middleware(['auth', 'verified'])
    ->name('notifikasi.mark-all-read');

// Hapus notifikasi
Route::delete('/notifikasi/{id}', [NotificationController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('notifikasi.destroy');



// Halaman keranjang
Route::get('/keranjang', [CartController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('cart');

// Tambah ke keranjang
Route::post('/keranjang/tambah', [CartController::class, 'add'])
    ->middleware(['auth', 'verified'])
    ->name('cart.add');

// Update keranjang
Route::put('/keranjang/{id}', [CartController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('cart.update');

// Hapus item dari keranjang
Route::delete('/keranjang/{id}', [CartController::class, 'remove'])
    ->middleware(['auth', 'verified'])
    ->name('cart.remove');

// Kosongkan keranjang
Route::delete('/keranjang/clear', [CartController::class, 'clear'])
    ->middleware(['auth', 'verified'])
    ->name('cart.clear');

// Arsip pesanan (list pesanan cancel)
Route::get('/arsip-pesanan', [OrderArchiveController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('arsip.index');

// Detail pembatalan
Route::get('/arsip-pesanan/{id}/rincian', [OrderArchiveController::class, 'detail'])
    ->middleware(['auth', 'verified'])
    ->name('arsip.detail');

// Beli lagi
Route::get('/arsip-pesanan/{id}/beli-lagi', [OrderArchiveController::class, 'buyAgain'])
    ->middleware(['auth', 'verified'])
    ->name('arsip.buy-again');



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Rute untuk Splash Screen (/)
Route::get('/', function () {
    return view('welcome');
});

// 2. Rute untuk Halaman Menu (/menu)
Route::get('/menu', function () {
    return view('menu');
});

// 3. Rute Dashboard - DARI DATABASE!
// Route::get('/dashboard', function () {
    // $menus = Menu::all(); // <-- Ambil data menu dari database
    // return view('home', compact('menus'));
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 4. Rute untuk Halaman Keranjang
Route::get('/keranjang', [CartController::class, 'show'])
     ->middleware(['auth', 'verified'])
     ->name('cart');

// 5. Rute untuk MENAMBAH ke Keranjang
Route::post('/keranjang/tambah', [CartController::class, 'add'])
     ->middleware(['auth', 'verified'])
     ->name('cart.add');
     
Route::get('/notifikasi', function () {
    return view('notifikasi');
})->name('notifikasi');

// Halaman notifikasi (list)
Route::get('/notifikasi', [NotificationController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('notifikasi');

// Detail pesanan dari notifikasi
Route::get('/notifikasi/{id}', [NotificationController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('notifikasi.detail');

     
     Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
})->middleware(['auth', 'verified'])->name('tentang');
// 6. Rute-rute otentikasi (login, register, logout, dll.)
require __DIR__.'/auth.php';
