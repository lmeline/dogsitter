<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Userprestationtype extends Pivot
{
    protected $table = 'users_prestationtypes'; // Spécifie la table pivot explicitement

    protected $fillable = [
        'user_id',
        'prestationtype_id',
        'prix',
    ];

    public $timestamps = false; 
}
