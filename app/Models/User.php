<?php

namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'prenom',
        'email',
        'numero_telephone',
        'adresse',
        'code_postal',
        'date_naissance',
        'ville',
        'password',
        'role',
        'description',
        'photo',
        'abonnement_type_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function dogs(): HasMany
    {
        return $this->hasMany(Dog::class,'proprietaire_id');
    }
    public function prestationsAsproprietaire(): HasMany
    {
        return $this->hasMany(Prestation::class,'proprietaire_id');
    }

    public function prestationsAsdogsitter(): HasMany
    {
        return $this->hasMany(Prestation::class,'dogsitter_id');
    }

    
    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class, 'users_aviss');
    }

    public function abonnement(): BelongsTo
    {
        return $this->belongsTo(Abonnement::class,'abonnement_type_id');
    }

    public function prestationtypes(): BelongsToMany
    {
        return $this->belongsToMany(Prestationtype::class, 'users_prestations_types','dogsitter_id','prestation_type_id')->withPivot('prix','duree');
    }

    public function threads()
    {
        return $this->belongsToMany(Thread::class, 'threads_users')->withTimestamps();
    }

    // Relation avec les messages envoyés par cet utilisateur
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Si vous souhaitez filtrer par rôle (propriétaire ou dogsitter), vous pouvez ajouter une méthode de portée (scope)
    public function scopeProprietaire($query)
    {
        return $query->where('role', 'proprietaire');
    }

    public function scopeDogsitter($query)
    {
        return $query->where('role', 'dogsitter');
    }

}
