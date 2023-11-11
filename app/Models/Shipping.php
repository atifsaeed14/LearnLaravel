<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Shipping extends Model
{
    use HasFactory;

    protected $fillable =[
                "source",
                "status",
                "cost",
                "order_id"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, Member::class);
    }
    
    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    protected static function booted(): void
    {
       static::addGlobalScope('member', function(Builder $builder){
            $builder->where('user_id', Auth::id())
            ->orWhereIn('order_id', Auth::user()->storeMemberships->pluck('id'));

        });
    }

    public function shippingComment()
    {
        return $this->hasMany(ShippingComment::class);
    }
}
