<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class)->withDefault(
            [
                'first_name' => 'NO Name'
            ]
        );
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    
    public function cart()
    {
        return $this->belongsToMany(
            Product::class,
            'carts',
            'user_id',
            'product_id',
            'id',
            'id'

        ) //اعطيته اسم الجدول الوسيط كارتس ليكسر العلاقة وبعطيه fk 
            ->withPivot(['quantity'])
            ->withTimestamps()
            ->using(Cart::class);
    }
}
