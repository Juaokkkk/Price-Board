<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfiguracaoController extends Controller
{
    public function index()
    {
        $configuracao = Configuracao::firstOrCreate([
            'user_id' => auth()->id()
        ]);

        return view('admin.configuracoes', compact('configuracao'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'imagem_fundo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'tema' => 'required|in:claro,escuro',
            'cor_principal' => [
            'required',
            'regex:/^#([A-Fa-f0-9]{6})$/'
            ],
        ]);

        $configuracao = Configuracao::firstOrCreate([
            'user_id' => auth()->id()
        ]);

        if ($request->hasFile('logo')) {

            if ($configuracao->logo) {
                Storage::disk('public')->delete($configuracao->logo);
            }

            $configuracao->logo = $request
                ->file('logo')
                ->store('logos', 'public');
        }

        if ($request->hasFile('imagem_fundo')) {

            if ($configuracao->imagem_fundo) {
                Storage::disk('public')->delete($configuracao->imagem_fundo);
            }

            $configuracao->imagem_fundo = $request
                ->file('imagem_fundo')
                ->store('fundos', 'public');
        }

        $configuracao->tema = $request->tema;
        $configuracao->cor_principal = $request->cor_principal;

        $configuracao->save();

        return redirect()
            ->route('configuracoes.index')
            ->with('success', 'Configurações salvas com sucesso.');
    }
}