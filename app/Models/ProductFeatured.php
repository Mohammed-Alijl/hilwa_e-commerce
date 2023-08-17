<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeatured extends Model
{
    use HasFactory;
    protected $fillable = [
      'start_at',
      'end_at',
      'display_order',
      'status',
    ];
}
