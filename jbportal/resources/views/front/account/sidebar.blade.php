<div class="card border-0 shadow mb-4 p-3">
    <div class="s-body text-center mt-3">
     
        @if(Auth::user()->image!='')
        <img src="{{ asset('profile_pic/'.Auth::user()->image) }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px;height:150px; object-fit: cover;">

        @else
        <img src="{{ asset('assets/assets/images/avatar7.png') }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px;">  
        @endif

        <p class="text-muted mb-1 fs-6" style="text-transform:capitalize;">{{ Auth::user()->name }}</p>
        <div class="d-flex justify-content-center mb-2">
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Change Profile Picture</button>
        </div>
    </div>
</div>
<div class="card account-nav border-0 shadow mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush ">
            <li class="list-group-item d-flex justify-content-between p-3">
            <a href="/account/profile">Account Settings</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="/create-job">Post a Job</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="/my-Jobs">My Jobs</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="/my-job-applications">Jobs Applied</a>
            </li>
            
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
            <a href="/logout" >  Logout </a>
            </li>    
        </ul>
    </div>
</div>