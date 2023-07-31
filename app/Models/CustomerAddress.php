<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'city_id',
        'latitude',
        'longitude',
        'address_one',
        'address_two',
        'street',
        'district',
        'address_type_id',
        'status',
        'isDefault',
        'use_for',
        'postal_code',
        'customer_id'
    ];
    public static $types = ['delivery','billing'];

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function customer(){
        return $this->belongsTo(User::class,'customer_id');
    }
    public function addressType(){
        return $this->belongsTo(AddressType::class,'address_type_id');
    }
}
