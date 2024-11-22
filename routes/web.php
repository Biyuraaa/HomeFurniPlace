<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;


Route::controller(PageController::class)->group(function () {
    Route::get('/', 'index')->name('welcome');
    Route::get('/products', 'products')->name('products');
    Route::get('/products/{id}', 'product')->name('product');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
    Route::post('/products/{id}/carts', [CartController::class, 'store'])->name('carts.store');
    Route::delete('/carts/{id}', [CartController::class, 'destroy'])->name('carts.destroy');
    Route::post('/carts/{id}', [CartController::class, 'update'])->name('carts.update');
    Route::post('/carts/checkout', [CartController::class, 'checkout'])->name('carts.checkout');
    Route::get('/wallets', [WalletController::class, 'index'])->name('wallets-users.index');
    Route::get('/wallets/create', [WalletController::class, 'create'])->name('wallets-users.create');
    Route::post('/wallets', [WalletController::class, 'store'])->name('wallets-users.store');
    Route::post('/wallets/deposit', [WalletController::class, 'storeDeposit'])->name('wallets-users.storeDeposit');
    Route::resource('sales', SaleController::class)->only('store');
    Route::patch('/sales/cancel/{sale}', [SaleController::class, 'cancel'])->name('sales.cancel');
    Route::get('/purchase-history', [SaleController::class, 'showPurchased'])->name('sales.purchased');
    Route::get('/purchase-history/{id}', [SaleController::class, 'viewDetail'])->name('sales.view');
    Route::patch('/purchase-history/{id}/confirm', [SaleController::class, 'confirmDelivery'])->name('sales.confirmDelivery');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile-user.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile-user.edit');
    Route::patch('/profile/edit/{id}', [ProfileController::class, 'update'])->name('profile-user.update');
});


Route::prefix('dashboard')->middleware(['auth', 'check-admin', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('sellers', SellerController::class);
    Route::resource('customers', CustomerController::class);
    Route::patch('sales/{id}/confirm', [SaleController::class, 'confirm'])->name('sales.confirm');
    Route::resource('sales', SaleController::class)->except('store');
    Route::post('wallets/deposit', [WalletController::class, 'storeDeposit'])->name('wallets.storeDeposit');
    Route::resource('wallets', WalletController::class);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';
