<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    /**
     * Users
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

    /**
     * Messages
     */
    public function messages(): HasMany
    {
        return $this->hasMany('App\Models\Message');
    }
}
