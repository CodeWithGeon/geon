<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// Talks directly to the database (Eloquent ORM)
class Product extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'is_available',
        'created_by',
        'category_id',
    ];
    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'is_available' => 'boolean',
        'price' => 'decimal:2',
    ];

    /**
     * creator
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * category
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
