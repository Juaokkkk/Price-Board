@props(['disabled' => false])

<input
{{ $disabled ? 'disabled' : '' }}

{!! $attributes->merge([
    'class' => '
        border-gray-300
        text-gray-900
        bg-white

        dark:bg-slate-800
        dark:text-white
        dark:border-slate-600
        dark:placeholder-slate-400

        focus:border-indigo-500
        focus:ring-indigo-500

        rounded-md
        shadow-sm
    '
]) !!}
>
