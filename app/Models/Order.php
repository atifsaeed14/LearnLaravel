<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable =[
                "number",
                "source",
                "status",
                "active",
                "instruction",
                "first_name",
                "last_name",
                "email",
                "mobile",
                "lineland",
                "billing_address1",
                "billing_address2",
                "billing_city",
                "billing_state",
                "billing_postal_code",
                "billing_country",
                "shipping_address1",
                "shipping_address2",
                "shipping_city",
                "shipping_state",
                "shipping_postal_code",
                "shipping_country",
                "promo",
                "coupon_id",
                "subtotal",
                "shipping",
                "tax",
                "discount",
                "total",
                "created_at",
                "updated_at"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, Member::class);
    }
    
    protected static function booted(): void
    {
       static::addGlobalScope('member', function(Builder $builder){
            $builder->whereRelation('members', 'user_id', Auth::id());
        });
    }

    public function orderItem()
    {
        return $this->hasMany(orderItem::class);
    }
}
