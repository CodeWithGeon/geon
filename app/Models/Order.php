<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'created_by',
    ];

    /**
     * user
     *placed the order
     * @return
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * creator
     * who created the order record
     * @return
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * items
     * order items
     * @return
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
