<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_circle_left" />

    <title>Price Board</title>

    @vite('resources/css/tv.css')

    <script>

        setInterval(() => {
            location.reload();
        }, 10000);

    </script>

</head>
<body>
<a
    href="/admin/produtos"
    class="voltar-admin"
>
    <span class="material-symbols-outlined">
        arrow_circle_left
    </span>
</a>

<div class="tela">

    <img
        src="/assets/img/tab.preco-acougue.png"
        class="background"
    >

    <div class="produtos">

        @foreach($produtos as $index => $produto)

            <div
                class="linha linha-{{ $index + 1 }}"
            >

                    <div class="nome">

                        {{ $produto->nome }}

                             @if($produto->promocao)

                         <span class="oferta">
                            - {OFERTA}
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

</body>
</html>