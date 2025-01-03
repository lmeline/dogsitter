<?php
namespace App\Models;

use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Thread as BaseThread;
use Illuminate\Database\Eloquent\Model;

class Thread extends BaseThread
{
    // Relation avec les messages associés à ce thread
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Relation avec les utilisateurs qui participent au thread
    public function participants()
    {
        return $this->belongsToMany(User::class, 'threads_users')->withTimestamps();
    }
    public function addParticipants($userIds)
    {
        foreach ($userIds as $userId) {
            $this->participants()->attach($userId);
        }
    }

    // Méthode pour récupérer tous les participants
    public function getParticipantsNames()
    {
        return $this->participants->pluck('name');
    }
}
