<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('banners')->insert([
            [
                'hinh_anh' => 'banner1.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'hinh_anh' => 'banner2.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }
}
