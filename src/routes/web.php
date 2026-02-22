<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

//マイページ
Route::get('/dashboard', [OrderController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('orders.index');

//購入済み商品詳細ページ
Route::get('/dashboard/orders/{order}',[OrderController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('orders.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

require __DIR__.'/auth.php';

//商品一覧画面(メインページ)
Route::get('/products', [MaterialController::class, 'index'])->name('material.index');
//商品詳細ページ
Route::get('/products/{slug}', [MaterialController::class, 'show'])->name('material.show');

// 購入確認（ログイン必須）
Route::middleware('auth')->group(function () {

    // 確認画面
    Route::get(
        '/products/{slug}/checkout',
        [CheckoutController::class, 'show']
    )->name('checkout.show');

    // 購入確定（POST）
    Route::post(
        '/products/{slug}/checkout',
        [CheckoutController::class, 'confirm']
    )->name('checkout.confirm');

    // 完了画面
    Route::get(
        '/checkout/result',
        [CheckoutController::class, 'result']
    )->name('checkout.result');
});









