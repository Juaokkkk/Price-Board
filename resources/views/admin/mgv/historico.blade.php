<x-app-layout>

<div class="min-h-screen bg-gray-100 dark:bg-slate-950 py-10">

    <div class="max-w-6xl mx-auto px-6">

        <div class="flex items-center justify-between mb-8">

            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
                    Histórico de Importações MGV
                </h1>

                <p class="text-gray-500 dark:text-gray-400 mt-2">
                    Consulte todas as importações realizadas neste mercado.
                </p>
            </div>

            <a href="{{ route('mgv.index') }}"
               class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow transition">
                Nova Importação
            </a>

        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-50 dark:bg-slate-800">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">
                            Data
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">
                            Arquivo
                        </th>

                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600 dark:text-gray-300">
                            Novos
                        </th>

                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600 dark:text-gray-300">
                            Existentes
                        </th>

                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600 dark:text-gray-300">
                            Ações
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-slate-700">

                @forelse($importacoes as $importacao)

                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                        <td class="px-6 py-4 text-gray-700 dark:text-gray-200">
                            {{ $importacao->created_at->format('d/m/Y H:i') }}
                        </td>

                        <td class="px-6 py-4 text-gray-700 dark:text-gray-200">
                            {{ $importacao->arquivo }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 font-semibold">
                                {{ $importacao->novos }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full bg-sky-50 dark:bg-sky-900/30 text-sky-600 dark:text-sky-400 font-semibold">
                                {{ $importacao->existentes }}
                            </span>
                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-center">

                                <form action="{{ route('mgv.destroy', $importacao) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Deseja realmente excluir esta importação?')"
                                        class="w-10 h-10 rounded-lg bg-red-100 hover:bg-red-200 dark:bg-red-900/40 dark:hover:bg-red-800/50 text-red-600 dark:text-red-400 transition flex items-center justify-center"
                                        title="Excluir"
                                    >
                                        <span class="material-symbols-outlined">
                                            delete
                                        </span>
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            Nenhuma importação encontrada.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">
            {{ $importacoes->links() }}
        </div>

    </div>

</div>

</x-app-layout>