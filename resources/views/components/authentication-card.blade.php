<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-slate-950 transition-colors">
<div class="mb-6">
    {{ $logo }}
</div>

<div
    class="w-full sm:max-w-md mt-6 px-8 py-6
           bg-white dark:bg-slate-900
           border border-gray-200 dark:border-slate-700
           shadow-xl
           overflow-hidden
           sm:rounded-2xl"
>
    {{ $slot }}
</div>
</div>
