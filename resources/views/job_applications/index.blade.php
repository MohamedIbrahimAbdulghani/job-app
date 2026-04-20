<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('My Applications') }}
        </h2>
    </x-slot>

    <x-toast-notification />
    <div class="py-12">
        <div class="p-4 mx-auto space-y-4 bg-black rounded-lg shadow-lg sm:p-6 max-w-7xl">
            @forelse ($jobApplications as $jobApplication)
                <div class="p-4 bg-gray-900 rounded-lg">
                    <h3 class="text-lg font-bold text-white">{{ $jobApplication->jobVacancy?->title ?? 'Position Unavailable' }}</h3>
                    <p class="text-sm">{{ $jobApplication->jobVacancy?->company?->name ?? 'Company Unavailable' }}</p>
                    <p class="text-xs">{{ $jobApplication->jobVacancy?->location ?? 'N/A' }}</p>

                    <div class="flex flex-col gap-2 mt-2 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm">{{ $jobApplication->created_at->format('d M Y') }}</p>
                        <p class="px-3 py-1 text-white bg-blue-600 rounded-md w-fit">{{ $jobApplication->jobVacancy?->type ?? 'N/A' }}</p>
                    </div>

                    <div class="flex flex-col gap-2 mt-2 sm:flex-row sm:items-center">
                        <span class="text-sm break-all">Applied With: {{ $jobApplication->resume->filename }}</span>
                        <a href="{{ Storage::disk('cloud')->url($jobApplication->resume->fileUrl) }}" target="_blank" class="text-indigo-500 hover:text-indigo-600 shrink-0">View Resume</a>
                    </div>

                    <div class="flex flex-col gap-2 mt-4">
                        <div class="flex flex-wrap items-center gap-2">
                            @php
                                $status = $jobApplication->status;
                                $statusClass = match($status) {
                                    'pending' => 'bg-blue-500',
                                    'accepted' => 'bg-green-500',
                                    'rejected' => 'bg-red-500',
                                };
                            @endphp
                            <p class="text-sm {{ $statusClass }} w-fit p-2 rounded-md">Status: {{ $jobApplication->status }}</p>
                            <p class="p-2 text-sm text-white bg-indigo-600 rounded-md w-fit">Score: {{ $jobApplication->aiGeneratedScore }}</p>
                        </div>
                        <h4 class="font-bold text-md">AI Feedback: </h4>
                        <p class="text-sm">{{ $jobApplication->aiGeneratedFeedback }}</p>
                    </div>
                </div>
            @empty
                <div class="p-4 bg-gray-800 rounded-lg">
                    <h3 class="text-white">No Job Applications found.</h3>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-4">
        {{ $jobApplications->links() }}
    </div>
</x-app-layout>
