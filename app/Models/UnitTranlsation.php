<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitTranlsation extends Model
{
    use HasFactory;
    protected $fillable = ['language_id','unit_id','name'];


    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
