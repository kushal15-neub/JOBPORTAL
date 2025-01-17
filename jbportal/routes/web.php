<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MakeController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\UnAuth;
use Illuminate\Support\Facades\Route; 

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::put('/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');

Route::group(['prefix' => 'account', 'middleware' => UnAuth::class], function () {
    Route::get('/register', [AccountController::class, 'registration'])->name('account.registration');
    Route::post('/process-register', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
    Route::get('/login', [AccountController::class, 'login'])->name('account.login');
    Route::post('/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
});

Route::group(['middleware' => 'myauth'], function () {
    Route::get('/account/profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::post('/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
    Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
    Route::post('/update-profile-pic', [AccountController::class, 'updateProfilepic'])->name('account.updateProfilepic');
    Route::get('/create-job', [AccountController::class, 'createjob'])->name('account.createjob');
    Route::post('/save-Job', [AccountController::class, 'saveJob'])->name('account.saveJob');
    Route::get('/my-Jobs', [AccountController::class, 'myJob'])->name('account.myJob');
    Route::get('/my-Jobs/{jobId}', [AccountController::class, 'myJobView']);
    Route::get('/my-Jobs/edit/{jobedId}', [AccountController::class, 'editJob'])->name('account.editJob');
    Route::post('/update-job/{jobId}',[AccountController::class,'updateJob'])->name('account.updateJob');
    Route::post('/delete-job/{id}', [AccountController::class, 'deleteJob'])->name('account.deleteJob');
});

Route::get('/jobs/{id}', [App\Http\Controllers\JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{id}/apply', [App\Http\Controllers\JobController::class, 'applyForm'])->name('jobs.apply');
Route::post('/jobs/{id}/apply', [App\Http\Controllers\JobController::class, 'submitApplication'])->name('jobs.submit-application');

Route::get('/my-job-applications', [App\Http\Controllers\JobApplicationController::class, 'index'])->name('my.job.applications');

Route::get('my-jobs/{job_id}/applications', [App\Http\Controllers\JobApplicationController::class, 'jobApplications'])
    ->name('my.job.applications');

Route::put('/job-applications/{application}/update-status', [JobApplicationController::class, 'updateStatus'])
    ->name('job-applications.update-status');

Route::post('/update-password', [AccountController::class, 'updatePassword'])->name('account.update-password');




