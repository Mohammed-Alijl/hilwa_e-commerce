<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
      'name',
      'display_order',
      'parent_category_id',
      'color_code',
      'status',
      'image',
    ];

    public $translatable = ['name'];

    //=======================================================
    //==================RELATIONSHIPS========================
    //=======================================================
    public function parentCategory(){
        return $this->belongsTo(Category::class);
    }

    public function childCategories(){
        return $this->hasMany(Category::class);
    }


    public function cities(){
        return $this->belongsToMany(City::class,'category_city','category_id','city_id');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
