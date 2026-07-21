<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportacaoMgv;

class ImportacaoMgvController extends Controller
{
    public function index()
    {
        $importacoes = ImportacaoMgv::where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('admin.mgv.historico', compact('importacoes'));
    }
}