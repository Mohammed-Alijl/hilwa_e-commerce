<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'update_open',
        'confirm_place_order',
        'create_new_order_back_office',
        'show_unavailable_offers',
    ];
}
