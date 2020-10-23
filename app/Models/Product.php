<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ["name","price","photo", "unit", "step", "category_id", "not_available"];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

/*
 * Each product Belongs to one Category
 * Each Category has many products
 */
