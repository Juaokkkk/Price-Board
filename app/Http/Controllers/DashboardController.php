<?php

namespace App\Http\Controllers;

use App\Models\Produto;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProdutos = Produto::where('user_id', auth()->id())->count();

        $ativos = Produto::where('user_id', auth()->id())
            ->where('ativo', true)
            ->count();

        $promocoes = Produto::where('user_id', auth()->id())
            ->where('promocao', true)
            ->count();

        $ultimosProdutos = Produto::where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        $previewTv = Produto::where('user_id', auth()->id())
            ->where('ativo', true)
            ->orderBy('ordem')
            ->take(8)
            ->get();

        return view('dashboard', compact(
            'totalProdutos',
            'ativos',
            'promocoes',
            'ultimosProdutos',
            'previewTv'
        ));
    }
}