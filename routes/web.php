<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ContactManagementController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CatalogController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\OrderHistoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [CatalogController::class, 'landing'])->name('home');
Route::get('/katalog', [CatalogController::class, 'index'])->name('user.catalog');
Route::get('/katalog/{book}', [CatalogController::class, 'show'])->name('user.book.show');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('user.about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/kontak', [ContactController::class, 'index'])->name('user.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/kontak', [ContactController::class, 'store'])->name('user.contact.store');

/*
|--------------------------------------------------------------------------
| Auth Routes (Guest Only)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (Admin Role Only)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Categories CRUD
        Route::resource('categories', AdminCategoryController::class)->except(['show']);

        // Books CRUD
        Route::resource('books', AdminBookController::class);

        // User Management
        Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UserManagementController::class, 'show'])->name('users.show');

        // Order Management
        Route::get('/orders', [OrderManagementController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderManagementController::class, 'show'])->name('orders.show');
        Route::match(['put', 'patch'], '/orders/{order}/status', [OrderManagementController::class, 'updateStatus'])->name('orders.update-status');

        // Contact / Messages Management
        Route::get('/contacts', [ContactManagementController::class, 'index'])->name('contacts.index');
        Route::get('/messages', [ContactManagementController::class, 'index'])->name('messages.index');
        Route::get('/contacts/{contact}', [ContactManagementController::class, 'show'])->name('contacts.show');
        Route::delete('/contacts/{contact}', [ContactManagementController::class, 'destroy'])->name('contacts.destroy');
    });

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (User Role Only)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'user'])->group(function () {
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/keranjang', [CartController::class, 'index'])->name('user.cart');
    Route::post('/cart/{book}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/keranjang/{book}', [CartController::class, 'add'])->name('user.cart.add');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::patch('/keranjang/{cart}', [CartController::class, 'update'])->name('user.cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/keranjang/{cart}', [CartController::class, 'destroy'])->name('user.cart.destroy');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/proses-checkout', [CheckoutController::class, 'index'])->name('user.checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/proses-checkout', [CheckoutController::class, 'process'])->name('user.checkout.process');

    // Order History
    Route::get('/orders', [OrderHistoryController::class, 'index'])->name('orders.history');
    Route::get('/riwayat-pesanan', [OrderHistoryController::class, 'index'])->name('user.orders');
    Route::get('/orders/{order}', [OrderHistoryController::class, 'show'])->name('orders.show');
    Route::get('/riwayat-pesanan/{order}', [OrderHistoryController::class, 'show'])->name('user.order.show');
});
