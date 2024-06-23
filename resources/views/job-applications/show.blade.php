<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Application Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p><strong>Candidate Name:</strong> {{ $jobApplication->user->name }}</p>
                    <p><strong>Job Title:</strong> {{ $jobApplication->jobPosting->job_title }}</p>
                    <p><strong>Current Salary:</strong> {{ $jobApplication->current_salary }}</p>
                    <p><strong>Expected Salary:</strong> {{ $jobApplication->expected_salary }}</p>
                    <p><strong>Cover Letter:</strong> {{ $jobApplication->cover_letter }}</p>
                    <p><strong>Resume:</strong> <a href="{{ asset('storage/' . $jobApplication->resume) }}" target="_blank">View Resume</a></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
