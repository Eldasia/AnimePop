<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Comment;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'mal_id',
        'title',
        'slug',
        'mal_url',
        'img_url',
        'type',
        'synopsis',
        'episodes',
        'start_diff',
        'end_diff',
        'rated'
    ];

    protected $dates = [
        'start_diff',
        'end_diff'
    ];

    /**
     * Users
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User')
                    ->withTimestamps()
                    ->withPivot(['is_viewed']);
    }

    /**
     * Comments
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Products
     */
    public function products(): HasMany
    {
        return $this->hasMany('App\Models\Product');
    }

    public function getViewUrlAttribute()
    {
        return route('anime', $this);
    }
}
