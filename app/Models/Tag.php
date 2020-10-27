<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'slug',
    ];
    protected $withCount = [
        'posts',
        'publishedPosts',
    ];

    /**
     * Posts
     */
    public function posts(): MorphToMany
    {
        return $this->morphedByMany('App\Models\Post', 'taggable');
    }

    public function publishedPosts()
    {
        return $this->posts()->published();
    }

    /**
     * Products
     */
    public function products(): MorphToMany
    {
        return $this->morphedByMany('App\Models\Product', 'taggable');
    }

    
    public function getViewUrlAttribute(): string
    {
        return route('tag', $this);
    }
}
