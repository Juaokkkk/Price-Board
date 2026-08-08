<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::where('user_id', Auth::id())
            ->orderBy('ordem')
            ->get();

        return view('banners.index', compact('banners'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'imagem'  => 'required|image|max:5120', // Aceita até 5MB
            'titulo'  => 'nullable|string|max:255',
            'inicio'  => 'nullable|date',
            'fim'     => 'nullable|date',
            'duracao' => 'nullable|integer|min:1',
        ]);

        $imagem = $request->file('imagem')->store('banners', 'public');

        Banner::create([
            'user_id' => Auth::id(),
            'imagem'  => $imagem,
            'titulo'  => $request->titulo,
            'ativo'   => true,
            'ordem'   => 0,
            'inicio'  => $request->filled('inicio') ? Carbon::parse($request->inicio)->startOfDay() : null,
            'fim'     => $request->filled('fim') ? Carbon::parse($request->fim)->endOfDay() : null,
            'duracao' => $request->duracao ?? 5,
        ]);

        return redirect()
            ->route('banners.index')
            ->with('success', 'Banner criado com sucesso!');
    }

    public function edit(Banner $banner)
    {
        if ($banner->user_id != Auth::id()) {
            abort(403);
        }

        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        if ($banner->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'imagem'  => 'nullable|image|max:5120',
            'titulo'  => 'nullable|string|max:255',
            'inicio'  => 'nullable|date',
            'fim'     => 'nullable|date',
            'duracao' => 'nullable|integer|min:1',
        ]);

        $dados = [
            'titulo'  => $request->titulo,
            'inicio'  => $request->filled('inicio') ? Carbon::parse($request->inicio)->startOfDay() : null,
            'fim'     => $request->filled('fim') ? Carbon::parse($request->fim)->endOfDay() : null,
            'duracao' => $request->duracao ?? 5,
        ];

        if ($request->hasFile('imagem')) {
            if ($banner->imagem) {
                Storage::disk('public')->delete($banner->imagem);
            }

            $dados['imagem'] = $request->file('imagem')->store('banners', 'public');
        }

        $banner->update($dados);

        return redirect()
            ->route('banners.index')
            ->with('success', 'Banner atualizado com sucesso!');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->user_id != Auth::id()) {
            abort(403);
        }

        if ($banner->imagem) {
            Storage::disk('public')->delete($banner->imagem);
        }

        $banner->delete();

        return redirect()
            ->route('banners.index')
            ->with('success', 'Banner removido!');
    }

    public function updateStatus(Banner $banner)
    {
        if ($banner->user_id != Auth::id()) {
            abort(403);
        }

        $banner->update([
            'ativo' => !$banner->ativo
        ]);

        return back();
    }
}