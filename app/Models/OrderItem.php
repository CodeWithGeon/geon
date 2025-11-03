<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    /**
     * order
     * the order this item belongs to
     * @return
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * the product associated with this order item
     * @return
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

        public function user()
    {
        return $this->order->user;
    }
}

