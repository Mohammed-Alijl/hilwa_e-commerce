<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'city_id'
    ];

    //===============================================================
    //========================== RELATIONSHips ======================
    //===============================================================
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

}
