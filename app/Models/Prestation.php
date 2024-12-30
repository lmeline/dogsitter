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
        'dog_id',
        'service_id',
        'dogsitter_id',
        'proprietaire_id',
    ];

    public function proprietaire(): BelongsTo
    {
        return $this->belongsTo(User::class,'proprietaire_id');
    }

    public function dogsitter(): BelongsTo
    {
        return $this->belongsTo(User::class,'dogsitter_id');
    }

    public function avis():HasOne
    {
        return $this->hasOne(Avis::class);
    }

    public function dogs():HasMany
    {
        return $this->hasMany(Dog::class,'prestations_dogs');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(PrestationType::class, 'service_id');
    }
}



