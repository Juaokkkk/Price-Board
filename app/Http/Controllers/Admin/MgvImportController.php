<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Importadores\Mgv6Importer;
use App\Models\ImportacaoMgv;
use App\Models\Produto;
use Illuminate\Http\Request;

class MgvImportController extends Controller
{
    public function index()
    {
        return view('admin.mgv.importar');
    }

    public function importar(Request $request, Mgv6Importer $importador)
    {
        $request->validate([
            'arquivo' => [
                'required',
                'file',
            ],
        ]);

        $arquivo = $request->file('arquivo');

        $resultado = $importador->importar(
            $arquivo->getRealPath(),
            auth()->id()
        );

        ImportacaoMgv::create([
            'user_id'     => auth()->id(),
            'arquivo'     => $arquivo->getClientOriginalName(),
            'novos'       => $resultado['importados'],
            'existentes'  => 0,
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                "Importação concluída! {$resultado['importados']} produtos sincronizados."
            );
    }

    public function limpar()
    {
        Produto::where('user_id', auth()->id())->delete();

        ImportacaoMgv::where('user_id', auth()->id())->delete();

        return redirect()
            ->route('mgv.index')
            ->with(
                'success',
                'Todos os produtos importados foram apagados com sucesso.'
            );
    }
}