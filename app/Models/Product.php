<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ["name","price","photo","category_id"];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}

/*
 * Each product Belongs to one Category
 * Each Category has many products
 */
