<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PrestationType extends Model
{
    protected $table = 'prestations_types'; // Spécifie la table pivot explicitement
    
    protected $fillable = ['nom'];
    use HasFactory;
    
    public function users():BelongsToMany {
        return $this->belongsToMany(User::class, 'users_prestations_types')->withPivot('prix');
    }

    public function prestations(): HasMany
    {
        return $this->hasMany(Prestation::class);
    }
    public function userPrestations()
    {
        return $this->hasMany(UserPrestationType::class, 'prestation_type_id');
    }

}
