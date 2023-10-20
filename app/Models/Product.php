<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'user_id'
    ];

   /* protected $hidden = [
        'created_at',
        'updated_at'
    ];*/

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope('creator', function(Builder $builder){
            $builder->where('user_id', Auth::id());
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
