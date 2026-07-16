<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'user_id',
        'imagem',
        'titulo',
        'ativo',
        'ordem',
        'inicio',
        'fim',
        'duracao',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}