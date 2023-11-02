<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'thumbnail',
        'sku',
        'tagline',
        'description',
        'price',
        'discount',
        'status',
        'featured',
        'published',
        'stock',
        'store_id',
    ];

   /* protected $hidden = [
        'created_at',
        'updated_at'
    ];*/

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function stores(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    protected static function booted(): void
    {
       static::addGlobalScope('member', function(Builder $builder){
            $builder->where('user_id', Auth::id())
            ->orWhereIn('store_id', Auth::user()->storeMemberships->pluck('id'));

        });
    }

    public function productImage()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productReview()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function productCategory()
    {
        return $this->hasMany(ProductCategory::class);
    }

}
