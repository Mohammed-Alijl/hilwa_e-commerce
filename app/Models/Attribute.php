<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'entity_id',
        'display_order',
        'isBoolean',
        'status'
    ];


    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function translations()
    {
        return $this->hasMany(AttributeTranslation::class,'attribute_id');
    }

    public function entity(){
        return $this->belongsTo(Entity::class,'entity_id');
    }
}
