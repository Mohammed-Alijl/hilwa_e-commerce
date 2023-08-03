<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'language_id',
        'store_id',
        'name'
    ];


    //===============================================================
    //========================== RELATIONSHips ======================
    //===============================================================
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
