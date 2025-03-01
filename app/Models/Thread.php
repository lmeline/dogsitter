<?php

namespace App\Models;

use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Thread as BaseThread;

class Thread extends BaseThread
{
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'threads_users','thread_id','user_id','participants')->withTimestamps();
    }
    public function addParticipants($userIds)
    {
        foreach ($userIds as $userId) {
            $this->participants()->attach($userId);
        }
    }

    public function getParticipantsNames()
    {
        return $this->participants->pluck('name');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'participants')
            ->withTimestamps()
            ->whereNull('participants.deleted_at');
    }
}
