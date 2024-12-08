<?php

namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'experience',
        'description',
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
        return $this->belongsTo(Abonnement::class);
    }


    public function messagesEnvoyes(): HasMany
    {
        return $this->hasMany(Message::class, 'expediteur_id');
    }

    public function messagesRecus(): HasMany
    {
        return $this->hasMany(Message::class, 'destinataire_id');
    }

    public function prestationtypes(): BelongsToMany
    {
        return $this->belongsToMany(Prestationtype::class, 'users_prestations_types','dogsitter_id','prestation_type_id')->withPivot('prix');
    }
}
