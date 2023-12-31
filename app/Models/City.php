<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
      'name',
      'state_id'
    ];

    //===============================================================
    //========================== RELATIONSHips ======================
    //===============================================================
    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
    public function zones(){
        return $this->hasMany(Zone::class,'city_id');
    }
    public function users(){
        return $this->hasMany(Admin::class,'city_id');
    }
    public function customerAddress(){
        return $this->hasMany(CustomerAddress::class,'city_id');
    }
    public function stores(){
        return $this->hasMany(Store::class,'city_id');
    }
    public function categories(){
        return $this->belongsToMany(Category::class,'category_city','city_id','category_id');
    }
}
