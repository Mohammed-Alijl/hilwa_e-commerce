<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
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

    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function translations()
    {
        return $this->hasMany(StoreTranslation::class,'store_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
}
