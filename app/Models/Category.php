<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    // Để làm việc với Factory ta phải sử dụng thư viện HasFactory
    use HasFactory, SoftDeletes;
    // Muốn model làm việc với bảng nào ta cần quy định trong thuộc tính
    protected $table = 'categories';
    // Muốn làm việc với Eloquent thì ta cần xác định 
    // các trường dữ liệu vào fillable
    protected $fillable = [
        'ten_danh_muc',
        'trang_thai'
    ];

    protected $dates = ['deleted_at'];
    // Tạo mối liên hệ với Product
    public function products(){
        return $this->hasMany(Product::class, 'category_id');
    }
    // Tương tự tạo model product
}
