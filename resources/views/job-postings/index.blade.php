<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Job Postings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.job-postings.create') }}" class="btn btn-primary mb-3">Create New Job Posting</a>
                    @endif
                    @foreach ($jobPostings as $jobPosting)
                        <div class="mb-4 p-4 border-b border-gray-300">
                            <h3 class="text-lg font-semibold">{{ $jobPosting->job_title }}</h3>
                            <p>{{ $jobPosting->description }}</p>
                            <a href="{{ route('job-postings.show', $jobPosting->id) }}" class="btn btn-info">View</a>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.job-postings.edit', $jobPosting->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.job-postings.destroy', $jobPosting->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
