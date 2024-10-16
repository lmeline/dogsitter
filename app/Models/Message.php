<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    public function expediteur(): BelongsTo
    {
        return $this->belongsTo(User::class,'expediteur_id');
    }

    public function destinataire(): BelongsTo
    {
        return $this->belongsTo(User::class,'destinataire_id');
    }
}
