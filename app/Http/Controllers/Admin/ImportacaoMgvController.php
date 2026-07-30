<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportacaoMgv;
use App\Models\Produto;

class ImportacaoMgvController extends Controller
{
    public function index()
    {
        $importacoes = ImportacaoMgv::where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('admin.mgv.historico', compact('importacoes'));
    }

    public function destroy(ImportacaoMgv $importacao)
    {
        abort_if($importacao->user_id !== auth()->id(), 403);

        // Apaga todos os produtos importados do usuário
        Produto::where('user_id', auth()->id())->delete();

        // Remove o registro do histórico
        $importacao->delete();

        return redirect()
            ->route('mgv.historico')
            ->with(
                'success',
                'Arquivo MGV removido e todos os produtos foram apagados.'
            );
    }
}