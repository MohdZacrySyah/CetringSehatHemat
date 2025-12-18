<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderArchiveController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController; // Pastikan AdminController diimport

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Rute untuk Splash Screen (/)
Route::get('/', function () {
    return view('welcome');
});

// 2. Rute untuk Halaman Menu (/menu) - Bisa diakses publik
Route::get('/menu', function () {
    return view('menu');
});

// 3. Rute Dashboard Customer
Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 4. Tentang Kami
Route::get('/tentang-kami', function () {
    return view('tentang-kami');
})->middleware(['auth', 'verified'])->name('tentang');

/*
|--------------------------------------------------------------------------
| Cart Routes (Keranjang)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/keranjang', [CartController::class, 'show'])->name('cart');
    Route::post('/keranjang/tambah', [CartController::class, 'add'])->name('cart.add');
    Route::put('/keranjang/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/keranjang/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/keranjang/clear', [CartController::class, 'clear'])->name('cart.clear');
});

/*
|--------------------------------------------------------------------------
| Order Routes (Pemesanan)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Checkout Process
    Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    
    // Payment Method Selection
    Route::get('/order/payment-method', [OrderController::class, 'paymentMethod'])->name('order.payment.method');
    Route::post('/order/select-payment', [OrderController::class, 'selectPaymentMethod'])->name('order.payment.select');
    
    // Payment Details & Confirmation
    Route::get('/order/{order}/detail-payment', [OrderController::class, 'paymentDetail'])->name('order.payment.detail');
    Route::get('/order/{order}/qr-code', [OrderController::class, 'showQRCode'])->name('order.payment.qr');
    Route::get('/order/{order}/payment', [OrderController::class, 'showPayment'])->name('order.payment.show');
    Route::post('/order/{order}/confirm-payment', [OrderController::class, 'confirmPayment'])->name('order.payment.confirm');
    
    // Order Status Pages
    Route::get('/order/{order}/loading', [OrderController::class, 'loading'])->name('order.loading');
    Route::get('/order/{order}/success', [OrderController::class, 'success'])->name('order.success');
    Route::get('/order/{order}/detail', [OrderController::class, 'detail'])->name('order.detail');
    
    // Cetak Struk (Opsional)
    Route::get('/order/struktur', [OrderController::class, 'struktur'])->name('order.struktur');
});

/*
|--------------------------------------------------------------------------
| Review/Rating Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/ratings', [ReviewController::class, 'index'])->name('ratings.index');
    Route::get('/order/{order}/review', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/order/{order}/review', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/review/success', [ReviewController::class, 'success'])->name('review.success');
});

/*
|--------------------------------------------------------------------------
| Notification Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifikasi');
    Route::get('/notifikasi/{id}', [NotificationController::class, 'show'])->name('notifikasi.detail');
    Route::post('/notifikasi/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifikasi.mark-all-read');
    Route::delete('/notifikasi/{id}', [NotificationController::class, 'destroy'])->name('notifikasi.destroy');
});

/*
|--------------------------------------------------------------------------
| Order Archive Routes (Riwayat Pesanan)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/arsip-pesanan', [OrderArchiveController::class, 'index'])->name('arsip.index');
    Route::get('/arsip-pesanan/{id}/rincian', [OrderArchiveController::class, 'detail'])->name('arsip.detail');
    Route::get('/arsip-pesanan/{id}/beli-lagi', [OrderArchiveController::class, 'buyAgain'])->name('arsip.buy-again');
    Route::delete('/arsip-pesanan/{id}', [OrderArchiveController::class, 'destroy'])->name('arsip.destroy');
    Route::delete('/arsip-pesanan', [OrderArchiveController::class, 'clearAll'])->name('arsip.clear-all');
});

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // Route bawaan Breeze untuk profile (biasanya destroy/update password ada di sini juga)
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update.breeze'); // Jika pakai Breeze default
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Role: Admin Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Manajemen Pesanan
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::patch('/orders/{id}/update', [AdminController::class, 'updateOrderStatus'])->name('orders.update');

    // Manajemen Menu (CRUD Lengkap)
    Route::get('/menus', [AdminController::class, 'menus'])->name('menus');
    Route::get('/menus/create', [AdminController::class, 'createMenu'])->name('menus.create');
    Route::post('/menus', [AdminController::class, 'storeMenu'])->name('menus.store');
    
    // Route Edit & Update (PENTING: Ini yang ditambahkan agar tombol edit berfungsi)
    Route::get('/menus/{id}/edit', [AdminController::class, 'editMenu'])->name('menus.edit');
    Route::put('/menus/{id}', [AdminController::class, 'updateMenu'])->name('menus.update');
    
    Route::delete('/menus/{id}', [AdminController::class, 'destroyMenu'])->name('menus.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';