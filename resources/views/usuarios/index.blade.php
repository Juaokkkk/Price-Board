<x-app-layout>
    
    @if(session('status'))

<div class="mb-5 rounded-lg bg-green-100 dark:bg-green-900
            text-green-800 dark:text-green-200
            px-4 py-3">
    {{ session('status') }}
</div>

@endif

<div class="max-w-7xl mx-auto py-10">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Usuários
        </h1>


        <a href="{{ route('usuarios.create') }}"
            class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg">
            + Novo Usuário
        </a>

    </div>


    @if(session('status'))

        <div class="mb-5 bg-green-100 text-green-800 p-3 rounded-lg">
            {{ session('status') }}
        </div>

    @endif



    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">

        <table class="w-full text-left">

            <thead class="bg-gray-100 dark:bg-gray-700">

                <tr>

                    <th class="px-6 py-3 text-gray-700 dark:text-gray-200">
                        Nome
                    </th>

                    <th class="px-6 py-3 text-gray-700 dark:text-gray-200">
                        Email
                    </th>

                    <th class="px-6 py-3 text-gray-700 dark:text-gray-200">
                        Tipo
                    </th>

                    <th class="px-6 py-3 text-gray-700 dark:text-gray-200">
                        Ações
                    </th>

                </tr>

            </thead>


            <tbody>


            @foreach($usuarios as $usuario)

                <tr class="border-b dark:border-gray-700">


                    <td class="px-6 py-4 text-gray-900 dark:text-white">
                        {{ $usuario->name }}
                    </td>


                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                        {{ $usuario->email }}
                    </td>


                    <td class="px-6 py-4">

                        @if($usuario->tipo == 'admin')

                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">
                                Admin
                            </span>

                        @else

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                Cliente
                            </span>

                        @endif

                    </td>



                    <td class="px-6 py-4">


                        <form action="{{ route('usuarios.destroy',$usuario) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')


<button
onclick="return confirm('Tem certeza que deseja excluir este usuário?')"
class="inline-flex items-center gap-2
       bg-red-600 hover:bg-red-700
       text-white
       px-3 py-2
       rounded-lg
       text-sm
       transition">

    <span class="material-symbols-outlined text-[18px]">
        delete
    </span>

    Excluir

</button>


                        </form>


                    </td>


                </tr>


            @endforeach


            </tbody>

        </table>


    </div>


</div>


</x-app-layout>