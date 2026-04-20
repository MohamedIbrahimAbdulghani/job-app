<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('Job Dashboard') }}
        </h2>
    </x-slot>

    <div class="px-4 py-5">
        <div class="p-4 mx-auto bg-black rounded-lg shadow-lg sm:p-6 max-w-7xl">
            <h3 class="mb-6 text-xl font-bold text-white">{{ __('Welcome back , ') }} {{ Auth::user()->name }} !</h3>

            {{-- Search & Filters --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                {{-- Search Bar --}}
                <form action="{{ 'dashboard' }}" method="get" class="flex items-center w-full sm:w-1/3">
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="w-full p-2 text-white bg-gray-800 rounded-l-lg"
                        placeholder="Search for a job">
                    <button type="submit" class="p-2 text-white bg-indigo-500 border border-indigo-500 rounded-r-lg whitespace-nowrap">
                        Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('dashboard', ['filter' => request('filter')]) }}"
                            class="p-2 ml-2 text-white border rounded-lg whitespace-nowrap">Clear</a>
                    @endif
                    @if(request('filter'))
                        <input type="hidden" name="filter" value="{{ request('filter') }}">
                    @endif
                </form>

                {{-- Filters --}}
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('dashboard', ['filter'=>'full-time', 'search' => request('search')]) }}"
                        class="px-3 py-2 text-sm text-white bg-indigo-500 rounded-lg whitespace-nowrap">Full-Time</a>
                    <a href="{{ route('dashboard', ['filter'=>'remote', 'search' => request('search')]) }}"
                        class="px-3 py-2 text-sm text-white bg-indigo-500 rounded-lg whitespace-nowrap">Remote</a>
                    <a href="{{ route('dashboard', ['filter'=>'hybrid', 'search' => request('search')]) }}"
                        class="px-3 py-2 text-sm text-white bg-indigo-500 rounded-lg whitespace-nowrap">Hybrid</a>
                    <a href="{{ route('dashboard', ['filter'=>'contract', 'search' => request('search')]) }}"
                        class="px-3 py-2 text-sm text-white bg-indigo-500 rounded-lg whitespace-nowrap">Contract</a>
                    @if(request('filter'))
                        <a href="{{ route('dashboard', ['search' => request('search')]) }}"
                            class="px-3 py-2 text-sm text-white border rounded-lg whitespace-nowrap">Clear</a>
                    @endif
                </div>
            </div>

            {{-- Job List --}}
            <div class="mt-6 space-y-4">
                @forelse ($jobs as $job)
                    <div class="flex items-center justify-between min-w-0">
                        <div class="min-w-0">
                            <a href="{{ route('job_vacancy.show', $job->id) }}" class="text-lg font-semibold text-blue-400 hover:underline line-clamp-1">
                                {{ $job->title }}
                            </a>
                            {{-- <p class="text-sm text-white line-clamp-1">{{ $job->company->name }} - {{ $job->location }}</p> --}}
                            <p class="text-sm text-white line-clamp-1">{{ $job->company?->name ?? 'Company Unavailable' }} - {{ $job->location }}</p>
                            <p class="text-sm text-white">{{'$' . number_format($job->salary, 2) }} / Year</p>
                        </div>
                        <span class="self-start px-3 py-2 ml-3 text-sm text-white bg-blue-500 rounded-lg shrink-0 sm:self-center whitespace-nowrap">
                            {{ $job->type }}
                        </span>
                    </div>
                @empty
                    <p class="text-2xl font-bold text-white">No Jobs found!</p>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
