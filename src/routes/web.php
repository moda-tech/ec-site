<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

// ==============================
// マイページ
// ==============================

//リダイレクト
Route::get('/', function () {
    return redirect()->route('material.index');
});

//ユーザーマイページ
Route::get('/dashboard', [OrderController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('orders.index');

//管理者マイページ
Route::middleware(['auth', 'admin'])
    ->prefix('admin') //URLの頭に /admin を追加
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

// ==============================
// 購入済み商品閲覧
// ==============================

//購入済み商品詳細ページ
Route::get('/dashboard/orders/{order}',[OrderController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('orders.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

require __DIR__.'/auth.php';

// ==============================
// 商品購入
// ==============================

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

// ==============================
// 管理者画面
// ==============================

use App\Http\Controllers\Admin\MaterialController as AdminMaterialController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ダッシュボード
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // ==============================
        //商品管理（materials）
        // ==============================

        // 一覧
        Route::get('/materials', [AdminMaterialController::class, 'index'])
            ->name('materials.index');

        // 新規作成画面
        Route::get('/materials/create', [AdminMaterialController::class, 'create'])
            ->name('materials.create');

        // 新規作成処理
        Route::post('/materials', [AdminMaterialController::class, 'store'])
            ->name('materials.store');

        // 編集画面
        Route::get('/materials/{slug}/edit', [AdminMaterialController::class, 'edit'])
            ->name('materials.edit');

        // 更新処理
        Route::put('/materials/{slug}', [AdminMaterialController::class, 'update'])
            ->name('materials.update');

        // 削除
        Route::delete('/materials/{slug}', [AdminMaterialController::class, 'destroy'])
            ->name('materials.destroy');

        // ==============================
        //注文管理（orders）
        // ==============================

        // 一覧
        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        // 詳細
        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])
            ->name('orders.show');

        // ==============================
        //ユーザー管理（users）
        // ==============================

        // 一覧
        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        // 編集画面
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])
            ->name('users.edit');

        // 更新
        Route::put('/users/{id}', [UserController::class, 'update'])
            ->name('users.update');

        // 削除
        Route::delete('/users/{id}', [UserController::class, 'destroy'])
            ->name('users.destroy');
    });









