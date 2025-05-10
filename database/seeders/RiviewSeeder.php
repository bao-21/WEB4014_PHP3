<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RiviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('reviews')->insert([
            [
                'noi_dung' => 'Sản phẩm tuyệt vời!',
                'customer_id' => 1,
                'product_id' => 1,
                'xep_hang' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'noi_dung' => 'Chất lượng rất tốt!',
                'customer_id' => 2,
                'product_id' => 2,
                'xep_hang' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
