<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

// Mặc định apiResource sẻ trỏ tới 5 phương thức mặc định trong controllerapi
// Nếu muốn tạo thêm phương thức mới trong contronller api
// thì ta cần tạo thêm đường dẫn riêng để trỏ đến phương thức
// và route đó phải được bên trên apiResource
// Route::get('product')
Route::apiResource('products', ProductController::class);