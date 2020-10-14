<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['title', 'description', 'user_name', 'user_id', 'total_cost', 'user_address', 'phone_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_items()
    {
        return $this->hasMany(Order_item::class);
    }
}
