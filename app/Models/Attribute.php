<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'display_order',
        'type',
        'value_multiplicity',
        'status'
    ];

    protected static $types = ['string', 'integer', 'float', 'boolean', 'image'];

    protected static $value_multiplicity = ['single', 'list'];

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
    public static function getMultiplicity()
    {
        return self::$value_multiplicity;
    }
}
