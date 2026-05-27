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

<body>

<div class="tela">

    <!-- IMAGEM -->

    <img
        id="background-tv"
        src="/assets/img/tab.preco-acougue.png"
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

    <div class="produtos">

        @foreach($produtos as $index => $produto)

            <div class="linha linha-{{ $index + 1 }}">

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

    const tema = localStorage.getItem('tema');

    const imagem = document.getElementById('background-tv');

    if(tema === 'light'){

        document.body.setAttribute('data-theme', 'light');

        imagem.src = '/assets/img/tab.preco-acougue-white.png';

    }else{

        document.body.setAttribute('data-theme', 'dark');

        imagem.src = '/assets/img/tab.preco-acougue.png';

    }

</script>

</body>
</html>