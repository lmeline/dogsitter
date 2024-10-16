<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Statut extends Model
{
    use HasFactory;

   public function prestations():HasMany
   {
       return $this->hasMany(Prestation::class);
   }
   
}
