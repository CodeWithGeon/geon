<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Category extends Model


{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name',
        'description',
        'created_by',
    ];

    /**
     * creator
     * Category was created by a user
     * @return BelongsTo
     */
    public function creator (): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * products
     *
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
