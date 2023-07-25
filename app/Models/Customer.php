<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['name','mobile_number','email','image'];
    protected $hidden = ['password'];








    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function addresses(){
        return $this->hasMany(CustomerAddress::class,'customer_id');
    }
}
