<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function variants(){
        return $this->hasMany(Variant::class);
    }

    public function attributes(){
        return $this->hasMany(Attribute::class);
    }
}
