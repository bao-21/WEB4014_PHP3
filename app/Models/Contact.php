<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contacts';

    protected $fillable = [
        'ten_lien_he',
        'email',
        'tin_nhan',
        'trang_thai'
    ];

    protected $dates = ['deleted_at']; // Sử dụng xóa mềm
}
