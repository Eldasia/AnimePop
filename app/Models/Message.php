<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'conversation_id',
        'content',
    ];

    /**
     * Conversations
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo('App\Models\Conversation');
    }

    /**
     * Users
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
