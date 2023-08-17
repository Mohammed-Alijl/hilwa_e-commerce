<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'sku',
        'price',
        'special_price',
        'min_quantity',
        'max_quantity',
        'show_customer_app',
        'weight_in_points',
        'unit_id',
        'stock_quantity',
        'stock_status',
        'category_id',
        'status'
    ];

    public $translatable = ['name'];


    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function variants(){
        return $this->hasMany(Variant::class);
    }

    public function attributes(){
        return $this->hasMany(Attribute::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function discounts(){
        return $this->hasMany(ProductDiscount::class);
    }

    public function options(){
        return $this->hasMany(AttributeValue::class,'attribute_value_product');
    }
}
