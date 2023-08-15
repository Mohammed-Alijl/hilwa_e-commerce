<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Store extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'open_time',
        'close_time',
        'city_id',
        'zip_code',
        'address',
        'latitude',
        'longitude',
        'status'
    ];

    public $translatable = ['name'];

    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    public function zones(){
        return $this->hasMany(Zone::class,'store_id');
    }
}
