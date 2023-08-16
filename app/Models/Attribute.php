<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = [
        'name',
        'display_order',
        'frontend_type',
        'status'
    ];

    protected static $types = ['image', 'color', 'list', 'menu'];

    public $translatable = ['name'];

    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
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
