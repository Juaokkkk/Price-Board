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

</head>


<body style="--cor-principal: {{ $configuracao->cor_principal ?? '#dc2626' }};">


<div class="tela">


    {{-- LOGO DA LOJA --}}

    @if($configuracao && $configuracao->logo)

        <div class="logo-tv">

            <img
                src="{{ asset('storage/' . $configuracao->logo) }}"
                alt="Logo"
            >

        </div>

    @endif



    {{-- FUNDO --}}

    @if($configuracao && $configuracao->imagem_fundo)

        <img
            src="{{ asset('storage/' . $configuracao->imagem_fundo) }}"
            class="background"
            alt="Fundo"
        >

    @else

        <div class="logo-default">

            <img
                src="{{ asset('assets/img/iconPB.png') }}"
                alt="PriceBoard"
            >

        </div>

    @endif




    {{-- BOTÃO VOLTAR --}}

    <a
        href="/admin/produtos"
        class="botao-voltar"
        target="admin"
    >

        <span class="material-symbols-outlined">
            arrow_circle_left
        </span>

    </a>





    {{-- PRODUTOS --}}

    <div 
        class="painel-produtos"
        id="painel-produtos"
    >

        @foreach($produtos as $produto)

            <div class="linha">

    <div class="nome">
        {{ $produto->nome }}
    </div>

    <div class="coluna-oferta">

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






    {{-- BANNERS --}}

    @if($banners->count())

        <div
            class="painel-banners"
            id="painel-banners"
        >

            @foreach($banners as $banner)

                <div 
                    class="banner-slide"
                    data-duration="{{ $banner->duracao ?? 5 }}"
                >

                    <img
                        src="{{ asset('storage/'.$banner->imagem) }}?v={{ $banner->updated_at->timestamp }}"
                        alt="Banner"
                    >

                </div>

            @endforeach

        </div>

    @endif





</div>







<script>


document.body.setAttribute(

    'data-theme',

    "{{ $configuracao->tema ?? 'escuro' }}" === 'claro'

        ? 'light'

        : 'dark'

);



const produtos = document.getElementById('painel-produtos');

const banners = document.getElementById('painel-banners');


let bannerIndex = 0;




function iniciarCarrossel(){


    if(!banners){

        return;

    }



    const slides = document.querySelectorAll('.banner-slide');



    produtos.style.display = "flex";

    banners.style.display = "none";



    function mostrarProdutos(){


        banners.style.display = "none";

        produtos.style.display = "flex";



        setTimeout(mostrarBanner,16000);


    }



    function mostrarBanner(){


        produtos.style.display = "none";

        banners.style.display = "block";



        slides.forEach(slide => {

            slide.style.display = "none";

        });



        slides[bannerIndex].style.display = "flex";



        let tempoBanner = Number(
            slides[bannerIndex].dataset.duration ?? 5
        ) * 1000;



        setTimeout(() => {



            bannerIndex++;



            if(bannerIndex >= slides.length){

                bannerIndex = 0;

                mostrarProdutos();

            }

            else {

                mostrarBanner();

            }



        }, tempoBanner);



    }



    // começa com produtos

    setTimeout(mostrarBanner,16000);


}



iniciarCarrossel();





// ===============================
// ATUALIZAÇÃO AUTOMÁTICA DA TV
// ===============================


let slides = document.querySelectorAll('.banner-slide');


let tempoAtualizacao;



if(slides.length === 0){


    // sem banners

    tempoAtualizacao = 10000;



}

else {



    // produtos + tempo de cada banner

    let tempoTotal = 0;



    slides.forEach(slide => {



        let duracao = Number(slide.dataset.duration ?? 5);



        tempoTotal += 16 + duracao;



    });



    // adiciona margem

    tempoAtualizacao = (tempoTotal + 10) * 1000;



    // mínimo de 30 segundos

    if(tempoAtualizacao < 30000){

        tempoAtualizacao = 30000;

    }



}




setTimeout(() => {


    location.reload();


}, tempoAtualizacao);



</script>



</body>

</html>