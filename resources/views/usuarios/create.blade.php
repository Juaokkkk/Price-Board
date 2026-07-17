<x-app-layout>

<div class="max-w-xl mx-auto py-10">


    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
        Novo Usuário
    </h1>



    <form method="POST"
          action="{{ route('usuarios.store') }}"
          class="bg-white dark:bg-slate-900 shadow rounded-lg p-6">

        @csrf



        <div class="mb-4">

            <label class="block text-gray-700 dark:text-white font-medium">
                Nome
            </label>


            <input
            type="text"
            name="name"
            required
            class="mt-1 w-full rounded-lg
            bg-white dark:bg-slate-700
            text-gray-900 dark:text-white
            border-gray-300 dark:border-slate-600
            focus:ring-purple-500 focus:border-purple-500">

        </div>



        <div class="mb-4">

            <label class="block text-gray-700 dark:text-white font-medium">
                Email
            </label>


            <input
            type="email"
            name="email"
            required
            class="mt-1 w-full rounded-lg
            bg-white dark:bg-slate-700
            text-gray-900 dark:text-white
            border-gray-300 dark:border-slate-600
            focus:ring-purple-500 focus:border-purple-500">

        </div>




        <div class="mb-4">

            <label class="block text-gray-700 dark:text-white font-medium">
                Senha
            </label>


            <input
            type="password"
            name="password"
            required
            class="mt-1 w-full rounded-lg
            bg-white dark:bg-slate-700
            text-gray-900 dark:text-white
            border-gray-300 dark:border-slate-600
            focus:ring-purple-500 focus:border-purple-500">

        </div>




        <div class="mb-6">

            <label class="block text-gray-700 dark:text-white font-medium">
                Tipo de usuário
            </label>


            <select
            name="tipo"
            class="mt-1 w-full rounded-lg
            bg-white dark:bg-slate-700
            text-gray-900 dark:text-white
            border-gray-300 dark:border-slate-600
            focus:ring-purple-500 focus:border-purple-500">


                <option value="cliente">
                    Cliente
                </option>


                <option value="admin">
                    Administrador
                </option>


            </select>


        </div>




        <div class="flex justify-end">


            <button
            class="inline-flex items-center gap-2
            bg-purple-600 hover:bg-purple-700
            text-white
            px-5 py-2
            rounded-lg
            transition">

                <span class="material-symbols-outlined text-[18px]">
                    person_add
                </span>

                Salvar

            </button>


        </div>



    </form>


</div>


</x-app-layout>