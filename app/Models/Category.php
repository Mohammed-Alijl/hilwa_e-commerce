<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
      'display_order',
      'parent_category_id',
      'color_code',
      'status',
      'image',
    ];

    public function parentCategory(){
        return $this->belongsTo(Category::class);
    }

    public function childCategories(){
        return $this->hasMany(Category::class);
    }

    public function translations(){
        return $this->hasMany(CategoryTranslation::class);
    }

    public function cities(){
        return $this->belongsToMany(City::class,'category_city','category_id','city_id');
    }
}
