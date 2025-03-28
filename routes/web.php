<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/',                 [ProductController::class, 'index'])->name('index');
        Route::get('/{id}/show',        [ProductController::class, 'show'])->name('show');
        Route::get('/create',           [ProductController::class, 'create'])->name('create');
        Route::post('/store',           [ProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit',        [ProductController::class, 'edit'])->name('edit');
        Route::put('/{id}',             [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy',  [ProductController::class, 'destroy'])->name('destroy');

         // Routes cho thùng rác
         Route::get('/trash', [ProductController::class, 'trash'])->name('trash');
         Route::post('/restore/{id}', [ProductController::class, 'restore'])->name('restore');
         Route::delete('/force-delete/{id}', [ProductController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('contacts')->name('contacts.')->group(function(){
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/{id}/show', [ContactController::class, 'show'])->name('show');
        Route::get('/create', [ContactController::class, 'create'])->name('create');
        Route::post('/store', [ContactController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ContactController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [ContactController::class, 'update'])->name('update');
        Route::delete('/{id}', [ContactController::class, 'destroy'])->name('destroy');

        // Routes cho thùng rác
        Route::get('/trash', [ContactController::class, 'trash'])->name('trash');
        Route::post('/restore/{id}', [ContactController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [ContactController::class, 'forceDelete'])->name('forceDelete');
    });
});
