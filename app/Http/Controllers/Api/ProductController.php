<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        
        $query = Product::with('category');
         // Tìm kiếm theo mã sản phẩm 
         if ($request->filled('ma_san_pham')) {
            $query->where('ma_san_pham', 'LIKE', '%' . $request->ma_san_pham . '%');
        }

        $query->orderBy('id', 'desc'); // sắp xếp

        $products = $query->paginate(10);


        // return response()->json($products);

        // Hiển thị thông qua resource.
        // Conllection chỉ hiện thị danh sách nhiều bản ghi
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Product::with('category')->findOrFail($id);

        return response()->json([
            'message' => ' Lấy thông tin chi tiết sản phẩm thành công',
            'data'=> new ProductResource($product),
            'status' =>200,
            'author' => 'baoph56558'
        ]);

        // return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
