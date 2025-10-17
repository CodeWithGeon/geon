<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * hidden
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * Get the attributes that should be cast.
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];
    /**
     * Check if the user is an admin
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }


    /**
     * If you want to track products created by a user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'created_by');
    }
    /**
     * cast
     *
     * @return array
     */
    // protected function cast(): array
    // {
    //     return
    //         [
    //             'email_verified_at' => 'datetime',
    //             'password' => 'hashed',
    //             'deleted_at' => 'datetime',
    //             'is_admin' => 'boolean',
    //         ];
    // }
}
