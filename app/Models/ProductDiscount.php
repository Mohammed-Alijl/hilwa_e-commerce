<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'start_date',
        'end_date',
        'discount_type',
        'discount_value',
    ];

    public static $discountTypes = ['fixed','percent'];

    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function prodcut(){
        return $this->belongsTo(Product::class);
    }

    public static function getDiscountTypes(){
        return self::$discountTypes;
    }
}
