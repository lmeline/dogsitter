<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prestationtype extends Model
{
    protected $table = 'prestations_types'; // Spécifie la table pivot explicitement

    protected $fillable = ['nom'];
    use HasFactory;


    /**
     * Relation Many-to-Many avec les dogsitters via la table pivot users_prestations_types.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_prestations_types', 'prestation_type_id', 'dogsitter_id')
            ->withPivot('prix', 'duree');
    }

    public function prestations(): HasMany
    {
        return $this->hasMany(Prestation::class);
    }
    public function userPrestations()
    {
        return $this->hasMany(Userprestationtype::class, 'prestation_type_id');
    }

}
