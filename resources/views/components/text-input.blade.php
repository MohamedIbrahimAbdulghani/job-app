@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'text-white bg-white/10 border-white/10 focus:border-indigo-500 block mt-1 w-full rounded-lg']) }}>
