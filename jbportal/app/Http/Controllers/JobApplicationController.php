<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Job;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with('job')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
            
        return view('front.applications.index', compact('applications'));
    }

    public function jobApplications($jobId)
    {
        $job = Job::findOrFail($jobId);
        
        // Ensure the user owns this job
        if ($job->user_id != auth()->id()) {
            abort(403);
        }

        $applications = JobApplication::where('job_id', $jobId)
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
            
        return view('front.applications.job-applications', compact('applications', 'job'));
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $application->update([
            'status' => $validated['status']
        ]);

        return back()->with('success', 'Application status updated successfully');
    }
} 