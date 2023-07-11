<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
      'name'
    ];

    //===============================================================
    //========================== RELATIONSHips ======================
    //===============================================================
    public function zones(){
        return $this->hasMany(Zone::class,'country_id');
    }
}
