<?php

namespace App\Models;

use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'thread_id', 'body'];

    // Relation avec le thread
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    // Relation avec l'utilisateur qui a envoyé le message
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
