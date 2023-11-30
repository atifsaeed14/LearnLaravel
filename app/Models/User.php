<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = [];

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

    /*public function store()
    {
        return $this->belongsToMany(Store::class);
    }*/

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'creator_id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'creator_id');
    }
     
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'user_id');
    }

     public function stores(): HasMany
    {
        return $this->hasMany(Store::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function orderitems()
    {
        return $this->hasMany(OrderItem::class, 'user_id');
    }

    public function shippings()
    {
        return $this->hasMany(Shipping::class, 'user_id');
    }

    public function catagories()
    {
        return $this->hasMany(Catagory::class, 'user_id');
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'user_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'user_id');
    }


    public function memberships(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, Member::class);
    }

    public function storeMemberships(): BelongsToMany
    {
        return $this->belongsToMany(Store::class, Member::class);
    }

    public function orderMemberships(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, Member::class);
    }

    public function shippingMemberships(): BelongsToMany
    {
        return $this->belongsToMany(Shipping::class, Member::class);
    }

    public function catagoryMemberships(): BelongsToMany
    {
        return $this->belongsToMany(Catagory::class, Member::class);
    }

    public function couponMemberships(): BelongsToMany
    {
        return $this->belongsToMany(Coupon::class, Member::class);
    }

    public function productMemberships(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, Member::class);
    }

    public function orderitemMemberships(): BelongsToMany
    {
        return $this->belongsToMany(OrderItem::class, Member::class);
    }
}

