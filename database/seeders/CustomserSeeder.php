<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('customers')->insert([
            [
                'ten_khach_hang' => 'Nguyen Van A',
                'so_dien_thoai' => '098765431',
                'email' => 'A@gmail.com',
                'dia_chi' => 'Đức Thắng'
            ],
            [
                'ten_khach_hang' => 'Nguyen Van B',
                'so_dien_thoai' => '0987654321',
                'email' => 'B@gmail.com',
                'dia_chi' => 'Trịnh Văn Bô'
            ]
        ]);
    }
}
