<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilite extends Model
{
    use HasFactory;

    protected $fillable = ['dogsitter_id', 'jour_semaine', 'heure_debut', 'heure_fin','prestation_id'];

    public function dogsitter()
    {
        return $this->belongsTo(User::class, 'dogsitter_id');
    }

    public function prestation()
    {
        return $this->hasMany(Prestation::class, 'prestation_id');
    }
}

