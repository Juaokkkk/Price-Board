<?php

    namespace App\Http\Controllers;

    use App\Models\Produto;
    use Illuminate\Http\Request;
    use Illuminate\Validation\Rule;
    use Illuminate\Support\Facades\DB;
    use App\Models\Configuracao;
    use App\Models\Banner;

    class ProdutoController extends Controller
    {
        private array $categorias = [
            'Bovinos',
            'Suinos',
            'Aves',
            'Peixes',
            'Embutidos',
            'Congelados',
            'Laticinios',
            'Outros'
        ];


        public function tv()
        {
            $produtos = Produto::where('user_id', auth()->id())
                ->where('ativo', true)
                ->orderBy('ordem')
                ->get();


            $banners = Banner::where('user_id', auth()->id())
                ->where('ativo', true)
                ->where(function($query){
                    $query->whereNull('inicio')
                        ->orWhereDate('inicio', '<=', now());
                })
                ->where(function($query){
                    $query->whereNull('fim')
                        ->orWhereDate('fim', '>=', now());
                })
                ->orderBy('ordem')
                ->get();


            $configuracao = Configuracao::where(
                'user_id',
                auth()->id()
            )->first();


            return view(
                'tv.acougue',
                compact(
                    'produtos',
                    'banners',
                    'configuracao'
                )
            );
        }



        public function index(Request $request)
{
    $busca = trim($request->input('busca'));


    $produtos = Produto::where('user_id', auth()->id())

        ->when($busca, function($query) use ($busca){

            $query->where(function($q) use ($busca){

                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('categoria', 'like', "%{$busca}%");

            });

        })

        ->orderBy('nome')

        ->paginate(20)

        ->withQueryString();



    $proximaOrdem = (
        Produto::where('user_id', auth()->id())
            ->where('ativo', true)
            ->max('ordem') ?? 0
    ) + 1;



    return view(
        'admin.produtos',
        compact(
            'produtos',
            'proximaOrdem',
            'busca'
        )
    );
}




        public function store(Request $request)
        {
            $dados = $request->validate([
            'nome' => 'required|string|max:255',

                'categoria' => [
                'required',
                Rule::in($this->categorias)
            ],

                'preco' => 'required|numeric|min:0',

                'ordem' => 'nullable|integer|min:1',
            ]);


            DB::transaction(function () use ($dados, $request) {


                $ativo = $request->has('ativo');


                $ordem = 0;


                if($ativo){

    $ordem = !empty($dados['ordem'])
        ? $dados['ordem']
        : (
            Produto::where('user_id', auth()->id())
                ->where('ativo', true)
                ->max('ordem') ?? 0
          ) + 1;

}



                Produto::create([

                    'user_id' => auth()->id(),

                    'nome' => $dados['nome'],

                    'categoria' => $dados['categoria'],

                    'preco' => $dados['preco'],

                    'promocao' => $request->has('promocao'),

                    'ativo' => $ativo,

                    'ordem' => $ordem,

                ]);

            });


            return redirect('/admin/produtos')
                ->with('sucesso','Produto cadastrado com sucesso.');
        }





        public function update(Request $request, Produto $produto)
        {
            abort_if($produto->user_id !== auth()->id(),403);


            $dados = $request->validate([

                'nome' => 'required|string|max:255',

                'categoria' => [
                    'required',
                    Rule::in($this->categorias)
                ],

                'preco' => 'required|numeric|min:0',

                'ordem' => 'nullable|integer|min:1',

            ]);



            DB::transaction(function () use ($produto,$dados,$request){


                $novoStatus = $request->has('ativo');


                $ordemNova = !empty($dados['ordem'])
                ? $dados['ordem']
                : $produto->ordem;




                // marcou para aparecer na TV
                if(
                    $novoStatus &&
                    !$produto->ativo
                ){

                    $ordemNova = (
                        Produto::where('user_id',auth()->id())
                            ->where('ativo',true)
                            ->max('ordem') ?? 0
                    ) + 1;

                }





                // mudou posição manualmente
                if(
                    $novoStatus &&
                    $produto->ativo &&
                    $ordemNova != $produto->ordem
                ){



                    if($ordemNova < $produto->ordem){


                        Produto::where('user_id',auth()->id())

                            ->where('id','!=',$produto->id)

                            ->whereBetween(
                                'ordem',
                                [
                                    $ordemNova,
                                    $produto->ordem - 1
                                ]
                            )

                            ->increment('ordem');


                    }elseif($ordemNova > $produto->ordem){



                        Produto::where('user_id',auth()->id())

                            ->where('id','!=',$produto->id)

                            ->whereBetween(
                                'ordem',
                                [
                                    $produto->ordem + 1,
                                    $ordemNova
                                ]
                            )

                            ->decrement('ordem');


                    }

                }






                // removeu da TV
                if(
                    !$novoStatus &&
                    $produto->ativo
                ){


                    Produto::where('user_id',auth()->id())

                        ->where('ativo',true)

                        ->where('ordem','>',$produto->ordem)

                        ->decrement('ordem');


                    $ordemNova = 0;

                }






                $produto->update([

                    'nome'=>$dados['nome'],

                    'categoria'=>$dados['categoria'],

                    'preco'=>$dados['preco'],

                    'promocao'=>$request->has('promocao'),

                    'ativo'=>$novoStatus,

                    'ordem'=>$ordemNova,

                ]);

            });



            return redirect('/admin/produtos')
                ->with('sucesso','Produto atualizado com sucesso.');
        }





        public function destroy(Produto $produto)
        {
            abort_if($produto->user_id !== auth()->id(),403);


            $produto->delete();


            return redirect('/admin/produtos')
                ->with('sucesso','Produto removido com sucesso.');
        }
    }