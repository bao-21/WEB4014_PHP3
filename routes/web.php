<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoriController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RiviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
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

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/',                 [CategoriController::class, 'index'])->name('index');
        Route::get('/{id}/show',        [CategoriController::class, 'show'])->name('show');
        Route::get('/create',           [CategoriController::class, 'create'])->name('create');
        Route::post('/store',           [CategoriController::class, 'store'])->name('store');
        Route::get('/{id}/edit',        [CategoriController::class, 'edit'])->name('edit');
        Route::put('/{id}',             [CategoriController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy',  [CategoriController::class, 'destroy'])->name('destroy');

         // Routes cho thùng rác
         Route::get('/trash', [CategoriController::class, 'trash'])->name('trash');
         Route::post('/restore/{id}', [CategoriController::class, 'restore'])->name('restore');
         Route::delete('/force-delete/{id}', [CategoriController::class, 'forceDelete'])->name('forceDelete');
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

    Route::prefix('customsers')->name('customsers.')->group(function(){
        Route::get('/', [CustomserController::class, 'index'])->name('index');
        Route::get('/{id}/show', [CustomserController::class, 'show'])->name('show');
        Route::get('/create', [CustomserController::class, 'create'])->name('create');
        Route::post('/store', [CustomserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CustomserController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [CustomserController::class, 'update'])->name('update');
        Route::delete('/{id}', [CustomserController::class, 'destroy'])->name('destroy');

        // Routes cho thùng rác
        Route::get('/trash', [CustomserController::class, 'trash'])->name('trash');
        Route::post('/restore/{id}', [CustomserController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [CustomserController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('banners')->name('banners.')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('index');
        Route::get('/create', [BannerController::class, 'create'])->name('create');
        Route::post('/store', [BannerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BannerController::class, 'update'])->name('update');
        Route::delete('/{id}', [BannerController::class, 'destroy'])->name('destroy');
        
        // Thùng rác
        Route::get('/trash', [BannerController::class, 'trash'])->name('trash');
        Route::post('/restore/{id}', [BannerController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [BannerController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('posts')->name('posts.')->group(function(){
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/{id}/show', [PostController::class, 'show'])->name('show');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [PostController::class, 'update'])->name('update');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');

        // Routes cho thùng rác
        Route::get('/trash', [PostController::class, 'trash'])->name('trash');
        Route::post('/restore/{id}', [PostController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [PostController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('riviews')->name('riviews.')->group(function(){
        Route::get('/', [RiviewController::class, 'index'])->name('index');
        Route::get('/{id}/show', [RiviewController::class, 'show'])->name('show');
        Route::get('/create', [RiviewController::class, 'create'])->name('create');
        Route::post('/store', [RiviewController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RiviewController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RiviewController::class, 'update'])->name('update');
        Route::delete('/{id}', [RiviewController::class, 'destroy'])->name('destroy');

        // Routes cho thùng rác
        Route::get('/trash', [RiviewController::class, 'trash'])->name('trash');
        Route::post('/restore/{id}', [RiviewController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [RiviewController::class, 'forceDelete'])->name('forceDelete');
    });
});

