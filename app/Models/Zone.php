<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'country_id'
    ];

    //===============================================================
    //========================== RELATIONSHips ======================
    //===============================================================
    public function cities(){
        return $this->hasMany(City::class,'zone_id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

}
