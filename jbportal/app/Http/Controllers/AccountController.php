<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobType;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

use App\Models\User;

class AccountController extends Controller
{
    public function registration(Request $request)
    {
        return view('front.account.registration'); 
    }

    public function processRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        if ($validator->passes()) {
            // Creating the user
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            session()->flash('success', 'You have registered successfully!');  // Correct the flash message

            return response()->json([
                'status' => true,
                'message' => 'Registration successful!',
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function login(Request $request)
    {
        return view('front.account.login');
    }
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                $request->session()->regenerate();
                return redirect()->route('account.profile');
            } else {
                return redirect()->route('account.login')
                    ->with('error', 'Either email or password is incorrect');
            }
        } else {
            return redirect()->route('account.login')
                ->with('error', 'Either email or password is incorrect')
                ->withInput($request->only('email'));
        }
    }
    public function profile(Request $request)
    {
        $id = Auth::user()->id;

        $user = User::where('id', $id)->first();
        return view('front.account.profile', [
            'user' => $user,
        ]);
    }
    public function updateProfile(Request $request)
    {

        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email,' . $id . ',id'
        ]);

        if ($validator->passes()) {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;
            $user->save();

            Session()->flash('success', 'Profile updated successfully.');
            return view('front.account.profile', [
                'user' => $user,
            ]);
            // return response()->json([
            //     'status' => true,
            //     'errors' => [],
            // ]);
        } else {
            $user = User::find($id);
            return view('front.account.profile', [
                'user' => $user,
            ]);
            // return response()->json([
            //     'status' => false,
            //     'errors' => $validator->errors(),
            // ]);
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }


    public function updateProfilepic(Request $request)
    {
        $id = Auth::user()->id;
        if($request->hasFile('image')){
            $image = $request->file('image');
            // dd($image);
            $ext = $image->getClientOriginalExtension();
            // $ext = $image->
            $imageName = $id . '-' . time() . '.' . $ext; ///3-123333212.png
            try{
                $image->move(public_path('/profile_pic/'), $imageName); ///store it into thee profilepic folder
            }catch(FileException $e){
                return response()->json([
                    'status' => false,
                    'errors' => ['image' => 'Please select an image']
                ]);
            }


            User::where('id', $id)->update(['image' => $imageName]);
            session()->flash('success', 'Profile  Picture update successfully.');
            return redirect()->route('account.profile');
        } else {
            return response()->json([
                'status' => false,
                'errors' => ['image' => 'Please select an image']
            ]);
        }
    }


    public function createJob()
    {
        $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
        $job_types = JobType::orderBy('name', 'ASC')->where('status', 1)->get();
        return view('front.account.job.create', [
            'categories' => $categories,
            'job_types' => $job_types,
        ]);
    }

    public function saveJob(Request $request)
    {
        $rules = [
            'title' => 'required|min:5|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required|integer',
            'location' => 'required|max:50',
            'description' => 'required',
            'experience' => 'required',
            'company_name' => 'required|min:3|max:75',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            // dd('passed');
            $job = new Job();
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobType;
            $job->user_id = Auth::user()->id;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->responsibality = $request->responsibility;
            $job->qualification = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
            $job->company_website = $request->company_website;
            $job->save();
            // dd(json_encode($request->all()));
            Session()->flash('success', 'Job added successfully.');
           
            $jobs = Job::where('user_id', Auth::user()->id)->with('jobType')->orderBy('created_at', 'DESC')->paginate(10);
            return redirect()->route('account.myJob');
        } else {
            // dd($request->all());
            $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
            $job_types = JobType::orderBy('name', 'ASC')->where('status', 1)->get();
            return view('front.account.job.create' , [
                'categories' => $categories,
                'job_types' => $job_types,
            ])->withErrors($validator);
        }
    }


    public function myJob()
    {

        //metioned the code of the paginator in AppServiceProvider Class otherwise your paginator will not work perfectly

        $jobs = Job::where('user_id', Auth::user()->id)->with('jobType')->withCount('applications')->orderBy('created_at', 'DESC')->paginate(10);
        return view('front.account.job.my-jobs', [
            'jobs' => $jobs,
        ]);
    }

    public function editJob($id)
    {
        $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
        $jobTypes = JobType::orderBy('name', 'ASC')->where('status', 1)->get();

        // If user write another user id through url show him 404 page
        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $id,
        ])->first();

        if ($job == null) {
            abort(404);
        }

        return view('front.account.job.edit', [
            'categories' => $categories,
            'job_types' => $jobTypes,
            'job' => $job,
        ]);
    }



    public function updateJob($jobId, Request $request){

        try{
            $job = Job::find($jobId);
            $job->update($request->all());
            return redirect('/my-Jobs/'.$jobId);
        }catch(Exception $e){
            $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
            $jobTypes = JobType::orderBy('name', 'ASC')->where('status', 1)->get();
            return view('front.account.job.edit', [
                'categories' => $categories,
                'job_types' => $jobTypes,
                'job' => $job,
            ])->withErrors($validator);
        }
    }
    

    public function deleteJob($id)
    {
        
        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $id
        ])->first();

        if ($job == null) {
            session()->flash('error', 'Job not found');
            return response()->json([
                'status' => false,
                'message' => 'Job not found'
            ]);
        }

        $job->delete();

        session()->flash('success', 'Job deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'Job deleted successfully'
        ]);
    }

    public function myJobView($id)
    {
        $job = Job::find($id);
        return view('front.account.job.view', [
            'job' => $job,
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|same:confirm_password', 
            'confirm_password' => 'required'
        ]);

        $user = Auth::user();

        if ($validator->passes()) {
            // Check if old password matches
            if (!Hash::check($request->old_password, $user->password)) {
                return view('front.account.profile', [
                    'user' => $user,
                    'errors' => ['old_password' => 'Current password is incorrect']
                ]);
            }

            // Update password
            $user->password = Hash::make($request->new_password);
            $user->save();

            session()->flash('success', 'Password updated successfully.');

            return view('front.account.profile', [
                'user' => $user,
                'message' => 'Password updated successfully'
            ]);
        }

        return view('front.account.profile', [
            'user' => $user,
            'errors' => $validator->errors()
        ]);
    }
}