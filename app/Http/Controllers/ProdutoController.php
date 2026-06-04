<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $produtos = Produto::where('ativo', true)
            ->orderBy('ordem')
            ->get();

        return view('tv.acougue', compact('produtos'));
    }

    public function index()
    {
        $produtos = Produto::orderBy('ordem')->get();

        return view('admin.produtos', compact('produtos'));
    }

    public function store(Request $request)
    {
       $dados = $request->validate(
[
    'nome' => 'required|string|max:255',
    'categoria' => ['required', Rule::in($this->categorias)],
    'preco' => 'required|numeric|min:0',
    'ordem' => 'required|integer|min:1|unique:produtos,ordem',
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
    'ordem.unique' => 'Já existe um produto utilizando essa posição na TV.'
]
);

        Produto::create([
            'nome' => $dados['nome'],
            'categoria' => $dados['categoria'],
            'preco' => $dados['preco'],
            'promocao' => $request->has('promocao'),
            'ativo' => true,
            'ordem' => $dados['ordem'],
        ]);

        return redirect('/admin/produtos')
    ->with('sucesso', 'Produto cadastrado com sucesso.');
    }

    public function update(Request $request, Produto $produto)
{
    $dados = $request->validate(
    [
        'nome' => 'required|string|max:255',
        'categoria' => ['required', Rule::in($this->categorias)],
        'preco' => 'required|numeric|min:0',
        'ordem' => [
            'required',
            'integer',
            'min:1',
            Rule::unique('produtos', 'ordem')->ignore($produto->id),
        ],
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
        'ordem.unique' => 'Já existe um produto utilizando essa posição na TV.',
    ]
    );

    $produto->update([
        'nome' => $dados['nome'],
        'categoria' => $dados['categoria'],
        'preco' => $dados['preco'],
        'promocao' => $request->has('promocao'),
        'ativo' => $request->has('ativo'),
        'ordem' => $dados['ordem'],
    ]);

    return redirect('/admin/produtos')
        ->with('sucesso', 'Produto atualizado com sucesso.');
}
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect('/admin/produtos')
    ->with('sucesso', 'Produto removido com sucesso.');
    }
}