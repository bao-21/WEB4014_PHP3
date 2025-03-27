<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('posts')->insert([
            [
                'tieu_de' => 'Bài viết 1',
                'noi_dung' => 'Nội dung bài viết 1',
                'tac_gia' => 'Admin',
                'xuat_ban' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tieu_de' => 'Bài viết 2',
                'noi_dung' => 'Nội dung bài viết 2',
                'tac_gia' => 'Admin',
                'xuat_ban' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
