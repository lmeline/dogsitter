<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avis extends Model
{
    protected $table = 'aviss';

    use HasFactory;

    protected $fillable = [
        'user_id',
        'rating',
        'commentaire',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function prestation(): BelongsTo
    // {
    //     return $this->belongsTo(Prestation::class);
    // }
}
