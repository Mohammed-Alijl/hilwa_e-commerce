<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
      'zone_id'
    ];

    //===============================================================
    //========================== RELATIONSHips ======================
    //===============================================================
    public function zone(){
        return $this->belongsTo(Zone::class,'zone_id');
    }
    public function users(){
        return $this->hasMany(User::class,'city_id');
    }
}
