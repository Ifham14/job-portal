<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Job Posting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('job-postings.update', $jobPosting->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Job Title -->
                        <div>
                            <x-input-label for="job_title" :value="__('Job Title')" />
                            <x-text-input id="job_title" class="block mt-1 w-full" type="text" name="job_title" :value="$jobPosting->job_title" required autofocus />
                            <x-input-error :messages="$errors->get('job_title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-area id="description" class="block mt-1 w-full" name="description" required>{{ $jobPosting->description }}</x-text-area>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Requirements -->
                        <div class="mt-4">
                            <x-input-label for="requirements" :value="__('Requirements')" />
                            <x-text-area id="requirements" class="block mt-1 w-full" name="requirements" required>{{ $jobPosting->requirements }}</x-text-area>
                            <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
                        </div>

                        <!-- Company -->
                        <div class="mt-4">
                            <x-input-label for="company" :value="__('Company')" />
                            <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" :value="$jobPosting->company" required />
                            <x-input-error :messages="$errors->get('company')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
