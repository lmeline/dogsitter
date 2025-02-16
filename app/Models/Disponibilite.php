<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilite extends Model
{
    use HasFactory;

    protected $fillable = ['dogsitter_id', 'jour_semaine', 'heure_debut', 'heure_fin'];

    public function user()
    {
        return $this->belongsTo(User::class, 'dogsitter_id');
    }
}
