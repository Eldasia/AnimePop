<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'intro',
        'content',
        'is_published',
        'user_id',
    ];

    protected $casts = [
        'is_published' => 'bool',
    ];

    protected $appends = [
        "view_url"
    ];

    /**
     * Users
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Tags
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    /**
     * Comments
     */
    public function comments(): MorphMany
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
    

    public function setTitleAttribute($value)
    {
        if ($this->exists && $value === $this->attributes['title']) {
            return;
        }

        $this->attributes['title'] = $value;

        $slug = Str::slug($value);
        $i = 1;
        while(null !== Post::where('slug', $slug)->first()) {
            $slug .= '-' . $i;
            $i++;
        }

        $this->attributes['slug'] = $slug;
    }

    public function getViewUrlAttribute()
    {
        return route('post', $this);
    }

    public function scopePublished(Builder $query)
    {
        $query->where('is_published', 1);
    }

    public function highlight(string $value, $term)
    {
        return preg_replace('/('. $term .')/i', "<mark>$1</mark>", $value);
    }
}
