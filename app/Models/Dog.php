<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dog extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'age',
        'race',
        'poids',
        'comportement',
        'besoins_speciaux',
        'sexe',
        'sterilise',
        'proprietaire_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'proprietaire_id');
    }
}
