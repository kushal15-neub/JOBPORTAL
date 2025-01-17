<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function show($id)
    {
        $job = Job::selectRaw('jobs.*, job_types.name as job_type, categories.name as category_name , if(users.id = '.auth()->user()->id.', TRUE, FALSE) as applied')->join('job_types', 'jobs.job_type_id', '=', 'job_types.id')->join('categories', 'jobs.category_id', '=', 'categories.id')
        ->leftJoin('job_applications', 'jobs.id', '=', 'job_applications.job_id')
        ->leftJoin('users', 'job_applications.user_id', '=', 'users.id')
        ->findOrFail($id);
        // dd($job);
        return view('front.jobs.show', compact('job'));
    }

    public function applyForm($id)
    {
        $job = Job::findOrFail($id);
        return view('front.jobs.apply', compact('job'));
    }

    public function submitApplication(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'cover_letter' => 'nullable|string',
            'resume' => 'required|mimes:pdf,doc,docx|max:2048'
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'public');

        JobApplication::create([
            'job_id' => $job->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cover_letter' => $request->cover_letter,
            'resume' => $resumePath,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('jobs.show', $job->id)
            ->with('success', 'Your application has been submitted successfully!');
    }
} 