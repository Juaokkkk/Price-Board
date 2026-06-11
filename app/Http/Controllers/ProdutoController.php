<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Configuracao;

class ProdutoController extends Controller
{
    private array $categorias = [
        'Bovinos',
        'Suinos',
        'Aves',
        'Peixes',
        'Embutidos',
        'Congelados',
        'Laticinios',
        'Outros'
    ];

   public function tv()
{
    $produtos = Produto::where('user_id', auth()->id())
        ->where('ativo', true)
        ->orderBy('ordem')
        ->get();

    $configuracao = Configuracao::where(
        'user_id',
        auth()->id()
    )->first();

    return view(
        'tv.acougue',
        compact(
            'produtos',
            'configuracao'
        )
    );
}

    public function index()
{
    $produtos = Produto::where('user_id', auth()->id())
        ->orderBy('ordem')
        ->get();

    $proximaOrdem = (
        Produto::where('user_id', auth()->id())
            ->max('ordem') ?? 0
    ) + 1;

    return view(
        'admin.produtos',
        compact(
            'produtos',
            'proximaOrdem'
        )
    );
}
    public function store(Request $request)
    {
        $dados = $request->validate(
            [
                'nome' => 'required|string|max:255',
                'categoria' => ['required', Rule::in($this->categorias)],
                'preco' => 'required|numeric|min:0',
                'ordem' => 'required|integer|min:1',
            ],
            [
                'nome.required' => 'Informe o nome do produto.',
                'nome.max' => 'O nome pode ter no máximo 255 caracteres.',

                'categoria.required' => 'Selecione uma categoria.',

                'preco.required' => 'Informe o preço.',
                'preco.numeric' => 'O preço deve ser um número válido.',
                'preco.min' => 'O preço não pode ser negativo.',

                'ordem.required' => 'Informe a ordem na TV.',
                'ordem.integer' => 'A ordem deve ser um número inteiro.',
                'ordem.min' => 'A ordem deve ser maior que zero.',
            ]
        );

        DB::transaction(function () use ($dados, $request) {

            Produto::where('user_id', auth()->id())
                ->where('ordem', '>=', $dados['ordem'])
                ->increment('ordem');

            Produto::create([
                'user_id' => auth()->id(),
                'nome' => $dados['nome'],
                'categoria' => $dados['categoria'],
                'preco' => $dados['preco'],
                'promocao' => $request->has('promocao'),
                'ativo' => true,
                'ordem' => $dados['ordem'],
            ]);
        });

        return redirect('/admin/produtos')
            ->with('sucesso', 'Produto cadastrado com sucesso.');
    }

    public function update(Request $request, Produto $produto)
    {
        abort_if($produto->user_id !== auth()->id(), 403);

        $dados = $request->validate(
            [
                'nome' => 'required|string|max:255',
                'categoria' => ['required', Rule::in($this->categorias)],
                'preco' => 'required|numeric|min:0',
                'ordem' => 'required|integer|min:1',
            ],
            [
                'nome.required' => 'Informe o nome do produto.',
                'nome.max' => 'O nome pode ter no máximo 255 caracteres.',

                'categoria.required' => 'Selecione uma categoria.',

                'preco.required' => 'Informe o preço.',
                'preco.numeric' => 'O preço deve ser um número válido.',
                'preco.min' => 'O preço não pode ser negativo.',

                'ordem.required' => 'Informe a ordem na TV.',
                'ordem.integer' => 'A ordem deve ser um número inteiro.',
                'ordem.min' => 'A ordem deve ser maior que zero.',
            ]
        );

        DB::transaction(function () use ($produto, $dados, $request) {

            $ordemAntiga = $produto->ordem;
            $ordemNova = $dados['ordem'];

            if ($ordemNova < $ordemAntiga) {

                Produto::where('user_id', auth()->id())
                    ->where('id', '!=', $produto->id)
                    ->whereBetween('ordem', [$ordemNova, $ordemAntiga - 1])
                    ->increment('ordem');

            } elseif ($ordemNova > $ordemAntiga) {

                Produto::where('user_id', auth()->id())
                    ->where('id', '!=', $produto->id)
                    ->whereBetween('ordem', [$ordemAntiga + 1, $ordemNova])
                    ->decrement('ordem');
            }

            $produto->update([
                'nome' => $dados['nome'],
                'categoria' => $dados['categoria'],
                'preco' => $dados['preco'],
                'promocao' => $request->has('promocao'),
                'ativo' => $request->has('ativo'),
                'ordem' => $ordemNova,
            ]);
        });

        return redirect('/admin/produtos')
            ->with('sucesso', 'Produto atualizado com sucesso.');
    }

    public function destroy(Produto $produto)
    {
        abort_if($produto->user_id !== auth()->id(), 403);

        $produto->delete();

        return redirect('/admin/produtos')
            ->with('sucesso', 'Produto removido com sucesso.');
    }
}