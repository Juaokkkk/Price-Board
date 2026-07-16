<x-app-layout>

<div class="max-w-4xl mx-auto py-10">


    <h1 class="text-2xl font-bold mb-6">
        Editar Banner
    </h1>



    <form 
        action="{{ route('banners.update', $banner) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-5"
    >

        @csrf
        @method('PUT')



        {{-- IMAGEM ATUAL --}}

        <div>

            <label class="block mb-2 font-semibold">
                Imagem atual
            </label>


            <img
                src="{{ asset('storage/'.$banner->imagem) }}"
                class="w-80 h-40 object-cover rounded border"
            >

        </div>





        {{-- NOVA IMAGEM --}}

        <div>

            <label class="block mb-2 font-semibold">
                Alterar imagem (opcional)
            </label>


            <input
                type="file"
                name="imagem"
                accept="image/*"
                class="border rounded p-2 w-full text-gray-800"
            >

        </div>





        {{-- TITULO --}}

        <div>

            <label class="block mb-2 font-semibold">
                Título
            </label>


            <input
                type="text"
                name="titulo"
                value="{{ $banner->titulo }}"
                class="border rounded p-2 w-full text-gray-800"
                placeholder="Ex: Oferta de carnes"
            >

        </div>






        {{-- DATAS --}}

        <div class="grid grid-cols-2 gap-4">


            <div>

                <label class="block mb-2 font-semibold">
                    Início
                </label>


                <input
                    type="date"
                    name="inicio"
                    value="{{ $banner->inicio }}"
                    class="border rounded p-2 w-full text-gray-800"
                >

            </div>




            <div>

                <label class="block mb-2 font-semibold">
                    Fim
                </label>


                <input
                    type="date"
                    name="fim"
                    value="{{ $banner->fim }}"
                    class="border rounded p-2 w-full text-gray-800"
                >

            </div>


        </div>







        {{-- DURAÇÃO --}}

        <div>

            <label class="block mb-2 font-semibold">
                Tempo na tela (segundos)
            </label>


            <input
                type="number"
                name="duracao"
                value="{{ $banner->duracao }}"
                min="1"
                class="border rounded p-2 w-full text-gray-800"
            >

        </div>







        <div class="flex gap-3">


            <button
                class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded"
            >

                Salvar alterações

            </button>




            <a
                href="{{ route('banners.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded"
            >

                Cancelar

            </a>


        </div>




    </form>


</div>


</x-app-layout>