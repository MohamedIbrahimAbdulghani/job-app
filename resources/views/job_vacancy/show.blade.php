<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ $job_vacancies->title }} - Job Details
        </h2>
    </x-slot>

    <div class="px-4 py-5">
        <div class="p-6 mx-auto bg-black rounded-lg shadow-lg sm:p-6 max-w-7xl">
            <a href="{{ route('dashboard') }}" class="inline-block mb-6 text-blue-400 hover:underline">← Back to Jobs</a>

            {{-- Header --}}
            <div class="flex flex-col gap-4 pb-6 border-b border-white/10 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $job_vacancies->title }}</h1>
                    <p class="text-gray-400 text-md">{{ $job_vacancies->company?->name ?? 'Company Unavailable' }}</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <p class="text-sm text-gray-400">{{ $job_vacancies->location }}</p>
                        <span class="text-gray-400">-</span>
                        <p class="text-sm text-gray-400">{{ '$' . number_format($job_vacancies->salary, 2) }}</p>
                        <p class="px-3 py-2 text-sm text-white bg-indigo-500 rounded-lg whitespace-nowrap">{{ $job_vacancies->type }}</p>
                    </div>
                </div>
                <div class="shrink-0">
                    <a href="{{ route('job_vacancy.apply', $job_vacancies->id) }}" class="inline-block px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-indigo-500 to-rose-500 hover:from-indigo-600 hover:to-rose-600">Apply Now</a>
                </div>
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 gap-4 mt-6 md:grid-cols-3">
                <div class="md:col-span-2">
                    <h2 class="text-lg font-bold text-white">Job Description</h2>
                    <p class="text-gray-400">{{ $job_vacancies->description }}</p>
                </div>
                <div class="md:col-span-1">
                    <h2 class="text-lg font-bold text-white">Job Overview</h2>
                    <div class="p-6 space-y-4 bg-gray-900 rounded-lg">
                        <div>
                            <p class="text-gray-400">Published Date</p>
                            <p class="text-white">{{ $job_vacancies->created_at->format('M d , Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Company</p>
                            <p class="text-white">{{ $job_vacancies->company?->name ?? 'Company Unavailable' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Location</p>
                            <p class="text-white">{{ $job_vacancies->location }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Salary</p>
                            <p class="text-white">{{ '$' . number_format($job_vacancies->salary, 2)}}</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Type</p>
                            <p class="text-white">{{ $job_vacancies->type }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400">Category</p>
                            <p class="text-white">{{ $job_vacancies->jobCategory?->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
