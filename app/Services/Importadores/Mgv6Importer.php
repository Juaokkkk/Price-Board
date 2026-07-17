<?php

namespace App\Services\Importadores;

use App\Models\Produto;

class Mgv6Importer
{
    public function importar(string $arquivo, int $userId): array
    {
        $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $novos = 0;
        $atualizados = 0;


        foreach ($linhas as $linha) {


            // Apenas registros de produtos
            if (substr($linha, 0, 2) !== '01') {
                continue;
            }


            $codigo = (int) substr($linha, 2, 7);

            $preco = ((int) substr($linha, 9, 6)) / 100;

            $nome = trim(substr($linha, 18));



            $produto = Produto::where('user_id', $userId)
                ->where('codigo', $codigo)
                ->first();



            if ($produto) {

                $produto->update([
                    'nome' => $nome,
                    'preco' => $preco,
                ]);

                $atualizados++;

            } else {


                Produto::create([
                    'user_id' => $userId,
                    'codigo' => $codigo,
                    'nome' => $nome,
                    'preco' => $preco,
                ]);

                $novos++;

            }

        }


        return [
            'novos' => $novos,
            'existentes' => $atualizados,
        ];
    }
}