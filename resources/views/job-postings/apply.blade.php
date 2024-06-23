<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Apply for Job') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('job-postings.apply', $jobPosting->id) }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Current Salary -->
                        <div class="mb-4">
                            <x-input-label for="current_salary" :value="__('Current Salary')" />
                            <x-text-input id="current_salary" class="block mt-1 w-full" type="text" name="current_salary" :value="old('current_salary')" required autofocus />
                            <x-input-error :messages="$errors->get('current_salary')" class="mt-2" />
                        </div>

                        <!-- Expected Salary -->
                        <div class="mb-4">
                            <x-input-label for="expected_salary" :value="__('Expected Salary')" />
                            <x-text-input id="expected_salary" class="block mt-1 w-full" type="text" name="expected_salary" :value="old('expected_salary')" required />
                            <x-input-error :messages="$errors->get('expected_salary')" class="mt-2" />
                        </div>

                        <!-- Resume Upload -->
                        <div class="mb-4">
                            <x-file-input id="resume" name="resume" :label="__('Resume')" class="block mt-1 w-full" required />
                            <x-input-error :messages="$errors->get('resume')" class="mt-2" />
                        </div>

                        <!-- Cover Letter -->
                        <div class="mb-4">
                            <x-input-label for="cover_letter" :value="__('Cover Letter')" />
                            <x-text-area id="cover_letter" name="cover_letter" rows="4" class="form-textarea mt-1 block w-full" required>{{ old('cover_letter') }}</x-input-area>
                            <x-input-error :messages="$errors->get('cover_letter')" class="mt-2" />
                        </div>

                        <x-primary-button>
                            {{ __('Apply') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
