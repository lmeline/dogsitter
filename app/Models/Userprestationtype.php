<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Userprestationtype extends Pivot
{
    use hasFactory;
    protected $table = 'users_prestations_types';

    protected $fillable = [
        'dogsitter_id',
        'prestation_type_id',
        'prix',
        'duree',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prestationtype()
    {
        return $this->belongsTo(Prestationtype::class, 'prestation_type_id');
    }
}
