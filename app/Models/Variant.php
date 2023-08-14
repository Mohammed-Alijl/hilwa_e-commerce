<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'price',
        'quantity',
        'image',
    ];

    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function attributes(){
        return $this->belongsToMany(Attribute::class)->withPivot('attribute_value_id');
    }
}
