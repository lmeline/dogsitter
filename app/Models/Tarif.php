<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Tarif extends Model
{
    use HasFactory;

    public function prestation(): BelongsTo
    {
        return $this->belongsTo(prestation::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

 
