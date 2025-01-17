@extends('front.layouts.app')
@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')

                 <form action="/update-job/{{ $job->id }}" method="post" id="createJobForm" name="createJobForm">
                    @csrf
                    <input type="hidden" name="id" value="{{ $job->id }}">
                    <div class="card border-0 shadow mb-4 ">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Job Details</h3>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Title<span class="req">*</span></label>
                                    <input type="text" value="{{ $job->title }}" placeholder="Job Title" id="title" name="title" class="form-control @error('title') is-invalid @enderror">
                                    @error('title')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Category<span class="req">*</span></label>
                                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                        <option value="">Select a Category</option>
                                        @if($categories->isNotEmpty())
                                        @foreach ($categories as $category) 
                                        <option value="{{ $category->id }}" {{ ($job->category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                        @endif
                                        
                                    </select>
                                    @error('category')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                    <select name="jobType" id="JobType" class="form-select">
                                        <option value="">Select Job Nature</option>
                                        @if($job_types->isNotEmpty())
                                        @foreach ($job_types as $jobtype) 
                                        <option value="{{ $jobtype->id }}" {{ ($job->job_type_id == $jobtype->id) ? 'selected' : '' }}>{{ $jobtype->name }}</option>
                                        @endforeach
                                        @endif
                                        
                                    </select>
                                    <p></p>
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                    <input type="number" value="{{ $job->vacancy }}" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control @error('vacancy') is-invalid @enderror">
                                    @error('vacancy')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Salary</label>
                                    <input type="text" value="{{ $job->salary }}" placeholder="Salary" id="salary" name="salary" class="form-control">
                                    @error('salary')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location<span class="req">*</span></label>
                                    <input type="text" value="{{ $job->location }}" placeholder="Location" id="location" name="location" class="form-control @error('location') is-invalid @enderror">
                                    @error('location')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Description<span class="req">*</span></label>
                                <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $job->description }}</textarea>
                                @error('description')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Benefits</label>
                                <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ $job->benefits }}</textarea>
                                @error('benefits')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Responsibility</label>
                                <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{ $job->responsibality }}</textarea>
                                @error('responsibility')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Qualifications</label>
                                <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{ $job->qualification }}</textarea>
                                @error('qualifications')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="mb-4">
                            <label for="" class="mb-2">Experience<span class="req">* </label>
                            <select name="experience" id="experience" class="form-control @error('experience') is-invalid @enderror">
                            @foreach(['1','2','3','4','5','6','7','8','9','10 or more'] as $year)
                            <option value="{{ $year }}" {{ ($job->experience == $year) ? 'selected' : '' }}>{{ $year }} year</option>
                            @endforeach
                            
                            </select>
                            @error('experience')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror

                        </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Keywords</span></label>
                                <input type="text" value="{{ $job->keywords }}" placeholder="keywords" id="keywords" name="keywords" class="form-control">
                            @error('keywords')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                            </div>

                            <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Name<span class="req">*</span></label>
                                    <input type="text" value="{{ $job->company_name }}" placeholder="Company Name" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror">
                                    @error('company_name')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location</label>
                                    <input type="text" value="{{ $job->company_location }}" placeholder="Location" id="company_location" name="company_location" class="form-control">
                                    @error('company_location')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Website</label>
                                <input type="text" value="{{ $job->company_website }}" placeholder="Website" id="website" name="website" class="form-control">
                                @error('website')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                        </div> 
                        <div class="card-footer  p-4">
                            <input type="submit" class="btn btn-primary" value="Save Job"></input>
                            
                        </div>
                    </div>   
                </form>    

            </div>
            </div>
        </div>
    </div>
</section>
<-- _____________________________  -->
@endsection
@section('customJs')
<script type="text/javascript">
    $("#createJobForm").submit(function (e) {
        alert();
        e.preventDefault();

        $("button[type='submit']").prop('disabled',false);
        alert();
        $.ajax({
            type: "post",
            url: "/save-Job",
            data: $("#createJobForm").serializeArray(),
            dataType: "json",
            success: function (response) {
                if(response.status == true){
                    $("#title").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#category").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#jobType").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#Vacancy").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#Location").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#Description").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#company_name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    window.Location.href="/my-Job";

                }else{
                    var errors = response.errors;
                    // For name
                    if(errors.title){
                        $("#title").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.title);
                    }else{
                        $("#title").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                    // For email
                    if(errors.category){
                        $("#category").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.category);
                    }else{
                        $("#category").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    if(errors.jobType){
                        $("#jobType").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.jobType);
                    }else{
                        $("#jobType").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    if(errors.Vacancy){
                        $("#Vacancy").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.Vacancy);
                    }else{
                        $("#Vacancy").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    if(errors.Location){
                        $("#Location").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.Location);
                    }else{
                        $("#Location").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                    if(errors.Description){
                        $("#Description").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.Description);
                    }else{
                        $("#Description").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    if(errors.company_name){
                        $("#company_name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.company_name);
                    }else{
                        $("#company_name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html(""); 
                      
                    }
                }
            }
        });
    });
    // Change Password js code
 
</script>
@endsection