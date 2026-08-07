<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * Atributos atribuíveis em massa.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo',
        'api_token',
    ];

    /**
     * Atributos ocultos.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'api_token',
    ];

    /**
     * Atributos adicionados automaticamente.
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Conversões.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function configuracao()
    {
        return $this->hasOne(Configuracao::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function isAdmin()
    {
        return $this->tipo === 'admin';
    }

    /*
    |--------------------------------------------------------------------------
    | API TOKEN
    |--------------------------------------------------------------------------
    */

    public function gerarApiToken(): string
    {
        $token = 'pb_' . Str::random(60);

        $this->update([
            'api_token' => $token,
        ]);

        return $token;
    }
}