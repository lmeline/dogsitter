<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Prestation extends Model
{
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_presentations');
    }

    public function avis()
    {
        return $this->hasOne(Avis::class);
    }

    public function statut():HasMany
    {
        return $this->hasMany(Statut::class);
    }

    public function tarifs():HasMany
    {
        return $this->hasMany(Tarif::class);
    }
}



