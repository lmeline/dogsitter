<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserPrestationType extends Pivot
{
    protected $table = 'users_prestations_types'; // Spécifie la table pivot explicitement

    protected $fillable = [
        'user_id',
        'prestation_type_id',
        'prix',
    ];

    public $timestamps = false; 
}
