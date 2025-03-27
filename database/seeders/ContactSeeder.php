<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            [
                'ten_lien_he' => 'Le Van A',
                'email' => 'c@gmail.com',
                'tin_nhan' => 'Xin chào',
                'trang_thai' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'ten_lien_he' => 'Pham Van D',
                'email' => 'd@example.com',
                'tin_nhan' => 'Hỗ trợ giúp tôi',
                'trang_thai' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        
    }
}
