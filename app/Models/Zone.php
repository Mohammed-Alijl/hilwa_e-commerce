<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'city_id',
        'store_id',
        'status',
        'postal_codes'
    ];
    protected $casts = [
        'postal_codes'=>'array'
    ];

    //===============================================================
    //========================== RELATIONSHips ======================
    //===============================================================
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function store(){
        return $this->belongsTo(Store::class,'store_id');
    }
    public function drivers(){
        return $this->hasMany(User::class,'zone_id');
    }

}
