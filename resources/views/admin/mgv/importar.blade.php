<x-app-layout>

    <x-slot name="title">
        Importar MGV
    </x-slot>


    <div class="max-w-5xl mx-auto py-10">


        {{-- CABEÇALHO --}}
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
                Sincronização MGV
            </h1>

            <p class="mt-2 text-gray-500 dark:text-gray-400">
                Atualize automaticamente os produtos do mercado através do arquivo MGV6.
            </p>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">

    {{-- Produtos --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">

        <div class="flex items-center gap-3">

            <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-blue-600">
                    inventory_2
                </span>
            </div>

            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Produtos importados
                </p>

                <h3 class="font-bold text-gray-800 dark:text-white">
                    {{ auth()->user()->produtos()->count() }}
                </h3>
            </div>

        </div>

    </div>

    {{-- Última atualização --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">

        <div class="flex items-center gap-3">

            <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-purple-600">
                    schedule
                </span>
            </div>

            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Última atualização
                </p>

                <h3 class="font-bold text-gray-800 dark:text-white">
                    Agora
                </h3>
            </div>

        </div>

    </div>

</div>


        {{-- IMPORTAÇÃO --}}
        <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-8">



            <div class="flex items-center gap-3 mb-6">


                <div class="w-12 h-12 rounded-lg bg-blue-600 flex items-center justify-center">

                    <span class="material-symbols-outlined text-white">
                        upload_file
                    </span>

                </div>


                <div>

                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                        Importar arquivo MGV6
                    </h2>


                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Envie o arquivo exportado pelo sistema do mercado.
                    </p>

                </div>


            </div>





            @if(session('success'))

                <div class="mb-5 p-4 rounded-lg bg-green-100 text-green-800">

                    {{ session('success') }}

                </div>

            @endif




            @if($errors->any())

                <div class="mb-5 p-4 rounded-lg bg-red-100 text-red-800">

                    <ul>

                        @foreach($errors->all() as $erro)

                            <li>
                                {{ $erro }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif







           <div>

    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
        Arquivo MGV
    </label>

    <input
        id="arquivoMgv"
        type="file"
        name="arquivo"
        form="formImportacao"
        accept=".mgv,.txt"
        required
        class="w-full border rounded-lg p-3 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
    >

</div>

<div class="flex items-center gap-3 mt-6">

    {{-- Importar --}}
    <form
        id="formImportacao"
        action="{{ route('mgv.importar') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <button
            id="btnImportar"
            type="submit"
            class="px-6 py-3 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition flex items-center gap-2"
        >
            <span class="material-symbols-outlined">
                sync
            </span>

            Sincronizar produtos
        </button>

    </form>

    {{-- Limpar --}}
    <form
        action="{{ route('mgv.limpar') }}"
        method="POST"
        onsubmit="return confirm('Deseja apagar todos os produtos importados?');"
    >

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="px-6 py-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition flex items-center gap-2"
        >
            <span class="material-symbols-outlined">
                delete
            </span>

            Limpar produtos
        </button>

    </form>

</div>

</div>

        </div>



    </div>


    {{-- LOADING --}}

    <div

        id="loadingMgv"

        class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm items-center justify-center z-50"

    >


        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 text-center">


            <div class="flex justify-center mb-5">


                <div class="w-12 h-12 border-4 border-blue-200 border-t-blue-600 rounded-full animate-spin">

                </div>


            </div>



            <h3 class="text-lg font-bold text-gray-800 dark:text-white">

                Sincronizando MGV

            </h3>



            <p class="text-gray-500 dark:text-gray-300 mt-2">

                Atualizando produtos.<br>

                Aguarde alguns segundos...

            </p>



        </div>


    </div>





<script>


document
.getElementById('formImportacao')
.addEventListener('submit', function(){


    const loading =
    document.getElementById('loadingMgv');


    const botao =
    document.getElementById('btnImportar');



    loading.classList.remove('hidden');

    loading.classList.add('flex');



    botao.disabled = true;



    botao.innerHTML = `

        <span class="material-symbols-outlined animate-spin">
            sync
        </span>

        Processando...

    `;


});


</script>



</x-app-layout>