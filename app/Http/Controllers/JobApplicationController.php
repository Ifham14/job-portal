<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    // Method to list job applications for both users and admins
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // Admin can view all job applications
            $jobApplications = JobApplication::with('user', 'jobPosting')->orderBy('created_at', 'desc')->get();
        } else {
            // Regular user can view their own job applications
            $jobApplications = JobApplication::where('user_id', $user->id)->get();
        }

        return view('job-applications.index', compact('jobApplications'));
    }

    // Method to show job application details for both users and admins
    public function show(JobApplication $jobApplication)
    {
        // // Ensure the job application can be viewed by the authenticated user
        // $this->authorize('view', $jobApplication);

        return view('job-applications.show', compact('jobApplication'));
    }

    public function applyForm(JobPosting $jobPosting)
    {
        return view('job-postings.apply', compact('jobPosting'));
    }

    public function apply(Request $request, JobPosting $jobPosting)
    {
        $request->validate([
            'current_salary' => 'required|integer',
            'expected_salary' => 'required|integer',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'required|string|max:5000',
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'public');

        JobApplication::create([
            'job_posting_id' => $jobPosting->id,
            'user_id' => Auth::id(),
            'current_salary' => $request->current_salary,
            'expected_salary' => $request->expected_salary,
            'resume' => $resumePath,
            'cover_letter' => $request->cover_letter,
        ]);

        return redirect()->route('job-postings.show', $jobPosting->id)->with('status', 'You have successfully applied for this job!');
    }
}
