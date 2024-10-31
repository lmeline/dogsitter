<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PrestationType extends Model
{
    protected $table = 'prestations_types'; // Spécifie la table pivot explicitement

    use HasFactory;
    
    public function users():BelongsToMany {
        return $this->belongsToMany(User::class, 'users_prestations_types')->withPivot('prix');
    }

}
