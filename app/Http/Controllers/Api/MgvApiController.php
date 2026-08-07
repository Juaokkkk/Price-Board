<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ImportacaoMgv;
use App\Services\Importadores\Mgv6Importer;
use Illuminate\Http\Request;

class MgvApiController extends Controller
{
    public function importar(Request $request, Mgv6Importer $importador)
    {
        $request->validate([
            'token' => ['required'],
            'arquivo' => ['required', 'file'],
        ]);

        $usuario = User::where('api_token', $request->token)->first();

        if (!$usuario) {

            return response()->json([
                'success' => false,
                'message' => 'Token inválido.',
            ], 401);

        }

        $arquivo = $request->file('arquivo');

        $resultado = $importador->importar(
            $arquivo->getRealPath(),
            $usuario->id
        );

        ImportacaoMgv::create([
            'user_id'     => $usuario->id,
            'arquivo'     => $arquivo->getClientOriginalName(),
            'novos'       => $resultado['importados'],
            'existentes'  => 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Importação concluída.',
            'importados' => $resultado['importados'],
        ]);
    }
}