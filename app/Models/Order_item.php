<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    protected $fillable = ['user_id', 'order_id', 'item_id', 'qty', 'item_name', 'item_price', 'item_total'];

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }
}
