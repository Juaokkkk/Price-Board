<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
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
        Produto::create([
            'nome' => $request->nome,
            'categoria' => $request->categoria,
            'preco' => $request->preco,
            'promocao' => $request->has('promocao'),
            'ativo' => true,
            'ordem' => $request->ordem,
        ]);

        return redirect('/admin/produtos');
    }

    public function update(Request $request, Produto $produto)
    {
        $produto->update([
            'nome' => $request->nome,
            'categoria' => $request->categoria,
            'preco' => $request->preco,
            'promocao' => $request->has('promocao'),
            'ativo' => $request->has('ativo'),
            'ordem' => $request->ordem,
        ]);

        return redirect('/admin/produtos');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect('/admin/produtos');
    }
}