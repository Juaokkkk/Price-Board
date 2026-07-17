<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

protected $fillable = [
    'user_id',
    'codigo',
    'nome',
    'preco',
    'categoria',
    'imagem',
    'promocao',
    'ativo',
    'ordem',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}