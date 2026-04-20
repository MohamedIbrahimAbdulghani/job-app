<x-main-layout title="Shaghalni - Find your dream job">
    <div x-data="{ show: false }" x-init="setTimeout( () => show = true, 300 )">
        <div class="inline-flex items-center mb-2" x-cloak x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100  scale-100">
            <h4 class="px-3 py-1 text-sm font-bold rounded-full text-white/60 bg-white/10 w-fit">Shaghalni</h4>
        </div>
    </div>


    <div x-data="{ show: false }" x-init="setTimeout( () => show = true, 300 )">
        <div x-cloak x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100  scale-100">
            <h1 class="mb-6 text-3xl font-bold tracking-tight sm:text-6xl md:text-8xl">
                <span class="text-white">Find Your</span> <br>
                <span class="font-serif italic text-white/60">Dream Job</span>
            </h1>
        </div>
    </div>

    <div x-data="{ show: false }" x-init="setTimeout( () => show = true, 300 )">
        <div x-cloak x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100  scale-100">
            <p class="text-lg text-white/60 ">Connect with top employers, and find exciting opportunities .</p>
        </div>
    </div>

    @if(Auth::user())
        <div x-data="{ show: false }" x-init="setTimeout( () => show = true, 300 )">
            <div class="mt-5 space-x-2" x-cloak x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100  scale-100">
                <a href="{{ 'dashboard' }}" class="px-4 py-2 text-lg text-white rounded-lg bg-gradient-to-r from-indigo-500 to-rose-500">Dashboard</a>
            </div>
        </div>
    @else
        <div x-data="{ show: false }" x-init="setTimeout( () => show = true, 300 )">
            <div class="mt-5 space-x-2" x-cloak x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100  scale-100">
                <a href="{{ 'register' }}" class="px-4 py-2 text-lg text-white rounded-lg bg-white/10">Create an Account</a>
                <a href="{{ 'login' }}" class="px-4 py-2 text-lg text-white rounded-lg bg-gradient-to-r from-indigo-500 to-rose-500">Login</a>
            </div>
        </div>
    @endif
</x-main-layout>
