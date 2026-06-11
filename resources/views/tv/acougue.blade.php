<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Price Board</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/iconPB.png') }}">

    @vite('resources/css/tv.css')

    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    >

    <script>

        setInterval(() => {
            location.reload();
        }, 10000);

    </script>

</head>

<body  style="--cor-principal: {{ $configuracao->cor_principal ?? '#dc2626' }};">


<div class="tela">

    @if($configuracao && $configuracao->logo)

<div class="logo-tv">

    <img
        src="{{ asset('storage/' . $configuracao->logo) }}"
        alt="Logo"
    >

</div>

@endif

    <!-- IMAGEM -->

    <img
    src="{{
        $configuracao && $configuracao->imagem_fundo
            ? asset('storage/' . $configuracao->imagem_fundo)
            : asset('assets/img/fundo-default.jpg')
    }}"
    class="background"
>

    <!-- BOTÃO VOLTAR -->

        <a  
        href="/admin/produtos"
        class="botao-voltar"
        target="admin"
        >

        <span class="material-symbols-outlined">
            arrow_circle_left
        </span>

    </a>


    <!-- PRODUTOS -->

<div class="painel-produtos">

    @foreach($produtos as $produto)

        <div class="linha">

                <div class="nome">

                    {{ $produto->nome }}

                    @if($produto->promocao)

                        <span class="oferta">
                            OFERTA
                        </span>

                    @endif

                </div>

                <div class="preco">
                    {{ number_format($produto->preco, 2, ',', '.') }}
                </div>

            </div>

        @endforeach

    </div>

</div>


<script>

 document.body.setAttribute(
    'data-theme',
    "{{ $configuracao->tema ?? 'escuro' }}" === 'claro'
        ? 'light'
        : 'dark'
);

</script>

</body>
</html>