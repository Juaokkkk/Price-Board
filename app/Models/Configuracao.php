<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    protected $table = 'configuracoes';

    protected $fillable = [
        'user_id',
        'logo',
        'imagem_fundo',
        'tema',
        'cor_principal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}