<x-app-layout>

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
                class="w-full h-40 object-cover rounded-lg"
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

                Status:


                @if($banner->ativo)

                    <span class="text-green-600 dark:text-green-400 font-semibold">
                        Ativo
                    </span>


                @else


                    <span class="text-red-600 dark:text-red-400 font-semibold">
                        Inativo
                    </span>


                @endif


            </p>






            <div class="flex flex-wrap gap-3 mt-5">





                <!-- EDITAR -->

                <a 
                href="{{ route('banners.edit',$banner) }}"
                class="
                flex items-center gap-2
                px-4 py-2
                rounded-lg
                bg-blue-100 dark:bg-blue-500/10
                text-blue-600 dark:text-blue-400
                hover:bg-blue-200 dark:hover:bg-blue-500/20
                transition
                text-sm
                font-medium
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
                    px-4 py-2
                    rounded-lg
                    bg-red-100 dark:bg-red-500/10
                    text-red-600 dark:text-red-400
                    hover:bg-red-200 dark:hover:bg-red-500/20
                    transition
                    text-sm
                    font-medium
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
                    px-4 py-2
                    rounded-lg
                    bg-purple-100 dark:bg-purple-500/10
                    text-purple-600 dark:text-purple-400
                    hover:bg-purple-200 dark:hover:bg-purple-500/20
                    transition
                    text-sm
                    font-medium
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