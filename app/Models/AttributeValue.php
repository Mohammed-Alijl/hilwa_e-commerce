<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = ['attribute_id','name','frontend_type_value'];

    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function attribute(){
        return $this->belongsTo(Attribute::class,'attribute_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class,'attribute_value_product');
    }
}
