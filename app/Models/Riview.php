<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Riview extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reviews';

    protected $fillable = ['noi_dung', 'customer_id', 'product_id', 'xep_hang'];

    public function customer()
    {
        return $this->belongsTo(Customser::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
