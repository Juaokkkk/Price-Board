<x-app-layout>
    
    <x-slot name="title">
        Configurações
    </x-slot>   

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

                {{-- FORMULÁRIO PRINCIPAL --}}
                <form
                    id="formConfiguracoes"
                    action="{{ route('configuracoes.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-8"
                >
                    @csrf

                    {{-- SEÇÃO: LOGO DA EMPRESA --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-200 mb-2">
                            Logo da Empresa
                        </label>

                        {{-- Preview do Logo (se existir) --}}
                        @if($configuracao->logo)
                            <div class="mb-3">
                                <img
                                    src="{{ asset('storage/' . $configuracao->logo) }}"
                                    class="h-20 rounded border border-gray-200 dark:border-slate-700 p-1 bg-gray-50 dark:bg-slate-850"
                                    alt="Logo Atual"
                                >
                            </div>
                        @endif

                        {{-- Input de Arquivo + Botão Lixeira lado a lado --}}
                        <div class="flex items-center gap-3">
                            <div class="flex-grow">
                                <input
                                    type="file"
                                    name="logo"
                                    class="block w-full border border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-white rounded-lg p-2 text-sm"
                                >
                            </div>

                            @if($configuracao->logo)
                                <button
                                    form="formRemoverLogo"
                                    type="submit"
                                    onclick="return confirm('Deseja remover a logo?')"
                                    class="flex items-center justify-center p-2.5 bg-red-50 hover:bg-red-100 dark:bg-red-950/30 dark:hover:bg-red-900/50 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-900/50 rounded-lg transition-colors duration-200"
                                    title="Remover Logo"
                                >
                                    {{-- Ícone de Lixeira (Trash) --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- SEÇÃO: IMAGEM DE FUNDO --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-200 mb-2">
                            Imagem de Fundo
                        </label>

                        {{-- Preview da Imagem de Fundo (se existir) --}}
                        @if($configuracao->imagem_fundo)
                            <div class="mb-3">
                                <img
                                    src="{{ asset('storage/' . $configuracao->imagem_fundo) }}"
                                    class="h-32 rounded border border-gray-200 dark:border-slate-700 p-1 bg-gray-50 dark:bg-slate-850"
                                    alt="Fundo Atual"
                                >
                            </div>
                        @endif

                        {{-- Input de Arquivo + Botão Lixeira lado a lado --}}
                        <div class="flex items-center gap-3">
                            <div class="flex-grow">
                                <input
                                    type="file"
                                    name="imagem_fundo"
                                    class="block w-full border border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-white rounded-lg p-2 text-sm"
                                >
                            </div>

                            @if($configuracao->imagem_fundo)
                                <button
                                    form="formRemoverFundo"
                                    type="submit"
                                    onclick="return confirm('Deseja remover a imagem de fundo?')"
                                    class="flex items-center justify-center p-2.5 bg-red-50 hover:bg-red-100 dark:bg-red-950/30 dark:hover:bg-red-900/50 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-900/50 rounded-lg transition-colors duration-200"
                                    title="Remover Imagem de Fundo"
                                >
                                    {{-- Ícone de Lixeira (Trash) --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- SEÇÃO: TEMA DA TABELA --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-200 mb-1">
                            Tema da Tabela
                        </label>

                        <p class="text-xs text-gray-500 dark:text-slate-400 mb-4">
                            Claro = texto escuro e fundo claro.<br>
                            Escuro = texto claro e fundo escuro.
                        </p>

                        <div class="flex gap-6">
                            <label class="flex items-center gap-2 text-gray-800 dark:text-white cursor-pointer">
                                <input
                                    type="radio"
                                    name="tema"
                                    value="claro"
                                    {{ $configuracao->tema == 'claro' ? 'checked' : '' }}
                                    class="text-indigo-600 focus:ring-indigo-500"
                                >
                                Claro
                            </label>

                            <label class="flex items-center gap-2 text-gray-800 dark:text-white cursor-pointer">
                                <input
                                    type="radio"
                                    name="tema"
                                    value="escuro"
                                    {{ $configuracao->tema == 'escuro' ? 'checked' : '' }}
                                    class="text-indigo-600 focus:ring-indigo-500"
                                >
                                Escuro
                            </label>
                        </div>
                    </div>

                    {{-- SEÇÃO: COR PRINCIPAL --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-200 mb-2">
                            Cor Principal
                        </label>

                        <div class="space-y-2">
                            <input
                                type="color"
                                name="cor_principal"
                                value="{{ $configuracao->cor_principal }}"
                                class="h-12 w-24 cursor-pointer rounded border border-gray-300 dark:border-slate-700 block"
                            >
                            
                        </div>
                    </div>

                    {{-- BOTÃO SALVAR GERAL --}}
                    <div class="pt-6 border-t border-gray-200 dark:border-slate-700">
                        <button
                            type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors w-full sm:w-auto"
                        >
                            Salvar Configurações
                        </button>
                    </div>

                </form> {{-- FIM DO FORMULÁRIO PRINCIPAL --}}

            </div>
        </div>

    </div>
</div>

{{-- FORMULÁRIOS DE EXCLUSÃO AUXILIARES (OCULTOS) --}}
@if($configuracao->logo)
    <form
        id="formRemoverLogo"
        action="{{ route('configuracoes.removerLogo') }}"
        method="POST"
        class="hidden"
    >
        @csrf
        @method('DELETE')
    </form>
@endif

@if($configuracao->imagem_fundo)
    <form
        id="formRemoverFundo"
        action="{{ route('configuracoes.removerFundo') }}"
        method="POST"
        class="hidden"
    >
        @csrf
        @method('DELETE')
    </form>
@endif

</x-app-layout>