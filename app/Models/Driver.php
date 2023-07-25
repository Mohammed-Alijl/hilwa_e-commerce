<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'address',
        'zone_id',
        'image',
        'status',
    ];
    protected $hidden = [
        'password'
    ];



    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function zone(){
        return $this->belongsTo(Zone::class,'zone_id');
    }
}
