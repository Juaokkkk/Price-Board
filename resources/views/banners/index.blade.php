<x-app-layout>

<x-slot name="title">
    Banners da TV
</x-slot>


<div class="max-w-6xl mx-auto py-10">


    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Banners da TV
        </h1>


        <a href="{{ route('banners.create') }}"
        class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition">
            + Novo Banner
        </a>

    </div>





    <div class="grid md:grid-cols-3 gap-5">


        @forelse($banners as $banner)



        <div class="
            bg-white dark:bg-slate-900
            border border-gray-200 dark:border-slate-700
            rounded-xl shadow
            p-4
        ">



            <img 
                src="{{ asset('storage/'.$banner->imagem) }}"
                class="w-full h-40 object-contain bg-gray-100 dark:bg-slate-800 rounded-lg"
            >




            <h3 class="font-bold mt-4 text-gray-900 dark:text-white">
                {{ $banner->titulo ?? 'Sem título' }}
            </h3>





            <p class="text-gray-700 dark:text-gray-300 mt-2">

                Duração:

                <span class="font-medium">
                    {{ $banner->duracao }}s
                </span>

            </p>





            <p class="text-gray-700 dark:text-gray-300 mt-1">

                Início:

                <span class="font-medium">

                    @if($banner->inicio)

                        {{ \Carbon\Carbon::parse($banner->inicio)->format('d/m/Y') }}

                    @else

                        Sem data

                    @endif

                </span>

            </p>





            <p class="text-gray-700 dark:text-gray-300 mt-1">

                Fim:

                <span class="font-medium">

                    @if($banner->fim)

                        {{ \Carbon\Carbon::parse($banner->fim)->format('d/m/Y') }}

                    @else

                        Sem data

                    @endif

                </span>

            </p>






          <p class="text-gray-700 dark:text-gray-300 mt-2">

    Status:


    @if(!$banner->ativo)

        <span class="ml-1 text-gray-500 dark:text-gray-400 font-semibold">
            Inativo
        </span>


    @elseif(
        $banner->inicio &&
        now()->lt(\Carbon\Carbon::parse($banner->inicio)->startOfDay())
    )

        <span class="ml-1 text-yellow-600 dark:text-yellow-400 font-semibold">
            Agendado
        </span>


    @elseif(
        $banner->fim &&
        now()->gt(\Carbon\Carbon::parse($banner->fim)->endOfDay())
    )

        <span class="ml-1 text-red-600 dark:text-red-400 font-semibold">
            Expirado
        </span>


    @else

        <span class="ml-1 text-green-600 dark:text-green-400 font-semibold">
            Ativo
        </span>


    @endif


</p>







            <div class="flex items-center gap-2 mt-5 overflow-x-auto">





                <!-- EDITAR -->

                <a 
                href="{{ route('banners.edit',$banner) }}"
                class="
                flex items-center gap-2
                px-3 py-2
                rounded-lg
                bg-blue-100 dark:bg-blue-500/10
                text-blue-600 dark:text-blue-400
                hover:bg-blue-200 dark:hover:bg-blue-500/20
                transition
                text-sm
                font-medium
                whitespace-nowrap
                ">


                    <span class="material-symbols-outlined text-[18px]">
                        edit
                    </span>


                    Editar


                </a>








                <!-- EXCLUIR -->


                <form 
                action="{{ route('banners.destroy',$banner) }}"
                method="POST">


                    @csrf
                    @method('DELETE')



                    <button 
                    class="
                    flex items-center gap-2
                    px-3 py-2
                    rounded-lg
                    bg-red-100 dark:bg-red-500/10
                    text-red-600 dark:text-red-400
                    hover:bg-red-200 dark:hover:bg-red-500/20
                    transition
                    text-sm
                    font-medium
                    whitespace-nowrap
                    ">


                        <span class="material-symbols-outlined text-[18px]">
                            delete
                        </span>


                        Excluir


                    </button>


                </form>








                <!-- ATIVAR / DESATIVAR -->


                <form 
                action="{{ route('banners.status',$banner) }}"
                method="POST">


                    @csrf
                    @method('PATCH')



                    <button 
                    class="
                    flex items-center gap-2
                    px-3 py-2
                    rounded-lg
                    bg-purple-100 dark:bg-purple-500/10
                    text-purple-600 dark:text-purple-400
                    hover:bg-purple-200 dark:hover:bg-purple-500/20
                    transition
                    text-sm
                    font-medium
                    whitespace-nowrap
                    ">



                        <span class="material-symbols-outlined text-[18px]">

                            @if($banner->ativo)

                                visibility_off

                            @else

                                visibility

                            @endif

                        </span>





                        @if($banner->ativo)

                            Desativar

                        @else

                            Ativar

                        @endif





                    </button>


                </form>





            </div>


        </div>




        @empty



            <p class="text-gray-700 dark:text-gray-300">
                Nenhum banner cadastrado.
            </p>




        @endforelse




    </div>


</div>


</x-app-layout>