<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Importadores\Mgv6Importer;
use App\Models\ImportacaoMgv;
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
            'user_id' => auth()->id(),
            'arquivo' => $arquivo->getClientOriginalName(),
            'novos' => $resultado['novos'],
            'existentes' => $resultado['existentes'],
        ]);


        return redirect()
            ->back()
            ->with(
                'success',
                "Importação concluída! 
                Novos: {$resultado['novos']} 
                Existentes: {$resultado['existentes']}"
            );
    }
}