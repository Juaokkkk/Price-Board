<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center h-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white">
                Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-slate-900 shadow-xl sm:rounded-xl p-8">

                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Bem-vindo ao Price Board
                </h1>

                <p class="mt-3 text-gray-600 dark:text-slate-400">
                    Gerencie produtos, promoções e telas de exibição do sistema.
                </p>

                {{-- Estatísticas --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">

                    <div class="p-6 rounded-xl bg-blue-100 dark:bg-slate-800">
                        <h3 class="text-sm text-gray-500 dark:text-slate-400">
                            Produtos
                        </h3>

                        <p class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ $totalProdutos }}
                        </p>
                    </div>

                    <div class="p-6 rounded-xl bg-green-100 dark:bg-slate-800">
                        <h3 class="text-sm text-gray-500 dark:text-slate-400">
                            Ativos
                        </h3>

                        <p class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ $ativos }}
                        </p>
                    </div>

                    <div class="p-6 rounded-xl bg-yellow-100 dark:bg-slate-800">
                        <h3 class="text-sm text-gray-500 dark:text-slate-400">
                            Promoções
                        </h3>

                        <p class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ $promocoes }}
                        </p>
                    </div>

                    <div class="p-6 rounded-xl bg-purple-100 dark:bg-slate-800">
                        <h3 class="text-sm text-gray-500 dark:text-slate-400">
                            Status TV
                        </h3>

                        <p class="text-lg font-bold text-green-600 dark:text-green-400">
                            Online
                        </p>
                    </div>

                </div>

                {{-- Navegação --}}
{{-- Navegação --}}
<div class="mt-8">

    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">
        Navegação Rápida
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <a href="/admin/produtos"
           class="flex items-center justify-between p-5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white transition shadow-lg">

            <div class="flex items-center gap-4">

                <span class="material-symbols-outlined text-4xl">
                    inventory_2
                </span>

                <div>
                    <div class="font-bold text-lg">
                        Produtos
                    </div>

                    <div class="text-blue-100 text-sm">
                        Gerenciar produtos e preços
                    </div>
                </div>

            </div>

            <span class="material-symbols-outlined">
                arrow_forward
            </span>

        </a>

        <a href="/tv/acougue"
           target="_blank"
           class="flex items-center justify-between p-5 rounded-xl bg-green-600 hover:bg-green-700 text-white transition shadow-lg">

            <div class="flex items-center gap-4">

                <span class="material-symbols-outlined text-4xl">
                    tv
                </span>

                <div>
                    <div class="font-bold text-lg">
                        Tela TV
                    </div>

                    <div class="text-green-100 text-sm">
                        Visualizar a tela de preços
                    </div>
                </div>

            </div>

            <span class="material-symbols-outlined">
                arrow_forward
            </span>

        </a>

        <a href="/user/profile"
           class="flex items-center justify-between p-5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white transition shadow-lg">

            <div class="flex items-center gap-4">

                <span class="material-symbols-outlined text-4xl">
                    person
                </span>

                <div>
                    <div class="font-bold text-lg">
                        Perfil
                    </div>

                    <div class="text-purple-100 text-sm">
                        Configurações da conta
                    </div>
                </div>

            </div>

            <span class="material-symbols-outlined">
                arrow_forward
            </span>

        </a>

    </div>

</div>

                {{-- Últimos produtos + Preview TV --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

                    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">

                        <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-4">
                            Últimos Produtos
                        </h3>

                        @forelse($ultimosProdutos as $produto)

                            <div class="flex justify-between py-2 border-b border-slate-200 dark:border-slate-700">

                                <span class="text-gray-900 dark:text-white">
                                    {{ $produto->nome }}
                                </span>

                                <span class="font-medium text-gray-700 dark:text-slate-300">
                                    R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                </span>

                            </div>

                        @empty

                            <p class="text-gray-500 dark:text-slate-400">
                                Nenhum produto cadastrado.
                            </p>

                        @endforelse

                    </div>

                    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">

                        <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-4">
                            Preview da TV
                        </h3>

                        @forelse($previewTv as $produto)

                            <div class="flex justify-between py-2 border-b border-slate-200 dark:border-slate-700">

                                <span class="text-gray-900 dark:text-white">
                                    {{ $produto->ordem }}.
                                    {{ $produto->nome }}
                                </span>

                                <span class="font-medium text-green-600 dark:text-green-400">
                                    R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                </span>

                            </div>

                        @empty

                            <p class="text-gray-500 dark:text-slate-400">
                                Nenhum produto ativo.
                            </p>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>