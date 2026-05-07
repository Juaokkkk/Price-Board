<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Price Board</title>

    @vite('resources/css/tv.css')

    <script>

        setInterval(() => {
            location.reload();
        }, 10000);

    </script>

</head>
<body>

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