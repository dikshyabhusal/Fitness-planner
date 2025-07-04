<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'is_read', // ✅ Make sure this is in fillable so you can update it
    ];

    // Relationship: who sent the message
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relationship: who received the message
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
