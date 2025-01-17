<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredJobs = Job::where('isFeatured', 1)
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();
            
        $latestJobs = Job::orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();

        $categories = Category::withCount('jobs')
            ->orderBy('name', 'ASC')
            ->limit(8)
            ->get();

        return view('front.home', compact('featuredJobs', 'latestJobs', 'categories'));
    }
}
