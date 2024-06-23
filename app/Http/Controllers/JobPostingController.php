<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;

class JobPostingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobPostings = JobPosting::all();
        return view('job-postings.index', compact('jobPostings'));
    }

    // public function adminIndex()
    // {
    //     $jobPostings = JobPosting::all(); // Or add some logic to filter/admin specific
    //     return view('job-postings.index', compact('jobPostings'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job-postings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'company' => 'required|string|max:255',
        ]);

        JobPosting::create($request->all());

        return redirect()->route('job-postings.index')
            ->with('success', 'Job posting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPosting $jobPosting)
    {
        return view('job-postings.show', compact('jobPosting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPosting $jobPosting)
    {
        return view('job-postings.edit', compact('jobPosting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPosting $jobPosting)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'company' => 'required|string|max:255',
        ]);

        $jobPosting->update($request->all());

        return redirect()->route('job-postings.index')
            ->with('success', 'Job posting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPosting $jobPosting)
    {
        $jobPosting->delete();

        return redirect()->route('job-postings.index')
            ->with('success', 'Job posting deleted successfully.');
    }

    /**
     * Apply for a job posting.
     */
    public function apply(Request $request, $id)
    {
        // Logic to handle job application
        $jobPosting = JobPosting::findOrFail($id);

        // Save application details (assuming you have a separate model for applications)
        $application = new JobApplication();
        $application->user_id = auth()->id();
        $application->job_posting_id = $jobPosting->id;
        $application->save();

        return redirect()->route('job-postings.index')
            ->with('success', 'Application submitted successfully.');
    }
}
