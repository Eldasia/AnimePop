<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'price',
        'tax',
        'stock',
    ];

    /**
     * Orders
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Order', 'order_product');
    }

    /**
     * Tags
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    /**
     * Animes
     */
    public function anime(): BelongsTo
    {
        return $this->belongsTo('App\Models\Anime');
    }

    /**
     * Comments
     */
    public function comments(): MorphMany
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}
