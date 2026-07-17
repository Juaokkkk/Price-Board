<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('created_at', 'desc')->get();

        return view('usuarios.index', compact('usuarios'));
    }


    public function create()
    {
        return view('usuarios.create');
    }


    public function store(Request $request)
    {

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'tipo' => 'required|in:admin,cliente',
    ]);


User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'tipo' => $request->tipo,
]);


        return redirect()
            ->route('usuarios.index')
            ->with('status', 'Usuário criado com sucesso!');
    }


    public function destroy(User $usuario)
    {
        // Impede excluir a própria conta logada
        if ($usuario->id === auth()->id()) {

            return back()
                ->with('status', 'Você não pode excluir seu próprio usuário.');

        }


        $usuario->delete();


        return redirect()
            ->route('usuarios.index')
            ->with('status', 'Usuário excluído com sucesso!');
    }
}