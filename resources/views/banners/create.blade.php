<x-app-layout>

<div class="max-w-4xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">
        Novo Banner
    </h1>


    <form action="{{ route('banners.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-5">

        @csrf


        <div>
            <label class="block mb-2 text-gray-700 dark:text-gray-200">
                Imagem do Banner
            </label>

            <input type="file"
                   name="imagem"
                   accept="image/*"
                   class="border rounded p-2 w-full
                          text-gray-900 dark:text-white
                          bg-white dark:bg-slate-800
                          border-gray-300 dark:border-slate-700">
        </div>



        <div>
            <label class="block mb-2 text-gray-700 dark:text-gray-200">
                Título
            </label>

            <input type="text"
                   name="titulo"
                   class="border rounded p-2 w-full
                          text-gray-900 dark:text-white
                          placeholder-gray-400
                          bg-white dark:bg-slate-800
                          border-gray-300 dark:border-slate-700"
                   placeholder="Ex: Oferta de carnes">
        </div>



        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="block mb-2 text-gray-700 dark:text-gray-200">
                    Início
                </label>

                <input type="date"
                       name="inicio"
                       class="border rounded p-2 w-full
                              text-gray-900 dark:text-white
                              bg-white dark:bg-slate-800
                              border-gray-300 dark:border-slate-700">
            </div>


            <div>
                <label class="block mb-2 text-gray-700 dark:text-gray-200">
                    Fim
                </label>

                <input type="date"
                       name="fim"
                       class="border rounded p-2 w-full
                              text-gray-900 dark:text-white
                              bg-white dark:bg-slate-800
                              border-gray-300 dark:border-slate-700">
            </div>

        </div>



        <div>
            <label class="block mb-2 text-gray-700 dark:text-gray-200">
                Tempo na tela (segundos)
            </label>

            <input type="number"
                   name="duracao"
                   value="5"
                   class="border rounded p-2 w-full
                          text-gray-900 dark:text-white
                          bg-white dark:bg-slate-800
                          border-gray-300 dark:border-slate-700">
        </div>



        <button class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded transition">
            Salvar Banner
        </button>


    </form>

</div>

</x-app-layout>