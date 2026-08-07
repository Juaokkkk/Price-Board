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

        if ($linhas === false) {
            throw new \RuntimeException('Não foi possível ler o arquivo MGV.');
        }

        $produtosMgv = [];

        foreach ($linhas as $linha) {

            // Somente registros de produto
            if (substr($linha, 0, 2) !== '01') {
                continue;
            }

            $codigo = (int) substr($linha, 2, 7);

            $preco = ((int) substr($linha, 9, 6)) / 100;

            $nome = trim(substr($linha, 18, 60));

            // Remove códigos numéricos no final do nome
            $nome = preg_replace('/\s+\d+$/', '', $nome);

            // Remove espaços duplicados
            $nome = preg_replace('/\s+/', ' ', $nome);

            $nome = trim($nome);

            // Ignora registros inválidos
            if ($codigo <= 0 || $nome === '') {
                continue;
            }

            /*
             * Usa o código como chave.
             *
             * Se o arquivo possuir o mesmo código mais de uma vez,
             * a última ocorrência será considerada.
             */
            $produtosMgv[$codigo] = [
                'codigo' => $codigo,
                'nome' => $nome,
                'preco' => $preco,
            ];
        }

        $novos = 0;
        $atualizados = 0;

        DB::transaction(function () use (
            $produtosMgv,
            $userId,
            &$novos,
            &$atualizados
        ) {

            /*
             * Busca os produtos que esse mercado já possui.
             *
             * O código é usado como chave para comparação.
             */
            $existentes = Produto::where('user_id', $userId)
                ->get()
                ->keyBy('codigo');

            foreach ($produtosMgv as $dados) {

                $produtoExistente = $existentes->get($dados['codigo']);

                /*
                 * PRODUTO JÁ EXISTE
                 *
                 * Atualizamos SOMENTE as informações vindas do MGV.
                 *
                 * Não alteramos:
                 *
                 * ativo
                 * imagem
                 * ordem
                 * promocao
                 * categoria
                 *
                 * Portanto, a configuração feita pelo cliente
                 * continua intacta.
                 */
                if ($produtoExistente) {

                    $produtoExistente->update([
                        'nome' => $dados['nome'],
                        'preco' => $dados['preco'],
                    ]);

                    $atualizados++;

                    continue;
                }

                /*
                 * PRODUTO NOVO
                 *
                 * Entra DESATIVADO.
                 *
                 * Dessa forma ele não aparece automaticamente
                 * na tela da TV.
                 */
                Produto::create([
                    'user_id' => $userId,
                    'codigo' => $dados['codigo'],
                    'nome' => $dados['nome'],
                    'preco' => $dados['preco'],
                    'ativo' => false,
                    'promocao' => false,
                    'ordem' => 0,
                ]);

                $novos++;
            }
        });

        return [
            'importados' => count($produtosMgv),
            'novos' => $novos,
            'atualizados' => $atualizados,
        ];
    }
}