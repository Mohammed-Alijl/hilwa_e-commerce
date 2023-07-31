<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'image',
        'address',
        'status',
        'zone_id',
        'platform',
        'type'
    ];

    protected $hidden = ['password'];

    public static $types = ['customer','driver'];

    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function addresses(){
        return $this->hasMany(CustomerAddress::class,'customer_id');
    }
    public function zone(){
        return $this->belongsTo(Zone::class,'zone_id');
    }
}
