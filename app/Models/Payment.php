<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Payment extends Model
{
    use HasFactory;

    protected $fillable =[
        "amount",
        "source",
        "status",
        "note",
        "order_id"
    ];

   /* protected $hidden = [
        'created_at',
        'updated_at'
    ];*/

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    protected static function booted(): void
    {
       static::addGlobalScope('member', function(Builder $builder){
            $builder->where('user_id', Auth::id())
            ->orWhereIn('order_id', Auth::user()->orderMemberships->pluck('id'));

        });
    }
}
