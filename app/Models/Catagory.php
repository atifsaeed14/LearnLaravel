<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Catagory extends Model
{
     use HasFactory;

     protected $fillable =[
                "title",
                "description",
                "thumbnail",
                "slug",
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

    public function productCategory()
    {
        return $this->hasMany(ProductCategory::class);
    }
}
