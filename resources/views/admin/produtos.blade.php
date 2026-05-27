<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin - Produtos</title>

    @vite('resources/css/admin.css')

    <link rel="shortcut icon" href="{{ asset('assets/img/iconPB.png') }}">

    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    >

</head>

<body>

<div class="container">


    <!-- TOPO -->

    <div class="topo">

        <div>

            <h1>
                Price Board
            </h1>

            <p class="subtitulo">
                Controle os produtos exibidos na tela da TV
            </p>

        </div>


        <div class="acoes-topo">

            <a
            href="/tv/acougue"
            class="botao-tv"
            target="tvscreen"
            >
                Abrir Tela TV
            </a>


            <button
                type="button"
                id="toggle-theme"
                class="botao-tema"
            >

                <span class="material-symbols-outlined icone-sol">
                    light_mode
                </span>

                <span class="material-symbols-outlined icone-lua">
                    dark_mode
                </span>

            </button>

        </div>

    </div>



    <!-- FORMULÁRIO -->

    <div class="card">

        <div class="titulo-card">

            <h2>
                Adicionar Novo Produto
            </h2>

            <span class="badge">
                Cadastro
            </span>

        </div>


        <form
            action="/admin/produtos"
            method="POST"
            class="formulario"
        >

            @csrf


            <div class="campo">

                <label>
                    Nome do Produto
                </label>

                <input
                    type="text"
                    name="nome"
                    placeholder="Ex: Picanha Premium"
                    required
                >

            </div>


            <div class="campo">

                <label>
                    Categoria
                </label>

                <input
                    type="text"
                    name="categoria"
                    placeholder="Ex: Bovinos"
                    required
                >

            </div>


            <div class="campo">

                <label>
                    Preço
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="preco"
                    placeholder="0.00"
                    required
                >

            </div>


            <div class="campo">

                <label>
                    Ordem na TV
                </label>

                <input
                    type="number"
                    name="ordem"
                    placeholder="1"
                    required
                >

            </div>


            <div class="campo-checkbox">

                <label class="checkbox">

                    <input
                        type="checkbox"
                        name="promocao"
                    >

                    Produto em Oferta

                </label>

            </div>


            <button
                type="submit"
                class="botao-salvar"
            >
                Adicionar Produto
            </button>

        </form>

    </div>



    <!-- PRODUTOS -->

    <div class="card">

        <div class="titulo-produtos">

            <div>

                <h2>
                    Produtos Cadastrados
                </h2>

                <p class="descricao-lista">
                    Edite os produtos abaixo em tempo real
                </p>

            </div>

            <span class="quantidade">
                {{ count($produtos) }} produtos
            </span>

        </div>



        <!-- CABEÇALHO -->

        <div class="cabecalho-grid">

            <div>Produto</div>

            <div>Categoria</div>

            <div>Preço</div>

            <div>Ordem</div>

        </div>



        <!-- LISTA -->

        <div class="lista-produtos">

            @foreach($produtos as $produto)

                <div class="produto-item">

                    <div class="produto-topo">

                        <div>

                            <h3>
                                {{ $produto->nome }}
                            </h3>

                        </div>


                        @if($produto->ativo)

                            <span class="status ativo">
                                Ativo
                            </span>

                        @else

                            <span class="status inativo">
                                Inativo
                            </span>

                        @endif

                    </div>



                    <form
                        action="/admin/produtos/{{ $produto->id }}"
                        method="POST"
                        class="produto-form"
                    >

                        @csrf
                        @method('PUT')


                        <div class="grid">


                            <div class="campo">

                                <label>
                                    Nome do Produto
                                </label>

                                <input
                                    type="text"
                                    name="nome"
                                    value="{{ $produto->nome }}"
                                >

                            </div>



                            <div class="campo">

                                <label>
                                    Categoria
                                </label>

                                <input
                                    type="text"
                                    name="categoria"
                                    value="{{ $produto->categoria }}"
                                >

                            </div>



                            <div class="campo">

                                <label>
                                    Preço
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    name="preco"
                                    value="{{ $produto->preco }}"
                                >

                            </div>



                            <div class="campo">

                                <label>
                                    Ordem na TV
                                </label>

                                <input
                                    type="number"
                                    name="ordem"
                                    value="{{ $produto->ordem }}"
                                >

                            </div>

                        </div>



                        <div class="acoes">

                            <label class="checkbox">

                                <input
                                    type="checkbox"
                                    name="promocao"
                                    {{ $produto->promocao ? 'checked' : '' }}
                                >

                                Produto em Oferta

                            </label>



                            <label class="checkbox">

                                <input
                                    type="checkbox"
                                    name="ativo"
                                    {{ $produto->ativo ? 'checked' : '' }}
                                >

                                Exibir na TV

                            </label>



                            <button
                                type="submit"
                                class="botao-editar"
                            >
                                Salvar Alterações
                            </button>

                    </form>



                    <form
                        action="/admin/produtos/{{ $produto->id }}"
                        method="POST"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="botao-excluir"
                        >
                            Excluir Produto
                        </button>

                    </form>

                        </div>

                </div>

            @endforeach

        </div>

    </div>

</div>



<script>

    const botaoTema = document.getElementById('toggle-theme');

    const temaAtual = localStorage.getItem('tema');

    if(temaAtual === 'light'){

        document.body.setAttribute('data-theme', 'light');

    }


    botaoTema.addEventListener('click', () => {

        const tema = document.body.getAttribute('data-theme');

        if(tema === 'light'){

            document.body.removeAttribute('data-theme');

            localStorage.setItem('tema', 'dark');

        }else{

            document.body.setAttribute('data-theme', 'light');

            localStorage.setItem('tema', 'light');

        }

    });

</script>

</body>
</html>