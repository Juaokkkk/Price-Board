<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin - Produtos</title>

    @vite('resources/css/admin.css')

</head>

<body>

<div class="container">

    <div class="topo">

        <h1>
            Gerenciar Produtos
        </h1>

        <a
            href="/tv/acougue"
            class="botao-tv"
            target="_blank"
        >
            Abrir Tela TV
        </a>

    </div>


    <!-- FORMULÁRIO -->

    <div class="card">

        <h2>
            Adicionar Produto
        </h2>

        <form
            action="/admin/produtos"
            method="POST"
            class="formulario"
        >

            @csrf

            <input
                type="text"
                name="nome"
                placeholder="Nome do produto"
                required
            >

            <input
                type="text"
                name="categoria"
                placeholder="Categoria"
                required
            >

            <input
                type="number"
                step="0.01"
                name="preco"
                placeholder="Preço"
                required
            >

            <input
                type="number"
                name="ordem"
                placeholder="Ordem"
                required
            >

            <label class="checkbox">

                <input
                    type="checkbox"
                    name="promocao"
                >

                Em oferta

            </label>

            <button
                type="submit"
                class="botao-salvar"
            >
                Adicionar
            </button>

        </form>

    </div>


    <!-- LISTA PRODUTOS -->

    <div class="card">

        <h2>
            Produtos Cadastrados
        </h2>

        <div class="lista-produtos">

            @foreach($produtos as $produto)

                <div class="produto-item">

                    <form
                        action="/admin/produtos/{{ $produto->id }}"
                        method="POST"
                        class="produto-form"
                    >

                        @csrf
                        @method('PUT')

                        <div class="grid">

                            <input
                                type="text"
                                name="nome"
                                value="{{ $produto->nome }}"
                            >

                            <input
                                type="text"
                                name="categoria"
                                value="{{ $produto->categoria }}"
                            >

                            <input
                                type="number"
                                step="0.01"
                                name="preco"
                                value="{{ $produto->preco }}"
                            >

                            <input
                                type="number"
                                name="ordem"
                                value="{{ $produto->ordem }}"
                            >

                        </div>

                        <div class="acoes">

                            <label class="checkbox">

                                <input
                                    type="checkbox"
                                    name="promocao"
                                    {{ $produto->promocao ? 'checked' : '' }}
                                >

                                Oferta

                            </label>


                            <label class="checkbox">

                                <input
                                    type="checkbox"
                                    name="ativo"
                                    {{ $produto->ativo ? 'checked' : '' }}
                                >

                                Ativo

                            </label>


                            <button
                                type="submit"
                                class="botao-editar"
                            >
                                Salvar
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
                            Excluir
                        </button>

                    </form>

                        </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

</body>
</html>