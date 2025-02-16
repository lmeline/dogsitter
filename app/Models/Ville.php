<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $table = 'villes';
    
    use HasFactory;

    protected $fillable = [
        'nom_de_la_commune',
        'code_postal',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
