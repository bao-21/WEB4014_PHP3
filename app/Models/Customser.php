<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customser extends Model
{
    //
    use HasFactory,SoftDeletes;

    protected $table = 'customers';


    protected $fillable = [
        'ten_khach_hang',
        'so_dien_thoai',
        'email',
        'dia_chi'
    ];

    protected $dates = ['deleted_at'];

}
