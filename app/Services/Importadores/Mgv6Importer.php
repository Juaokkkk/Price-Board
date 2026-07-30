<?php

namespace App\Services\Importadores;

use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class Mgv6Importer
{
    public function importar(string $arquivo, int $userId): array
    {
        $linhas = file(
            $arquivo,
            FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
        );

        $produtos = [];

        foreach ($linhas as $linha) {

            // Somente registros de produto
            if (substr($linha, 0, 2) !== '01') {
                continue;
            }

            $codigo = (int) substr($linha, 2, 7);

            $preco = ((int) substr($linha, 9, 6)) / 100;

            $nome = trim(substr($linha, 18, 60));

            // Remove códigos numéricos no final (ex: 0236960000)
            $nome = preg_replace('/\s+\d+$/', '', $nome);

            // Remove espaços duplicados
            $nome = preg_replace('/\s+/', ' ', $nome);

            $nome = trim($nome);


            $produtos[] = [
                'user_id' => $userId,
                'codigo' => $codigo,
                'nome' => $nome,
                'preco' => $preco,

                // Importa desativado.
                // O cliente escolhe manualmente quais produtos irão para a TV.
                'ativo' => false,

                'created_at' => now(),
                'updated_at' => now(),
            ];
        }


        DB::transaction(function () use ($produtos, $userId) {

            // Remove apenas os produtos desse mercado
            Produto::where('user_id', $userId)
                ->delete();


            // Insere a nova carga do MGV
            Produto::insert($produtos);

        });


        return [
            'importados' => count($produtos)
        ];
    }
}