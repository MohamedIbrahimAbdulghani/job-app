<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ $job_vacancies->title }} - Apply
        </h2>
    </x-slot>

    <div class="px-4 py-5">
        <div class="p-6 mx-auto bg-black rounded-lg shadow-lg sm:p-6 max-w-7xl">
            <a href="{{ route('dashboard') }}" class="inline-block mb-6 text-blue-400 hover:underline">← Back to Job Details</a>
            <div class="pb-6 border-b border-white/10">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-white">{{ $job_vacancies->title }}</h1>
                        <p class="text-gray-400 text-md">{{ $job_vacancies->company->name }}</p>
                        <div class="flex items-center gap-2">
                            <p class="text-sm text-gray-400">{{ $job_vacancies->location }}</p>
                            <span class="text-gray-400">-</span>
                            <p class="text-sm text-gray-400">{{ '$' . number_format($job_vacancies->salary, 2) }}</p>
                            <p class="px-3 py-2 text-sm text-white bg-indigo-500 rounded-lg whitespace-nowrap">{{ $job_vacancies->type }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('job_vacancy.processing', $job_vacancies->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <!-- to show errros -->
                    @if($errors->any())
                        <div x-data="{ show: true }">
                            <template x-if="show">
                                <div class="relative p-4 text-white bg-red-500 rounded-lg">
                                    <button  @click="show = false" class="absolute text-xl font-bold text-white top-2 right-2 hover:text-gray-200">  &times;  </button>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </template>
                        </div>
                    @endif
                {{-- Resume Selection --}}
                <div>
                    <h3 class="mb-4 text-xl font-semibold text-white">Choose Your Resume</h3>
                    <div class="mb-6">
                        <x-input-label for="resume" value="Select from your existing resumes:" />
                        {{-- list of resumes --}}
                        <div class="space-y-4">
                            @forelse($resumes as $resume)
                                <div class="flex gap-2 mt-2 item-center">
                                    <input type="radio" name="resume_option" id="{{ $resume->id }}" value="{{ $resume->id }}" @error('resume_option') class="border-red-500" @else class="border-gray-600" @enderror >
                                    <x-input-label for="{{ $resume->id }}" class="text-white cursor-pointer">{{ $resume->filename }}</x-input-label>
                                    <span class="text-sm text-gray-400">(Last updated: {{ $resume->updated_at->format('d M,Y') }})</span>
                                </div>
                                @empty
                                    <span class="text-sm text-gray-400">No resumes found .</span>
                            @endforelse
                        </div>
                    </div>
                </div>
                {{-- upload new resume --}}
                <div x-data="{ fileName: '', hasError: {{ $errors->has('resume_file') ? 'true' : 'false' }}}">
                    <div class="flex items-center gap-2">
                        <input x-ref="newResumeRadio" type="radio" name="resume_option" id="new_resume" value="new_resume" @error('resume_option') class="border-red-500" @else class="border-gray-600" @enderror >
                        <x-input-label for="new_resume" value="upload a new resume:" />
                    </div>
                    <div class="flex items-center">
                        <div class="flex-1">
                            <label for="new_resume_file" class="block text-white cursor-pointer">
                                <div class="p-6 mt-2 transition border-2 border-red-500 border-dashed rounded-lg bg-white/5 hover:bg-white/5 " :class="{ 'border-blue-500':fileName, 'border-red-500':hasError }">
                                    <input @change="fileName = $event.target.files[0]?.name; $refs.newResumeRadio.checked = true" type="file" name="resume_file" id="new_resume_file" class="hidden" accept=".pdf">
                                    <div class="text-center">
                                        <template x-if="!fileName">
                                            <p class="text-gray-400">📄 Click to upload PDF (MAX 5MB)</p>
                                        </template>

                                        <template x-if="fileName">
                                            <div>
                                                <p x-text="fileName" class="mt-2 text-blue-400"></p>
                                                <p class="mt-1 text-sm text-gray-400">Click to change file</p>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                {{-- Submit Button --}}
                <div>
                    <x-primary-button class="w-full">Apply Now </x-primary-button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
