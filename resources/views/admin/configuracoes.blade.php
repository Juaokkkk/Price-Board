<title>Configurações da TV</title>
<x-app-layout>
<link rel="shortcut icon" href="{{ asset('assets/img/iconPB.png') }}">
    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4">

            <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-200 dark:border-slate-700">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                        Configurações da Tela
                    </h1>

                    <p class="text-gray-500 dark:text-slate-400 mt-1">
                        Personalize a aparência da TV.
                    </p>
                </div>

                <div class="p-6">

                    @if(session('success'))
                        <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg">
                            <ul class="list-disc ml-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form
                        action="{{ route('configuracoes.update') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="space-y-8"
                    >
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-slate-200 mb-2">
                                Logo da Empresa
                            </label>

                            @if($configuracao->logo)
                                <img
                                    src="{{ asset('storage/' . $configuracao->logo) }}"
                                    class="h-20 mb-3 rounded"
                                >
                            @endif

                            <input
                                type="file"
                                name="logo"
                                class="block w-full border border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-white rounded-lg p-2"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-slate-200 mb-2">
                                Imagem de Fundo
                            </label>

                            @if($configuracao->imagem_fundo)
                                <img
                                    src="{{ asset('storage/' . $configuracao->imagem_fundo) }}"
                                    class="h-32 rounded mb-3"
                                >
                            @endif

                            <input
                                type="file"
                                name="imagem_fundo"
                                class="block w-full border border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-white rounded-lg p-2"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-slate-200 mb-3">
                                Tema da Tabela
                            </label>

                            <p class="text-sm text-gray-500 dark:text-slate-400 mb-4">
                                Claro = texto escuro e fundo claro.
                                Escuro = texto claro e fundo escuro.
                            </p>

                            <div class="flex gap-6">

                                <label class="flex items-center gap-2 text-gray-800 dark:text-white">
                                    <input
                                        type="radio"
                                        name="tema"
                                        value="claro"
                                        {{ $configuracao->tema == 'claro' ? 'checked' : '' }}
                                    >
                                    Claro
                                </label>

                                <label class="flex items-center gap-2">
                                    <input
                                        type="radio"
                                        name="tema"
                                        value="escuro"
                                        {{ $configuracao->tema == 'escuro' ? 'checked' : '' }}
                                    >
                                    Escuro
                                </label>

                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-slate-200 mb-2">
                                Cor Principal
                            </label>

                            <input
                                type="color"
                                name="cor_principal"
                                value="{{ $configuracao->cor_principal }}"
                                class="h-12 w-24 cursor-pointer rounded border border-gray-300 dark:border-slate-700"
                            >
                        </div>

                        <div class="pt-4">
                            <button
                                type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg transition"
                            >
                                Salvar Configurações
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>