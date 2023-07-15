<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['display_name','namespace','key','value','type'];

    protected $types = ['string', 'integer', 'float', 'boolean', 'color'];

    public function getTypesAttribute()
    {
        return $this->types;
    }

}
