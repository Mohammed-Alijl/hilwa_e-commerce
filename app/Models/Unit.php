<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function translations()
    {
        return $this->hasMany(UnitTranlsation::class,'unit_id');
    }
}
