<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrestationDog extends Model
{
    protected $table = 'prestations_dogs';
    
    protected $fillable = [
        'dog_id',
        'prestation_id',
        'prix',
    ];

    use HasFactory;
    public function dog():BelongsTo
    {
        return $this->belongsTo(Dog::class, 'dog_id');
    }

    public function prestation():BelongsTo
    {
        return $this->belongsTo(Prestation::class,'prestation_id');
    }
}
