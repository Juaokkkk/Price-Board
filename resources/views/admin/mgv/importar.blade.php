<x-app-layout>

        <x-slot name="title">
        Importar arquivo MGV
        </x-slot> 

    <div class="max-w-4xl mx-auto py-10">

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">

            <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">
                Importar arquivo MGV6
            </h2>


            @if(session('success'))

                <div class="mb-5 p-4 rounded bg-green-100 text-green-800">
                    {{ session('success') }}
                </div>

            @endif



            @if($errors->any())

                <div class="mb-5 p-4 rounded bg-red-100 text-red-800">

                    <ul>
                        @foreach($errors->all() as $erro)

                            <li>{{ $erro }}</li>

                        @endforeach
                    </ul>

                </div>

            @endif



            <form 
                action="{{ route('mgv.importar') }}" 
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div class="mb-5">

                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Arquivo MGV
                    </label>


                    <input 
                        type="file"
                        name="arquivo"
                        accept=".mgv,.txt"
                        required
                        class="block w-full border rounded p-2"
                    >

                </div>



                <button
                    type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                >
                    Importar produtos
                </button>


            </form>

        </div>

    </div>

</x-app-layout>