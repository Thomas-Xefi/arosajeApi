<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasUuids;

    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'password',
        'address',
        'phone_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [
            'user' => [
                $this
            ]
        ];
    }

    public function ownedPlants(): HasMany
    {
        return $this->hasMany(Plant::class, 'owner_id');
    }

    public function guardedPlants(): HasMany
    {
        return $this->hasMany(Plant::class, 'guardian_id');
    }

    public function tips(): BelongsToMany
    {
        return $this->belongsToMany(Tip::class)
            ->withPivot('content');
    }
}
