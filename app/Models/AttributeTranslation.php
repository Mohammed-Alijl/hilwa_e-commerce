<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
      'language_id',
      'attribute_id',
      'name'
    ];


    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
