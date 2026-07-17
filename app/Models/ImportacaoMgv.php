<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportacaoMgv extends Model
{
    protected $table = 'importacoes_mgv';


    protected $fillable = [
        'user_id',
        'arquivo',
        'novos',
        'atualizados',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}