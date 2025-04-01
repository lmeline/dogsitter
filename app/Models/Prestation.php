<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Prestation extends Model
{

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date_debut',
        'date_fin',
        'prestation_type_id',
        'dogsitter_id',
        'proprietaire_id',
        'dog_id',
        'prix_total',
        'disponibilite_id',
    ];

    public function proprietaire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'proprietaire_id');
    }

    public function dogsitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dogsitter_id');
    }
    public function dog(): BelongsTo
    {
        return $this->belongsTo(Dog::class, 'dog_id');
    }
    public function avis(): HasOne
    {
        return $this->hasOne(Avis::class);
    }

    public function prestationType(): BelongsTo
    {
        return $this->belongsTo(Prestationtype::class, 'prestation_type_id');
    }

    public function prestationDogs()
    {
        return $this->hasMany(PrestationDog::class, 'prestation_id');
    }
    public function disponibilite(): BelongsTo
    {
        return $this->belongsTo(Disponibilite::class);
    }
}



