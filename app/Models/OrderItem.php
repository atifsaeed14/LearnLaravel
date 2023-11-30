<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'quantity', 
        'price', 
        'discount', 
        'status', 
        'order_id', 
        'product_id', 
        'store_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function stores(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    protected static function booted(): void
    {
       static::addGlobalScope('member', function(Builder $builder){
            $builder->where('user_id', Auth::id())
            ->orWhereIn('store_id', Auth::user()->storeMemberships->pluck('id'))
            ->orWhereIn('product_id', Auth::user()->productMemberships->pluck('id'))
            ->orWhereIn('order_id', Auth::user()->orderMemberships->pluck('id'));

        });
    }
        
}
