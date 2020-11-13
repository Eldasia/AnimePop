<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'url_profile'
    ];

    /**
     * Orders
     */
    public function orders(): HasMany
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * Posts
     */
    public function posts(): HasMany
    {
        return $this->hasMany('App\Models\Post');
    }

    public function publishedPosts()
    {
        return $this->posts()->published();
    }

    /**
     * Comments
     */
    public function comments(): HasMany
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * Conversations
     */
    public function conversations(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Conversation')->withTimestamps();
    }

    /**
     * Messages
     */
    public function messages(): HasMany
    {
        return $this->hasMany('App\Models\Message');
    }

    /**
     * Animes
     */
    public function animes(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Anime')
                    ->withTimestamps()
                    ->withPivot(['is_viewed']);
    }

    public function viewedAnimes()
    {
        return $this->animes()->withPivotValue('is_viewed', true);
    }

    public function unviewedAnimes()
    {
        return $this->animes()->withPivotValue('is_viewed', false);
    }



    public function getUrlProfileAttribute()
    {
        return route('profile', $this);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $value;
    }
}