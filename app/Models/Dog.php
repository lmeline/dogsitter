<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dog extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'date_naissance',
        'race',
        'poids',
        'comportement',
        'besoins_speciaux',
        'sexe',
        'sterilise',
        'proprietaire_id',
        'photo'
    ];

    public function proprietaire(): BelongsTo
    {
        return $this->belongsTo(User::class,'proprietaire_id');
    }

    public function prestation():BelongsTo
    {
        return $this->belongsTo(Prestation::class,'prestation_id');
    }
}
