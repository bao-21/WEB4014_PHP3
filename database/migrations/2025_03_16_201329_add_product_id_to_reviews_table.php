<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            //// Bổ sung 1 trường mới trong bảng
             $table->unsignedBigInteger('product_id')->after('noi_dung')->nullable();
             // Tạo liên kết
             $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            //
            $table->dropForeign('product_id');
            $table->dropColumn('product_id');
        });
    }
};
