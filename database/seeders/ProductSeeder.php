<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('products')->insert([
        //     [
        //         'ma_san_pham' => 'SP001',
        //         'ten_san_pham' => 'áo khoác gió',
        //         'category_id' => 1,
        //         'gia'           => 100000,
        //         'gia_khuyen_mai' => 90000,
        //         'so_luong'      => 50,
        //         'ngay_nhap' => '2025-03-15',
        //         'mo_ta'     => 'Mô tả áo', 
        //         'trang_thai' => true,
        //         'created_at' => now()
        //     ],
        //     [
        //         'ma_san_pham' => 'SP002',
        //         'ten_san_pham' => 'quần bông',
        //         'category_id' => 2,
        //         'gia'           => 100000,
        //         'gia_khuyen_mai' => 90000,
        //         'so_luong'      => 50,
        //         'ngay_nhap' => '2025-03-15',
        //         'mo_ta'     => 'Mô tả quần', 
        //         'trang_thai' => true,
        //         'created_at' => now()
        //     ],
        // ]);
        Category::factory()->count(5)->create()->each(function ($category){
        Product::factory()->count(10)->create(['category_id' => $category->id]);
        });
    }
}
