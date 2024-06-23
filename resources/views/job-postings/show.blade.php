
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Job Posting Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold">{{ $jobPosting->job_title }}</h3>
                    <p>{{ $jobPosting->description }}</p>
                    <p><strong>Requirements:</strong> {{ $jobPosting->requirements }}</p>
                    <p><strong>Company:</strong> {{ $jobPosting->company }}</p>

                    @if(!Auth::user()->isAdmin())
                        <a href="{{ route('job-postings.apply-form', $jobPosting->id) }}" class="btn btn-primary">Apply for this job</a>
                    @endif

                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.job-postings.edit', $jobPosting->id) }}" class="btn btn-warning mt-4">Edit</a>
                        <form action="{{ route('admin.job-postings.destroy', $jobPosting->id) }}" method="POST" class="mt-4" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
