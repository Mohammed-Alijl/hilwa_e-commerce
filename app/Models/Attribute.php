<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'display_order',
        'frontend_type',
        'status'
    ];

    protected static $types = ['image', 'color', 'list', 'menu'];

    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function translations()
    {
        return $this->hasMany(AttributeTranslation::class,'attribute_id');
    }
    public static function getTypes()
    {
        return self::$types;
    }

    public function values(){
        return $this->hasMany(AttributeValue::class,'attribute_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
