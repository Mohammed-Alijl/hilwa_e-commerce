<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $fillable = ['name'];



    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function units(){
        return $this->hasMany(UnitTranlsation::class,'language_id');
    }
    public function stores(){
        return $this->hasMany(StoreTranslation::class,'language_id');
    }
}
